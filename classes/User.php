<?php
    class User
    {
        private $m_sUsername;
        private $m_sEmail;
        private $m_sFirstname;
        private $m_sLastname;
        private $m_sPassword;
        private $m_sPasswordCheck;
        private $m_sPasswordNew;
        private $m_sImage;
        
        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty) {
                case "Username":
                    $this->m_sUsername = $p_vValue;
                    break;
                case "Firstname":
                    $this->m_sFirstname = $p_vValue;
                    break;
                case "Lastname":
                    $this->m_sLastname = $p_vValue;
                    break;
                case "Email":
                    $this->m_sEmail = $p_vValue;
                    break;
                case "Password":
                    $this->m_sPassword = $p_vValue;
                    break;
                case "PasswordCheck":
                    $this->m_sPasswordCheck = $p_vValue;
                    break;
                case "PasswordNew":
                    $this->m_sPasswordNew = $p_vValue;
                case "Image":
                    $this->m_sImage = $p_vValue;
                    break;
            }
        }

        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "Username":
                    return $this->m_sUsername;
                    break;
                case "Firstname":
                    return $this->m_sFirstname;
                    break;
                case "Lastname":
                    return $this->m_sLastname;
                    break;
                case "Email":
                    return $this->m_sEmail;
                    break;
                case "Password":
                    return $this->m_sPassword;
                    break;
                case "PasswordCheck":
                    return $this->m_sPasswordCheck;
                    break;
                case "PasswordNew":
                    return $this->m_sPasswordNew;
                    break;
                case "Image":
                    return $this->m_sImage;
                    break;
            }
        }
        
        public function register(){
            if($this->Password == $this->PasswordCheck){
            $options = [
                'cost' => 13,
                ];
                if (strlen($this->Password)<6) {
                    throw new Exception('Het wachtwoord moet minstens 6 tekens lang zijn');
                }
                $this->Password = password_hash($this->Password, PASSWORD_DEFAULT, $options);

                $conn = Db::getInstance();
                $statement = $conn->prepare("INSERT INTO users (username, `email`, `firstname`, `lastname`, `password`, `image`) VALUES (:username, :email, :firstname, :lastname, :password, :image);");
                
                //username
                $checkusername = $conn->prepare("SELECT * FROM `users` WHERE (username =:username)");
                $checkusername->bindValue(":username", $this->m_susername);
                $checkusername->execute();
                $found_username = $checkusername->fetch(PDO::FETCH_ASSOC);
                if (!empty($found_username)) {
                    throw new Exception("Deze username is al bezet.");
                }
                $statement->bindValue(":username", $this->Username);
            
                $statement->bindValue(":firstname", $this->Firstname);
                $statement->bindValue(":lastname", $this->Lastname);
                
                //email
                $checkemail = $conn->prepare("SELECT * FROM `users` WHERE (email =:email)");
                $checkemail->bindValue(":email", $this->m_sEmail);
                $checkemail->execute();
                $found_email = $checkemail->fetch(PDO::FETCH_ASSOC);
                if (!empty($found_email)) {
                    throw new Exception("Deze email staat al geregistreerd op een ander account.");
                }
                if (strpos($this->m_sEmail, "@") && strpos($this->m_sEmail, ".")){
                    $statement->bindValue(":email", $this->Email);
                } else {
                    throw new Exception("Dit is geen geldig email adres");
                }
            
                $statement->bindValue(":password", $this->Password);
                $statement->bindValue(":image", $this->Image);
                $result = $statement->execute();
                return $result;
            } else {
                throw new Exception("De ingegeven wachtwoorden komen niet overeen");
            }
        }
        
        public function canLogin(){ //checken of we mogen inloggen

            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM `users` WHERE (username = :username)");
            $statement->bindValue(":username", $this->m_sUsername);
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            $password = $res["password"];
            if(password_verify($this->m_sPassword, $password)){
                return true;
            } else {
                throw new exception("Username of wachtwoord is verkeerd.");
            }
        }
        
        public function handleLogin() {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM `users` WHERE (username = :username)");
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->execute();
                $res = $statement->fetch(PDO::FETCH_ASSOC);
                $firstname = $res["firstname"];
                $lastname = $res["lastname"];
                $email = $res["email"];
                $image = $res["image"];
                $userid = $res["id"];
                session_start();
                $_SESSION['user'] = $this->Username;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;
                $_SESSION['image'] = $image;
                $_SESSION['userid'] = $userid;

                header('Location: overview.php');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        
        public function updateProfile(){
            
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, image = :image where username = :username");
            $statement->bindValue(":username", $_SESSION['user']);
            $statement->bindValue(":firstname", $this->Firstname);
            $statement->bindValue(":lastname", $this->Lastname);
            
            //email:
            if($this->Email != $_SESSION['email']){
                $checkemail = $conn->prepare("SELECT * FROM `users` WHERE (email =:email)");
                $checkemail->bindValue(":email", $this->m_sEmail);
                $checkemail->execute();
                $found_email = $checkemail->fetch(PDO::FETCH_ASSOC);
                if (!empty($found_email)) {
                    throw new Exception("Deze email staat al geregistreerd op een ander account.");
                }
            }
            $statement->bindValue(":email", $this->Email);
            
            //image:
            if (($_SESSION["image"] != "default.png") && ($_SESSION["image"] != $this->Image)) {
                unlink("uploads/profileImages/" . $_SESSION["image"]);
            }
            $statement->bindValue(":image", $this->Image);
            
            $res = $statement->execute();
            $_SESSION['firstname']=$this->Firstname;
            $_SESSION['lastname']=$this->Lastname;
            $_SESSION['email']=$this->Email;
            $_SESSION['image']=$this->Image;
        }
        
        public function deleteProfile(){
            if ($_SESSION["image"] != "default.png") {
                unlink("uploads/profileImages/" . $_SESSION["image"]);
            }
            $conn = Db::getInstance();
            $statement = $conn->prepare("DELETE FROM users WHERE username = :username;");
            $statement->bindValue(":username", $_SESSION['user']);
            $statement->execute();
        }
    }