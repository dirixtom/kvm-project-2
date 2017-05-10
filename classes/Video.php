<?php
    class Video
    {
        private $m_iID;
        private $m_sData;
        private $m_sTumbnail;
        private $m_sUploader;
        private $m_iVotes;
        private $m_sStatus;
        private $m_sTagInput;
        
        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty) {
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
            //echo $this->TagInput;
        }
        
        public function printRecent(){
            
        }
    }