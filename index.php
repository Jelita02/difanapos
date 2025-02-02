<?php
require('koneksi.php');

session_start();

if (isset($_POST['submit'])) {

    $email = $_POST['txt_username'];
    $pass = $_POST['txt_pass'];
    
    $emailCheck = mysqli_real_escape_string($koneksi, $email);
    $passCheck = mysqli_real_escape_string($koneksi, $pass);
    

    if (!empty(trim($email)) && !empty(trim($pass))) {

        //select data berdasarkan username dari database
        $query = "SELECT * FROM user_detail WHERE user_email = '$email'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {

            $id = $row['id'];
            $userVal = $row['user_email'];
            $passVal = $row['user_password'];
            $userName = $row['user_fullname'];
            $level = $row['level'];
        }
        if ($num != 0) {
            if ($userVal == $email && $passVal == $pass) {

                $_SESSION['id'] = $id;
                $_SESSION['name'] = $userName;
                $_SESSION['level'] = $level;
                header('Location: home.php');
            } else {
                $error = 'user atau pass salah!!';
                //header('Location: index.php');
            }
        } else {
            $error = 'user tidak ditemukan';
            //header('Location: index.php');
        }
    } else {
        $error = 'Data tidak boleh kosong';
       // echo $error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DIFANA POS</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link href="css/login.css" rel="stylesheet"> -->

    

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="index.php" method="post">
                                            <div class="form-floating mb-3">
                                            <label for="inputEmail">Username</label>
                                                <input class="form-control" type="text" placeholder="username" name="txt_username"/>
                                                <!-- <label for="inputEmail">Username</label> -->
                                                <div  class=""><?php global $error; echo $error ?></div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <label for="inputPassword">Password</label>
                                                <input class="form-control" type="password" placeholder="password" name="txt_pass"/>
                                                <!-- <label for="inputPassword">Password</label> -->
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Lupa Password?</a>
                                                <button class="btn btn-success fs-5" type="submit" name="submit">Login</button>
                                            </div>
                                        </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>