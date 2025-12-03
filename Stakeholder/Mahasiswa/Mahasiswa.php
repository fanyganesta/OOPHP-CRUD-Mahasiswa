<?php
    namespace Stakeholder\Mahasiswa;
    use Stakeholder\Stakeholder;
    use Database\Database;

    class Mahasiswa extends Stakeholder {
        protected $jabatan = 'Mahasiswa', $email, $telepon, $table = 'mahasiswa', $db;

        public function __CONSTRUCT(){
            $this->db = new Database();
        }

        public function getAll(){
            $rows = $this->db->getAll($this->table);
            return $rows;
        }

        public function getById($ID){
            $rows = $this->db->getbyID($this->table, $ID);
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


            $result = $this->db->insert($this->table, $columns, $param, $paramType, $datas);
            return $result;
        }

        public function update($data){
            $ID = "?";
            $datas = "nama = ?, 
                    tanggalLahir = ?,
                    alamat = ?,
                    nim = ?,
                    email = ?,
                    telepon = ?,
                    foto = ?
            ";
            if($_FILES['image']['error'] == 4){
                $foto = $data['oldImage'];
            }elseif($_FILES['image']['error'] == 4 && $data['oldImage'] == ''){
                $foto = null;
            }else{
                $foto = $this->fileProcessing($_FILES['image']);
            }
            $paramType = "ssssssss";
            $param = [$data['nama'], $data['tanggalLahir'], $data['alamat'],$data['nim'], $data['email'],$data['telepon'], $foto,$data['ID']];
            $result = $this->db->update($this->table, $datas, $ID, $paramType, $param);
            return $result;
        }

        public function delete($ID){
            $result = $this->db->delete($this->table, $ID);
            return $result;
        }

        public function allWithPagination($halamanAktif){
            return $this->db->allWithPagination($this->table, $halamanAktif);
        }

        public function cari($data, $get){
            $columns = "nama LIKE ? || tanggalLahir LIKE ? || alamat LIKE ? || nim LIKE ? || email LIKE ? || telepon LIKE ? ";
            $paramType = 'ssssss';
            $data = "%$data%";
            $param = [$data, $data, $data, $data, $data, $data];
            $halamanAktif = $get;
            $result = $this->db->cari($this->table, $columns, $paramType, $param, $halamanAktif);
            return $result;
        }   
 
    }