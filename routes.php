<?php
    // Name controller and function in this controller
    $controllers = array(
        'Account' => ['index','create','stoge','update','destroy'],
        'LogIn' => ['index','logIn'],
        'New' => ['index']
    ); 
    // Check param url
    if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
        switch ($controller) {
            case 'Account':
                if($action == 'index'){
                    $action = 'index';
                }else if($action == 'create'){
                    $action = 'create';
                }else if($action == 'stoge'){
                    $action = 'stoge';
                }else if($action == 'update'){
                    $action = 'update';
                }else if($action == 'destroy'){
                    $action = 'destroy';
                }
                break;
            case 'LogIn':
                if($action == 'index'){
                    $action = 'index';
                }else if($action == 'logIn'){
                    $action = 'logIn';
                }else if($action == 'logOut'){
                    $action = 'logOut';
                }
                break;
             case 'New':
                    if($action == 'index'){
                        $action = 'index';
                    }
                    break;
            default:
                $controller = 'Account';
                $action = 'index';
                break;
        }
    }
    if(include_once('controllers/' . $controller . '.php')){
        include_once('controllers/' . $controller . '.php');
    }else{
        include_once('controllers/LogIn.php');
    }
    $klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller'; // create class control from url 
    
    $controller = new $klass;
    $controller->$action();
?>