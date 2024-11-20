<?php
$koneksi = mysqli_connect("localhost", "root", "", "toko_roti");
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

session_start();

$setfalse = "UPDATE users SET is_active = 0"; // Ini akan mempengaruhi semua pengguna, sesuaikan dengan logika Anda.
$koneksi->query($setfalse);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Melakukan query ke database untuk memeriksa kredensial pengguna
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi kata sandi
        if ($password == $user['password']) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama_user'] = $user['nama_user'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect berdasarkan peran pengguna
            $settrue = "UPDATE users SET is_active = 1 WHERE id_user = ?";
            $stmt = $koneksi->prepare($settrue);
            $stmt->bind_param("i", $user['id_user']);
            if ($stmt->execute()) {
                if ($user['role'] == 'admin') {
                    header("Location: dasbordAdmin.php");
                } else {
                    header("Location: landingPage.php");
                }
                exit();
            } else {
                die("Gagal menjalankan query update: " . $stmt->error);
            }
        } else {
            $error = "Kata sandi salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .container .form .title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
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
            height: 50px;
            width: 100%;
            margin-top: 30px;
        }

        h1 {
            text-align: center;
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }

        form {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 40px);
            height: 100%;
            padding-left: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
        }

        .showHidePw {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .checkbox-text {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 14px;
        }

        .checkbox-content {
            display: flex;
            align-items: center;
        }

        .checkbox-content input[type="checkbox"] {
            margin-right: 5px;
        }

        .checkbox-content label.text {
            color: #333;
        }

        a.text {
            color: #4070f4;
            text-decoration: none;
        }

        .submit {
            width: 100%;
            padding: 10px 0;
            border: none;
            background-color: #4070f4;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .submit:hover {
            background-color: #305fbe;
        }
    </style>

    <title>Login</title>
</head>

<body>
<div class="container">
        <div class="form">
            <span class="title">Login</span>
            <?php if(isset($error) && $error != ""): ?>
                <p style="color: red; text-align: center;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="input-field">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" id="password" placeholder="Password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw" id="showHidePw"></i>
                </div>

                <div class="checkbox-text">
                    <div class="checkbox-content">
                        <input type="checkbox" id="logCheck">
                        <label for="logCheck" class="text">Remember me</label>
                    </div>
                    <a href="#" class="text">Forgot password?</a>
                </div>

                <button type="submit" name="login" class="submit">Login</button>
            </form>
        </div>
        <p style="text-align: center; margin-top: 20px;">Belum punya akun? <a href="register.php" class="text">Daftar</a></p>
    </div>

    <script>
        const passwordField = document.getElementById('password');
        const showHidePw = document.getElementById('showHidePw');

        showHidePw.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            showHidePw.classList.toggle('uil-eye');
            showHidePw.classList.toggle('uil-eye-slash');
        });
    </script>
</body>
</html>