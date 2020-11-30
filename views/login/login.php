<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <div class="center-login-form">
            <div class="banner-company">
                <img src="public/images/Sun-Logotype-RGB-01.png" alt=""class="sun">
                <a href="#" class="login">Login</a>
                <a href="#" class="register">Register</a>
            </div>
            <p class="error-text">
                <?php
                    session_start();
                    if(isset($_SESSION['message'])){
                        echo($_SESSION['message']);
                        unset($_SESSION['message']);
                    }
                ?>
            </p>
            <form action="index.php?controller=LogIn&action=logIn" method="POST">
                <div class="login-banner">
                    <p class="text-username">Username</p>
                    <input type="text" name="username" class="input-username"> 
                    <p class="text-password">Password</p>
                    <input type="password" name="password" class="input-password" autocomplete="off">
                    <div class="button">
                    <div class="check">
                        <input type="checkbox" name="remember">Remember me 
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>