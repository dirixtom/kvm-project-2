<?php
    class Melding
    {
        private $m_iLastFeatured;
        private $m_iThisFeatured;

        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty) {
                case "LastFeatured":
                    $this->m_iLastFeatured = $p_vValue;
                    break;
                case "ThisFeatured":
                    $this->m_iThisFeatured = $p_vValue;
                    break;
            }
        }

        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "LastFeatured":
                    return $this->m_iLastFeatured;
                    break;
                case "ThisFeatured":
                    return $this->m_iThisFeatured;
                    break;
            }
        }
        
        public function checkAll(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM meldingen WHERE ontvanger = :ontvanger ;");
            $statement->bindValue(":ontvanger", $_SESSION["user"]);
            $statement->execute();
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);
            $rows = count($res);
            
            return $rows;
        }
        
        public function checkedFeatured(){// zal de laatste feature id uit de tabel features opslaan wanneer de gebruiker op overview 3 of in livefeed is -> roep deze functie aan in overview3 en livePlayer
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM featured ORDER BY feature_id DESC LIMIT 1;");
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            $this->LastFeatured = $res["feature_id"];
            
            $_SESSION["LastF"] = $this->LastFeatured; //sla op in sessie
        }
        
        public function notifyWinner($feature, $uploader){
            $conn = Db::getInstance();
            
            $boodschap = "Uw video werd verkozen als featured video. Klik om de featured video lijst te bekijken";
            
            $statement = $conn->prepare("INSERT INTO meldingen (boodschap, pad, ontvanger, type, gezien) VALUES (:boodschap, :pad, :ontvanger, :type, :gezien);");
            $statement->bindValue(":boodschap", $boodschap);
            $statement->bindValue("pad", "overview3.php");
            $statement->bindValue(":ontvanger", $uploader);
            $statement->bindValue(":type", 'win');
            $statement->bindValue(":gezien", "false");
            $statement->execute();
        }

        public function notifyFeatured(){// controleer of er een nieuwe feature is en maak melding als dit zo is
            // 1) check de recentst gefeaturede video in de featured tabel, als deze id niet overeen komt met wat in sessie staat, wordt er een melding gemaakt
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM featured ORDER BY feature_id DESC LIMIT 1;");
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            
            $this->ThisFeatured = $res["feature_id"];
            
            $this->LastFeatured = $_SESSION["LastF"];
            
                // 2) in de medling wordt gezegd hoeveel nieuwe gefeaturede video's er zijn = laatste id in de tabel - id in localstorage/session
                $count = $this->ThisFeatured - $this->LastFeatured;
                
                if($count > 0){
                
                if($count == 1){
                    $boodschap = "Er is een nieuwe video op het LED scherm gekomen.";
                } else if ($count > 1){
                    $boodschap = "Er zijn". $count ."nieuwe videos op het LED scherm gekomen.";
                }
                    
                //check of er al een melding is
                $statement = $conn->prepare("SELECT * FROM meldingen WHERE ontvanger = :ontvanger AND type = :type ;");
                $statement->bindValue(":ontvanger", $_SESSION["user"]);
                $statement->bindValue(":type", 'featured');
                $statement->execute();
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);
                $rows = count($res);
                    
                if($rows == 0){
                    
                    //maak nieuwe melding
                    $statement2 = $conn->prepare("INSERT INTO meldingen (boodschap, pad, ontvanger, type, gezien) VALUES (:boodschap, :pad, :ontvanger, :type, :gezien);");
                    $statement2->bindValue(":boodschap", $boodschap);
                    $statement2->bindValue("pad", "overview3.php");
                    $statement2->bindValue(":ontvanger", $_SESSION["user"]);
                    $statement2->bindValue(":type", 'featured');
                    $statement2->bindValue(":gezien", "false");
                    $statement2->execute();
                    
                } else {
                    
                    //update oude melding
                    $statement2 = $conn->prepare("UPDATE meldingen SET boodschap = :boodschap WHERE ontvanger = :ontvanger AND type = :type ;");
                    $statement2->bindValue(":ontvanger", $_SESSION["user"]);
                    $statement2->bindValue(":type", 'featured');
                    $statement2->bindValue(":boodschap", $boodschap);
                    $statement2->execute();
                }

                    } else {
                        //er moet geen melding gemaakt worden
                    }
                }

}