<?php
    class Database{
        protected $hostname = 'localhost', 
                    $username = 'root', 
                    $password = '', 
                    $database = 'oophp_mahasiswa', 
                    $stringQuery;

        public function setConnection(){
            $db = mysqli_connect(
                $this->hostname,
                $this->username,
                $this->password,
                $this->database
            );
            return $db;
        }
    }