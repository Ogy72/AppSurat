<?php
    $val = new Validasi();
    if(isset($_POST["login"])){
       $msg = $val->login($_POST["username"], $_POST["password"]);
    } else {
        $msg = "<h4> Silahkan Login </h4>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>

    <!--css-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body background="img/bg.png" class="pl-2 pr-2">
    <div id="panel-login">
        <img src="img/logo.png" alt="" class="box-img" width="50px" height="50px">
        <h1> Selamat Datang </h1>
    <?php 
        echo $msg;
	?>
    
    <form action="" method="POST">
        <input type="text" name="username" class="form-login" placeholder="Username" required>
        <input type="password" name="password" class="form-login" placeholder="Password" required>

        <input type="submit" name="login" value="Login" class="btn2 btn-login">
    </form>

    </div>
</body>
</html>

