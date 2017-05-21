<?php
    class Video
    {
        private $m_iID;
        private $m_sData;
        private $m_sTumbnail;
        private $m_sUploader;
        private $m_iVotes;
        private $m_bVoted;
        private $m_sStatus;
        private $m_sTagInput;

        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty) {
                case "ID":
                    $this->m_iID = $p_vValue;
                    break;
                case "Data":
                    $this->m_sData = $p_vValue;
                    break;
                case "Tumbnail":
                    $this->m_sTumbnail = $p_vValue;
                    break;
                case "Uploader":
                    $this->m_sUploader = $p_vValue;
                    break;
                case "Votes":
                    $this->m_iVotes = $p_vValue;
                    break;
                case "Voted":
                    $this->m_bVoted = $p_vValue;
                    break;
                case "Status":
                    $this->m_sStatus = $p_vValue;
                    break;
                case "TagInput":
                    $this->m_sTagInput = $p_vValue;
                    break;
            }
        }

        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "ID":
                    return $this->m_iID;
                    break;
                case "Data":
                    return $this->m_sData;
                    break;
                case "Tumbnail":
                    return $this->m_sTumbnail;
                    break;
                case "Uploader":
                    return $this->m_sUploader;
                    break;
                case "Votes":
                    return $this->m_iVotes;
                    break;
                case "Voted":
                    return $this->m_bVoted;
                    break;
                case "Status":
                    return $this->m_sStatus;
                    break;
                case "TagInput":
                    return $this->m_sTagInput;
                    break;
            }
        }

        public function upload(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO videos (data, timestamp, uploader, status) VALUES (:data, :timestamp, :uploader, :status);");
            $statement->bindValue(":data", $this->Data);
            $statement->bindValue(":timestamp", time());
            $statement->bindValue(":uploader", $this->Uploader);
            $statement->bindValue(":status", $this->Status);
            $statement->execute();
        }

        public function setTags(){
            $tags = explode("; ", strtolower($this->TagInput));
            foreach($tags as $tag){
                $conn = Db::getInstance();
                $stmnt = $conn->prepare("INSERT INTO tags (tag, video) VALUES (:tag, :video);");
                $stmnt->bindValue(":tag", $tag);
                $stmnt->bindValue(":video", $this->Data);
                $stmnt->execute();
            }
        }

        public function vote($p_iVideoid, $p_iUserid){
            //check of dit niet een video van deze gebruiker is
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos WHERE id = :video_id ORDER BY id DESC;");
            $statement->bindValue(":video_id", $p_iVideoid);
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            if($res["uploader"] == $_SESSION["user"]){
                //wordt genegeerd omdat een gebruiker niet op zijn eigen video's mag stemmen
            } else {
            //stem
            $conn = Db::getInstance();
            $statement2 = $conn->prepare("INSERT INTO stemmen (user_id, video_id) VALUES (:user_id, :video_id);");
            $statement2->bindValue(":user_id", $p_iUserid);
            $statement2->bindValue(":video_id", $this->ID);
            $statement2->execute();

            $this->Voted= true;
            }
        }

        public function checkVote($p_iVideoid, $p_iUserid){
            $conn = Db::getInstance();
            $statement1 = $conn->prepare("SELECT * FROM stemmen WHERE video_id = :video_id;");
            $statement1->bindValue(":video_id", $p_iVideoid);
            $statement1->execute();
            $res = $statement1->fetchAll(\PDO::FETCH_ASSOC);
            $rows = count($res);
            $this->Votes = $rows;

            //Sla het aantal stemmen op in de databank (nodig voor featuren)
            $statement2 = $conn->prepare("UPDATE videos SET stemmen = :votes WHERE id = :video_id ;");
            $statement2->bindValue(":video_id", $p_iVideoid);
            $statement2->bindValue(":votes", $this->Votes);
            $statement2->execute();


            $statement3 = $conn->prepare("SELECT * FROM stemmen WHERE video_id = :video_id AND user_id = :user_id;");
            $statement3->bindValue(":user_id", $p_iUserid);
            $statement3->bindValue(":video_id", $p_iVideoid);
            $statement3->execute();
            $res2 = $statement3->fetchAll(\PDO::FETCH_ASSOC);
            $rows2 = count($res2);
            if($rows2 > 0){
                $this->Voted = true;
            } else {
                $this->Voted = false;
            }

            //Als deze video van de gebruiker is, toon het aantal stemmen
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos WHERE id = :video_id ORDER BY id DESC;");
            $statement->bindValue(":video_id", $p_iVideoid);
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            if($res["uploader"] == $_SESSION["user"]){
                $this->Voted = true;
            }

        }
        
        public function deleteVideo($p_iVideoid){
            $res = $this->show($p_iVideoid);
            unlink("../uploads/videos/" . $res["data"]);
            $conn = Db::getInstance();
            $statement = $conn->prepare("DELETE FROM videos WHERE id = :id;");
            $statement->bindValue(":id", $p_iVideoid);
            $statement->execute();
        }
        
        public function printRecent(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos WHERE NOT status = 'removed' AND NOT id =(SELECT video_id FROM reports WHERE reporter = :user) ORDER BY id DESC;");
            $statement->bindValue(":user", $_SESSION["user"]);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function printFavorite(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos v INNER JOIN stemmen s ON v.id = s.video_id WHERE s.user_id = :user_id AND NOT status = 'removed' AND NOT id =(SELECT video_id FROM reports WHERE reporter = :user) ORDER BY s.stem_id DESC;");
            $statement->bindValue(":user_id", $_SESSION["userid"]);
            $statement->bindValue(":user", $_SESSION["user"]);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function printUploads(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos WHERE uploader = :user ORDER BY id DESC;");
            $statement->bindValue(":user", $_SESSION["user"]);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function printFeatured(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos v INNER JOIN featured f ON v.id = f.video_id WHERE NOT status = 'removed' AND NOT id =(SELECT video_id FROM reports WHERE reporter = :user) ORDER BY f.feature_id DESC;");
            $statement->bindValue(":user", $_SESSION["user"]);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function show($p_iID){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos WHERE id = :id;");
            $statement->bindValue(":id", $p_iID);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
        public function report($video_id, $user, $category, $bericht){
            $conn = Db::getInstance();
            //uploader opzoeken, en status lezen
            $res = $this->show($video_id);
            $uploader = $res["uploader"];
            
            //record aan report tabel toevoegen
            $statement = $conn->prepare("INSERT INTO reports (video_id, uploader, reporter, category, bericht) VALUES (:video_id, :uploader, :reporter, :category, :bericht);");
            $statement->bindValue(":video_id", $video_id);
            $statement->bindValue(":uploader", $uploader);
            $statement->bindValue(":reporter", $user);
            $statement->bindValue(":category", $category);
            $statement->bindValue(":bericht", $bericht);
            $statement->execute();
            
            //video status updaten
        }

        public function feature(){ // maak een nieuwe feature aan
            // 1)lees de laatste feature id uit, check timestamp en check hoe lang dit geleden was
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM featured ORDER BY feature_id DESC LIMIT 1;");
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            $previous = $res["timestamp"];

            if((time() - $previous) > 20*60){ //meer dan 20 minuten geleden

            // 2) als het lang genoeg geleden was, haal alle video's op die zijn geupload sinds de laatste timestamp uit de featured tabel. orden op meeste stemmen
                $statement2 = $conn->prepare("SELECT * FROM videos WHERE timestamp > :timestamp AND stemmen > 0 ORDER BY stemmen DESC, timestamp DESC LIMIT 1;");
                $statement2->bindValue(":timestamp", $previous);
                $statement2->execute();
                $res2 = $statement2->fetch(PDO::FETCH_ASSOC);

                $feature = $res2["id"]; // dit is de video die in featured zal worden opgeslaan.

                // 3) Neem de bovenste video uit de lijst van 2) en maak een record aan in de featured tabel met die video_id, en een nieuwe timestamp
            //INSERT INTO featured (video_id, timestamp) VALUES (0, 0);
                $statement3 = $conn->prepare("INSERT INTO featured (video_id, timestamp) VALUES (:video_id, :timestamp);");
                $statement3->bindValue(":video_id", $feature);
                $statement3->bindValue(":timestamp", time());
                $statement3->execute();
            }
        }

        //een functie genaamd updateNotifications() zal de laatste feature id uit de tabel features opslaan wanneer de gebruiker op overview 3 of in livefeed is

        //public function checkFeature(){// controleer of er een nieuwe feature is
            // 1) check de recentste gefeaturede video in de featured tabel, als deze id niet overeen komt met wat in localStorage staat, wordt er een melding gemaakt

            // 2) in de medling wordt gezegd hoeveel nieuwe gefeaturede video's er zijn = laatste id in de tabel - id in localstorage/session
        //}
    }
