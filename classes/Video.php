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
            $statement = $conn->prepare("INSERT INTO videos (data, uploader, votes, status) VALUES (:data, :uploader, :votes, :status);");
            $statement->bindValue(":data", $this->Data);
            $statement->bindValue(":uploader", $this->Uploader);
            $statement->bindValue(":votes", $this->Votes);
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
        
        public function vote($p_iUserid){
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO stemmen (user_id, video_id) VALUES (:user_id, :video_id);");
            $statement->bindValue(":user_id", $p_iUserid);
            $statement->bindValue(":video_id", $this->ID);
            $statement->execute();
            
            $this->Voted= true;
        }
        
        public function checkVote($p_iVideoid, $p_iUserid){
            $conn = Db::getInstance();
            $statement1 = $conn->prepare("SELECT * FROM stemmen WHERE video_id = :video_id;");
            $statement1->bindValue(":video_id", $p_iVideoid);
            $statement1->execute();
            $res = $statement1->fetchAll(\PDO::FETCH_ASSOC);
            $rows = count($res);
            $this->Votes = $rows;
            
            $statement2 = $conn->prepare("SELECT * FROM stemmen WHERE video_id = :video_id AND user_id = :user_id;");
            $statement2->bindValue(":user_id", $p_iUserid);
            $statement2->bindValue(":video_id", $p_iVideoid);
            $statement2->execute();
            $res2 = $statement2->fetchAll(\PDO::FETCH_ASSOC);
            $rows2 = count($res2);
            if($rows2 > 0){
                $this->Voted = true;
            } else {
                $this->Voted = false;
            }
            
            
        }
        
        public function printRecent(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos ORDER BY id DESC;");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function printFavorite(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM videos v INNER JOIN stemmen s ON v.id = s.video_id WHERE s.user_id = :user_id ORDER BY s.stem_id DESC;");
            $statement->bindValue(":user_id", $_SESSION["userid"]);
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
    }