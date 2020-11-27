<?php
    require_once('controllers/BaseController.php');
    require_once('models/MAccount.php');

    class LogInController extends BaseController{
        function __construct(){
            $this->folder = 'login';
        }
        public function index(){
            $this->render('login');
        }
        public function logIn(){
            $checkLogIn = false;
            $username = $_POST['username'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']) ? $_POST['remember'] : 'off';

            $md5Info = md5($username.$password);


            $object = array(
                'email'     => $username,
                'password'  => md5($password)
            );

            $dataAcc = MAccount::get();
            foreach ($dataAcc as $value) {
                if($md5Info == $value->remember_token){
                    $checkLogIn = true;
                    $infoName = $value->name;
                    $infoEmail = $value->email;
                    echo '<pre>';
                    var_dump($value->remember_token);
                    echo '</pre>';
                }
            }
            
            session_start();
            if($checkLogIn){
                $_SESSION["username"] = $infoEmail;
                $_SESSION["message"] = "Xin chào: ".$infoName;
                if($remember == 'on'){
                    setcookie('cookie', $md5Info,  time() + (86400 * 30), "/"); 
                }
                $items = MAccount::get();
                $data = array('account' => $items);
                $this->render('home', $data);
            }else{
                $_SESSION["message"] = "Tài khoản không hợp lệ";
                header('Location: index.php?controller=LogIn&action=index');
            }
        }
        public function logOut(){
            session_start();
            unset($_SESSION['username']);
            setcookie("cookie", "", time()-(60*60*24*7),"/");
            unset($_COOKIE["cookie"]);
            header('Location: index.php?controller=LogIn&action=index');
        }
    }
?>