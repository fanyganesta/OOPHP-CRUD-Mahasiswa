<?php

    namespace Database;

    class Database{
        protected $hostname = 'localhost', 
                    $username = 'root', 
                    $password = '', 
                    $database = 'oophp_mahasiswa', 
                    $stringQuery,
                    $db;

        public function __CONSTRUCT(){
            $hostname = $this->hostname;
            $username = $this->username;
            $password = $this->password;
            $database = $this->database;

            $this->db = mysqli_connect($hostname, $username, $password, $database);
            return $this->db;
        }

        public function getAll($table){
            $str = "SELECT * FROM $table";
            $query = mysqli_query($this->db, $str);
            $rows = [];
            while($result = $query->fetch_assoc()){
                $rows[] = $result;
            }
            return $rows;
        }

        public function getByID($table, $ID){
            $str = "SELECT * FROM $table WHERE ID = $ID";
            $db = $this->db;
            $prepQuery = $db->prepare($str);
            (!$prepQuery) && $this->failedPrepare();
            
            $prepQuery->execute();
            $result = $prepQuery->get_result();
            return $result->fetch_assoc();
        }

        public function insert($table, $dbColumns, $param, $paramType, $datas){
            $str = "INSERT INTO $table ($dbColumns) VALUE ($param)";
            $prepQuery = $this->db->prepare($str);
            $prepQuery->bind_param("$paramType", ...$datas);
            $result = $prepQuery->execute();
            return $result; 
        }

        public function update($table, $columns, $ID, $paramType, $param){
            // var_dump($columns);die;
            $str = "UPDATE $table SET $columns WHERE ID = $ID";
            $prepQuery = $this->db->prepare($str);
            (!$prepQuery) && $this->failedPrepare();
            $prepQuery->bind_param("$paramType", ...$param);
            $result = $prepQuery->execute();
            return $result;
        }


        protected function failedPrepare(){
            header("Location: login.php?error=Gagal ambil data, periksa sintaks!");
            exit;
        }


        public function delete($table, $ID){
            $str = "DELETE FROM $table WHERE ID = ?";
            $prepQuery = $this->db->prepare($str);
            (!$prepQuery) && $this->failedPrepare();
            $prepQuery->bind_param('s', $ID);
            $result = $prepQuery->execute();
            return $result;
        }
    }