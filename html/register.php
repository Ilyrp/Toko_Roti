<?php
$koneksi = mysqli_connect("localhost", "root", "", "toko_roti");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["confirm_password"];
    $address = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $role = 'client';

    if ($password === $password_confirm) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (nama_user, email, password, alamat, no_hp, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $hashed_password, $address, $no_hp, $role);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: login.php");
            exit();
        } else {
            echo "Gagal: " . mysqli_error($koneksi);
        }
    } else {
        echo "Password dan Konfirmasi Password tidak sesuai.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background: linear-gradient(135deg, #4d675a, #175c3a);
        }
        .container {
            position: relative;
            max-width: 400px;
            width: 100%;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }
        .container .form .title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            position: relative;
            text-align: center;
        }
        .container .form .title::before {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background-color: #4070f4;
        }
        .container .form .input-field {
            position: relative;
            margin-top: 15px;
        }
        .container .form .input-field input,
        .container .form .input-field textarea {
            width: calc(100% - 40px);
            height: 40px;
            padding-left: 40px;
        }
        .container .form .input-field .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
        }
        .container .form .input-field .showHidePw {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .container .form .checkbox-text {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
        }
        .container .form .checkbox-content input[type="checkbox"] {
            margin-right: 5px;
        }
        .container .form .checkbox-content label.text {
            color: #333;
            font-size: 14px;
        }
        .container .form .submit {
            width: 100%;
            padding: 8px 0;
            border: none;
            background-color: #4070f4;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
        }
        .container .form .submit:hover {
            background-color: #305fbe;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <span class="title">Register</span>
            <form action="register.php" method="post">
                <div class="input-field">
                    <input type="text" name="nama" placeholder="Enter your name" required>
                    <i class="uil uil-user icon"></i>
                </div>
                <div class="input-field">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw" id="showHidePw"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="confirm_password" id="password_confirm" placeholder="Confirm Password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw" id="showHidePw"></i>
                </div>
                <div class="input-field">
                    <textarea name="alamat" placeholder="Enter your address" required></textarea>
                    <i class="uil uil-map-marked-alt icon"></i>
                </div>
                <div class="input-field">
                    <input type="tel" name="no_hp" placeholder="Enter your phone number" required>
                    <i class="uil uil-phone icon"></i>
                </div>
                <button type="submit" name="daftar" class="submit">Register</button>
            </form>
        </div>
    </div>
    <script>
        const passwordField = document.getElementById('password');
        const showHidePw = document.getElementById('showHidePw');
        const passwordConfirm = document.getElementById('password_confirm');

        showHidePw.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            showHidePw.classList.toggle('uil-eye');
            showHidePw.classList.toggle('uil-eye-slash');
        });
    </script>
</body>
</html>
