<?php
    require_once('connection.php');

    if(isset($_GET['controller']) || isset($_GET['action'])){
        $controller = $_GET['controller'];
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = 'index';
        }
    }else{
        $controller = 'Account';
        $action = 'index';
    }
    
    require_once('routes.php');
?>