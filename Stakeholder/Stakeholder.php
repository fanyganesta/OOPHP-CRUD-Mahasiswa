<?php
    namespace Stakeholder;
    
    abstract class Stakeholder{
        protected $fotoPenguna;

        // public function __CONSTRUCT($nama, $nid, $jabatan){
        //     $this->nama = $nama;
        //     $this->nid = $nid;
        //     $this->jabatan = $jabatan;
        // }

        protected function fileProcessing($datas){ 
            $name = $datas['name'];
            $tmp_name = $datas['tmp_name'];
            $extention = strtolower(end(explode('.', $name)));

            if($datas['error'] == 4){
                header("Location: tambah.php?error=Gambar harus diisi");
                exit;
            }elseif($extention != 'webp'){
                header("Location: tambah.php?error=Gambar bukan webp");
                exit;
            }elseif($datas['size'] >= 100000){
                header("Location: tambah.php?error=Gambar terlalu besar");
                exit;
            }

            $location = "Assets/img/";
            $newName = uniqid(explode('.', $name)[0]) . '.' . $extention;
            move_uploaded_file($tmp_name, $location . $newName);

            return $newName;
        }
    }