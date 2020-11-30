<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="public/css/account.css">
    <link href="public/fontawesome/css/all.css" rel="stylesheet">
    <script type="text/javascript" src="public/fontawesome/js/all.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="menu">
                <ul>
                    <li><a href="index.php?controller=Account&action=index" title="Account">Quản lý account</a></li>
                    <li><a href="index.php?controller=New&action=index" title="Account">Quản lý new</a></li>
                </ul>
            </div>
            <div class="setting">
                <span class="info">User:
                    <?php
                        echo($_SESSION['username']);
                    ?>
                </span>
                <a href="index.php?controller=LogIn&action=LogOut" title="Log out"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>