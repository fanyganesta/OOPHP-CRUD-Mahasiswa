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


        public function login($request){
            $username = $request['username'];
            $password = $request['password'];
            $columns = "nama = ? || email = ?";
            $paramType = 'ss';
            $param = [$username, $username];
            $result = $this->db->customFind($this->table, $columns, $paramType, $param);
            $this->redirectFailedLogin($result);
            $dbPassword = $result[0]['password'];
            $checkPassword = password_verify($password, $dbPassword);
            $this->redirectFailedLogin($checkPassword);
            session_start();
            $_SESSION['users'] = $result;
            return true;
        }

        
        function redirectFailedLogin($datas){
            if(!$datas){
                header("Location: login.php?error=Username atau Password salah");
                exit;
            }
        }

    }