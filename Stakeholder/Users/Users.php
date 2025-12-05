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
            $rememberme = $request['rememberme'] ?? null;
            $param = [$username, $username];
            $result = $this->db->customFind($this->table, $columns, $paramType, $param);
            $this->redirectFailedLogin($result);
            $dbPassword = $result[0]['password'];
            $checkPassword = password_verify($password, $dbPassword);
            $this->redirectFailedLogin($checkPassword);
            session_start();
            if($rememberme){
                setcookie('key', $result[0]['ID'], time() + 3600);
                setcookie('token', $dbPassword, time()+3600);
            }
            $_SESSION['users'] = $result;
            return true;
        }

        
        function redirectFailedLogin($datas){
            if(!$datas){
                header("Location: login.php?error=Username atau Password salah");
                exit;
            }
        }

        public function getByID($data){
            return $this->db->getByID($this->table, $data);
        }

        public function getAll(){
            return $result = $this->db->getAll($this->table);
        }

        public function update($datas){
            $ID = $datas['ID'];
            $nama = $datas['nama'];
            $email = $datas['email'];
            $telepon = $datas['telepon'];
            $newPassword = $datas['newPassword'];
            $konfirmasiPassword = $datas['konfirmasiPassword'];
            $dbPassword = $datas['dbPassword'];
            $role = $datas['role'];

            if($newPassword != ''){
                if($newPassword != $konfirmasiPassword){
                    redirect('editUser.php', "ID=$ID&error=Gagal update data! Password baru tidak sama");
                }else{
                    $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
                    $dbPassword = $newPasswordHashed;
                }
            }

            $columns = "nama = ?, email = ?, telepon = ?, password = ?, role = ?";
            $paramType = "sssss";
            $param = [$nama, $email, $telepon, $dbPassword, $role];

            $result = $this->db->update($this->table, $columns, $ID, $paramType, $param);
            if(!$result){
                redirect('editUser.php', "ID=$ID&error=Gagal rubah data!");
            }else{
                redirect('editUser.php', "ID=$ID&message=Berhasil rubah data!");
            }
        }


        public function hapus($ID){
            $result = $this->db->delete($this->table, $ID);
            (!$result) ?
            redirect('akun.php', 'error=Gagal hapus data, hubungi admin!') :
            redirect('akun.php', 'message=Berhasil hapus data!');
        }

    }