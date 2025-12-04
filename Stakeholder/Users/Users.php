<?php
    namespace Stakeholder\Users;
    use Stakeholder\Stakeholder;
    use Database\Database;

    class Users extends Stakeholder {
        protected $db, $table = 'Users';

        public function __CONSTRUCT(){
            $this->db = new Database();
        }

        public function register($request){
            $dbColumns = "nama, email, telepon, password, role";
            $paramType = "sssss";
            $param = '?, ?, ?, ?, ?';
            $nama = $request['nama'];
            $email = $request['email'];
            $telepon = $request['telepon'];
            $password = $request['password'];
            $passwordHashed = password_hash($request['password'], PASSWORD_DEFAULT);
            $role = $request['role'];
            $konfirmasiPassword = $request['konfirmasiPassword'];

            if($konfirmasiPassword != $password){
                header("Location: register.php?error=Password tidak sama dengan Konfirmasi Password");
                exit;
            }

            $datas = [$nama, $email, $telepon, $passwordHashed, $role];

            $result = $this->db->insert($this->table,$dbColumns, $param, $paramType, $datas);
            return $result;
        }

    }