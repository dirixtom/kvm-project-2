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
                $checkusername->bindValue(":username", $this->Username);
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
                
                //settings aanmaken in db
                $statement2 = $conn->prepare("INSERT INTO settings (user, push_video, push_upload, push_status, mail_video, mail_upload, mail_status) VALUES (:user, :push_video, :push_upload, :push_status, :mail_video, :mail_upload, :mail_status);");
                $statement2->bindValue(":user", $this->Username);
                $statement2->bindValue(":push_video", "true");
                $statement2->bindValue(":push_upload", "true");
                $statement2->bindValue(":push_status", "true");
                $statement2->bindValue(":mail_video", "true");
                $statement2->bindValue(":mail_upload", "true");
                $statement2->bindValue(":mail_status", "true");
                $res2 = $statement2->execute();
                
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
                throw new exception("Gebruikersnaam of wachtwoord is verkeerd.");
            }
        }

        public function handleLogin() {
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM `users` WHERE (username = :username)");
                $statement->bindValue(":username", $this->Username);
                $statement->execute();
                $res = $statement->fetch(PDO::FETCH_ASSOC);
                $firstname = $res["firstname"];
                $lastname = $res["lastname"];
                $email = $res["email"];
                $image = $res["image"];
                $userid = $res["id"];
                $_SESSION['user'] = $this->Username;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;
                $_SESSION['image'] = $image;
                $_SESSION['userid'] = $userid;

                $melding = new Melding;
                $melding->checkedFeatured();

                header('Location: ../index.php');
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
            $checkemail = $conn->prepare("SELECT * FROM `users` WHERE (email =:email) and (username != :username);");
            $checkemail->bindValue(":email", $this->m_sEmail);
            $checkemail->bindValue(":username", $_SESSION['user']);
            $checkemail->execute();
            $found_email = $checkemail->fetch(PDO::FETCH_ASSOC);
            if (!empty($found_email)) {
                throw new Exception("Deze email staat al geregistreerd op een ander account.");
            }
            if (strpos($this->Email, "@") && strpos($this->Email, ".")){
                $statement->bindValue(":email", $this->Email);
            } else {
                throw new Exception("Dit is geen geldig email adres.");
            }

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

        public function makeResetKey(){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $conn = Db::getInstance();

            //check of deze email wel bestaat
            $checkemail = $conn->prepare("SELECT * FROM `users` WHERE (email =:email);");
            $checkemail->bindValue(":email", $this->m_sEmail);
            $checkemail->execute();
            $found_email = $checkemail->fetch(PDO::FETCH_ASSOC);
            if (empty($found_email)) {
                throw new Exception("Deze email staat niet geregistreerd");
            }

            // zet reset key in databank
            $statement = $conn->prepare("INSERT INTO reset (email, reset_key) VALUES (:email, :reset_key);");
            $statement->bindValue(":email", $this->Email);
            $statement->bindValue(":reset_key", $randomString);
            $statement->execute();
            
            $boodschap = "U hebt aangegeven dat u uw wachtwoord bent vergeten. \r\nGebruik de volgende sleutel om een nieuw wachtwoord aan te maken: " . $randomString . "\r\nAls u niet een nieuw wachtwoord heeft aangevraagd, negeer deze email dan.";

            // mail sturen
            mail($this->Email,"kvm Fancorder", $boodschap, "From: roelifant.com"); //mail() kan niet werken in localhost.
        }
        
        public function checkResetKey($p_sCode, $p_sEmail){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM reset WHERE (email =:email) order by id DESC LIMIT 1;");
            $statement->bindValue(":email", $p_sEmail);
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            if (count($res)<1) {
                throw new Exception("Er is iets misgelopen.");
            } else {
                if($p_sCode == $res["reset_key"]){
                    //succes!
                    $_SESSION["reset"]= true;
                    $_SESSION["email"]= $p_sEmail;
                } else {
                    throw new Exception("De ingegeven code is verkeerd. Probeer opnieuw.");
                }
            }
        }
        
        public function resetPassword(){
            //username halen want nodig om in te loggen na herinstellen van wachtwoord
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email;");
            $statement->bindValue(":email", $_SESSION["email"]);
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            $this->Username = $res["username"];
            
            if($this->Password == $this->PasswordCheck){
            $options = [
                'cost' => 13,
                ];
                if (strlen($this->Password)<6) {
                    throw new Exception('Het wachtwoord moet minstens 6 tekens lang zijn');
                }
                $this->Password = password_hash($this->Password, PASSWORD_DEFAULT, $options);
                
                $statement2 = $conn->prepare("UPDATE users SET password = :password WHERE username = :username;");
                $statement2->bindValue(":password", $this->Password);
                $statement2->bindValue(":username", $this->Username);
                $result = $statement2->execute();
                return $result;
            } else {
                throw new Exception("De ingegeven wachtwoorden komen niet overeen");
            }
        }

        public function deleteProfile(){
            $conn = Db::getInstance();

            //unlink alle video bestanden en verwijder tags
            $statement = $conn->prepare("SELECT * FROM videos WHERE uploader = :user;");
            $statement->bindValue(":user", $_SESSION['user']);
            $statement->execute();
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $key => $video) {
                unlink("../uploads/videos/" . $video["data"]);

                $statement4 = $conn->prepare("DELETE FROM tags WHERE video = :video;");
                $statement4->bindValue(":video", $video["data"]);
                $statement4->execute();
            };

            //alle video's verwijderen uit db
            $statement2 = $conn->prepare("DELETE FROM videos WHERE uploader = :user;");
            $statement2->bindValue(":user", $_SESSION['user']);
            $statement2->execute();

            //profile image verwijderen
            if ($_SESSION["image"] != "default.png") {
                unlink("uploads/profileImages/" . $_SESSION["image"]);
            }

            //stemmen verwijderen
            $statement3 = $conn->prepare("DELETE FROM stemmen WHERE user_id = :user_id;");
            $statement3->bindValue(":user_id", $_SESSION['userid']);
            $statement3->execute();

            //profile verwijderen uit db
            $statement5 = $conn->prepare("DELETE FROM users WHERE username = :username;");
            $statement5->bindValue(":username", $_SESSION['user']);
            $statement5->execute();
        }
    }
