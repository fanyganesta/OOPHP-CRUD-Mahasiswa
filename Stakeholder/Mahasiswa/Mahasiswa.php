<?php
    namespace Stakeholder\Mahasiswa;
    use Stakeholder\Stakeholder;
    use Database\Database;

    class Mahasiswa extends Stakeholder {
        protected $jabatan = 'Mahasiswa', $email, $telepon, $table = 'mahasiswa' ;

        // public function __CONSTRUCT($nama, $nim, $email, $telepon){
        //     $jabatan = $this->jabatan;
        //     parent::__CONSTRUCT($nama, $nim, $jabatan);
        // }

        public function getAll(){
            $db = new Database();
            $rows = $db->getAll($this->table);
            return $rows;
        }

        public function getById($ID){
            $db = new Database();
            $rows = $db->getbyID($this->table, $ID);
            return $rows;
        }

        public function insert($data, $files){
            $nama = $data['nama'];
            $tanggalLahir = $data['tanggalLahir'];
            $alamat = $data['alamat'];
            $nim = $data['nim'];
            $email = $data['email'];
            $telepon = $data['telepon'];
            $foto = $this->fileProcessing($files['image']);

            $columns = "nama, tanggalLahir, alamat, nim, email, telepon, foto";
            $param = "?,?,?,?,?,?,?";
            $paramType = "sssssss";
            
            $datas = [$nama, $tanggalLahir, $alamat, $nim, $email, $telepon, $foto];


            $db = new Database();
            $result = $db->insert($this->table, $columns, $param, $paramType, $datas);
            return $result;
        }
 
    }