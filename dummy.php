<?php 
    $db = mysqli_connect('localhost', 'root', '', 'oophp_mahasiswa');

    if($_GET['data'] == 'mahasiswa'){
        $checkMahasiswa = "SELECT * FROM information_schema.tables WHERE table_name = 'mahasiswa' AND table_schema = 'oophp_mahasiswa'";
        $result = mysqli_query($db, $checkMahasiswa);
        if(mysqli_num_rows($result) < 1){
            $tableMahasiswa = "CREATE TABLE mahasiswa (
                ID INT PRIMARY KEY AUTO_INCREMENT,
                nama VARCHAR(100),
                tanggalLahir DATE,
                alamat VARCHAR(255),
                nim INT(100),
                email VARCHAR(100),
                telepon INT(100),
                foto VARCHAR(255)
            )";
            $result = mysqli_query($db, $tableMahasiswa);
            if(!$result){
                header("Location: login.php?error=Gagal buat table. Periksa sintaks");
                exit;
            }
        }

        $insertMahasiswa = "INSERT INTO mahasiswa VALUES 
            ('', 'Mahasiswa1', '2000-10-01', 'Malang, jawa timur', '19010101', 'mahasiswa1@gmail.com', 08111111111, '' ),
            ('', 'Mahasiswa2', '2000-10-02', 'Pujon, jawa timur', '19010102', 'mahasiswa2@gmail.com', 08222222222, ''),
            ('', 'Mahasiswa3', '2000-10-03', 'Dampit, jawa timur', '19010103', 'mahasiswa3@gmail.com', 08333333333, ''),
            ('', 'Mahasiswa4', '2000-10-04', 'Turen, jawa timur', '19010104', 'mahasiswa4@gmail.com', 08444444444, ''),
            ('', 'Mahasiswa5', '2000-10-05', 'Donomulyo, jawa timur', '19010104', 'mahasiswa5@gmail.com', 08555555555, '')
            ";
        $result = mysqli_query($db, $insertMahasiswa);
        redirectLogin($result);
    }elseif($_GET['data'] == 'users'){
        $checkUsers = "SELECT * FROM information_schema.tables WHERE table_schema = 'oophp_mahasiswa' AND table_name = 'users'";
        $result = mysqli_query($db, $checkUsers);
        if(mysqli_num_rows($result) < 1){
            $createUsers = "CREATE TABLE users (
                ID INT PRIMARY KEY AUTO_INCREMENT,
                nama VARCHAR(100),
                email VARCHAR(100),
                telepon INT(100),
                password VARCHAR(255),
                role VARCHAR(10)
            )";
            $result = mysqli_query($db, $createUsers);
            if(!$result){
                header("Location: login.php?error=Gagal membuat table. Periksa sintaks");
                exit;
            }
        }

        $password1 = password_hash('123', PASSWORD_DEFAULT);

        $insertUsers = "INSERT INTO users VALUES
        ('', 'admin1', 'admin1@gmail.com', '08111111111', '$password1', 'admin'),
        ('', 'guest1', 'guest1@gmail.com', '08222222222', '$password1', 'guest')
        ";

        $result = mysqli_query($db, $insertUsers);
        redirectLogin($result);
    }

    function redirectLogin($data){
        if(!$data){
            header("Location: index.php?error=Gagal menambahkan data. Periksa sintaks");
            exit;
        }else{
            header("Location: login.php?message=Berhasil menambahkan data!");
            exit;
        }
    }

