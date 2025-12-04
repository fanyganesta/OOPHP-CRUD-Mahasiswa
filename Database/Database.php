<?php

    namespace Database;

    class Database{
        protected $hostname = 'localhost', 
                    $username = 'root', 
                    $password = '', 
                    $database = 'oophp_mahasiswa', 
                    $stringQuery,
                    $db, 
                    $limit = 10, 
                    $index = 0;

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
            $rows = $this->fetchData($query);
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
            $result = $this->bindParam($str, $paramType, $datas);
            return $result; 
        }

        public function update($table, $columns, $ID, $paramType, $param){
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
            $result = $this->bindParam($str, 's', [$ID]);
            return $result;
        }


        public function allWithPagination($table, $halamanAktif){
            $halamanAktif = ($halamanAktif < 1) ? 1 : $halamanAktif;
            $index = $halamanAktif * $this->limit - $this->limit;
            $allData = $this->getAll($table); //beda
            $jumlahHalaman = ceil(count($allData)/$this->limit); //beda
            $str = "SELECT * FROM $table LIMIT $index, $this->limit"; //beda
            $result = $this->pagination($str, $halamanAktif, $jumlahHalaman);
            return $result;
        }


        public function cari($table, $columns, $paramType, $param, $halamanAktif){
            $limit = $this->limit;
            $halamanAktif = ($halamanAktif < 1) ? 1 : $halamanAktif;
            $index = $halamanAktif * $this->limit - $limit;

            $str = "SELECT * FROM $table WHERE 
                $columns
            ";

            $result = $this->bindParam($str, $paramType, $param);
            $datasFind = count($result);
            $jumlahHalaman = ceil($datasFind/$limit);
            $str = $str."LIMIT $index, $limit";
            $rows = $this->bindParam($str, $paramType, $param);
            $result = [];
            foreach($rows as $row){
                $row += ['jumlahHalaman' => $jumlahHalaman, 'halamanAktif' => $halamanAktif];
                $result[] = $row;
            }
            return $result;
        }

        public function fetchData($datas){
            $rows = [];
            while($result = $datas->fetch_assoc()){
                $rows[] = $result;
            }
            return $rows;
        }

        public function pagination($str, $halamanAktif, $jumlahHalaman){
            $prepQuery = $this->db->prepare($str);
            (!$prepQuery) && $this->failedPrepare();
            $prepQuery->execute();
            $result = $prepQuery->get_result();
            $rows = $this->fetchData($result);
            $result = [];
            foreach($rows as $row){
                $row += ['jumlahHalaman' => $jumlahHalaman, 'halamanAktif' => $halamanAktif];
                $result[] = $row;
            }
            return $result;
        }

        public function bindParam($str, $paramType, $param){
            $prepQuery = $this->db->prepare($str);
            (!$prepQuery) && $this->failedPrepare();
            $prepQuery->bind_param("$paramType", ...$param);
            $result = $prepQuery->execute();
            $type = explode(' ', $str)[0];
            if($type == 'SELECT'){
                $result = $prepQuery->get_result();
                $result = $this->fetchData($result);
            }
            return $result;
        }


        public function customFind($table, $columns, $paramType, $param){
            $str = "SELECT * FROM $table WHERE $columns";
            $result = $this->bindParam($str, $paramType, $param);
            return $result;
        }
    }