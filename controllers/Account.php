<?php
    session_start();
    require_once('controllers/BaseController.php');
    require_once('models/MAccount.php');

    class AccountController extends BaseController{
        function __construct(){
            $this->folder = 'account';
                if(isset($_COOKIE['cookie'])){
                    $data = MAccount::checkCookie($_COOKIE['cookie']);
                    if($data){
                        foreach ($data as $value) {
                            $_SESSION['username'] = $value['name'];
                        }
                    }else{
                        unset($_SESSION['username']);
                        setcookie("cookie", "", time()-(60*60*24*7),"/");
                        unset($_COOKIE["cookie"]);
                        header('Location: index.php?controller=LogIn&action=index');
                    }
                }
                if(empty($_SESSION['username'])){
                    header('Location: index.php?controller=LogIn&action=index');
                }
        }
        public function index(){
            $items = MAccount::get();
            $data = array('account' => $items);
            $this->render('home', $data);
        }
        public function create(){
            if(empty($_GET['id'])){
                $items = MAccount::get();
                $data = array('account' => $items);
                $this->render('form', $data);
            }else{
                $id = isset($_GET['id']) ? $_GET['id'] : NULL;
                if(is_numeric($id)){
                    $item = MAccount::getById($id);
                    if(empty($item)){
                        header('Location: index.php?controller=Account&action=create');
                    }else{
                        $data = array('account' => $item);
                        $this->render('form', $data);
                    }
                }else{
                    header('Location: index.php?controller=Account&action=create');
                }               
            }
        }
        public function stoge(){
            $name = $_POST['name'];
            $email = $_POST["email"];
            $email_verified_at = date("Y-m-d H:i:s");
            $password = $_POST['password']; 
            $remember_token = $email.$password;
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");

            $object = array(
                "name"                  =>$name,
                "email"                 =>$email,
                "email_verified_at"     =>$email_verified_at,
                "password"              =>md5($password),
                "remember_token"        =>md5($remember_token),
                "created_at"            =>$created_at,
                "updated_at"            =>$updated_at
            );         
            session_start();
            $checkEmail = false;
            if(strlen($name) > 5 && strlen($name) < 50 && preg_match("/[a-zA-Z]/", $name)){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if(strlen($password) > 5 && strlen($password) < 15){
                        $data = MAccount::get();
                        foreach ($data as $value) {
                            if($value->email == $object['email']){
                                $checkEmail = true;
                            }
                        }
                        if($checkEmail){
                            $_SESSION["checkEmail"] = true;
                            $_SESSION["messageErrorEmail"] = "Email đã có người dùng";
                            header('Location: index.php?controller=Account&action=create');
                        }else{
                            MAccount::stoge($object);
                            $_SESSION["message"] = "Thêm mới thành công";
                            header('Location: index.php?controller=Account&action=index');
                        }
                    }else{
                        $_SESSION["checkErrorPass"] = true;
                        $_SESSION["messageErrorPass"] = "Password gồm 5 tới 15 ký tự";
                        header('Location: index.php?controller=Account&action=create');
                    }
                }else{
                    $_SESSION["checkErrorEmail"] = true;
                    $_SESSION["messageErrorEmail"] = "Hãy nhập đúng định dạng email";
                    header('Location: index.php?controller=Account&action=create');
                }
            }else{
                $_SESSION["checkErrorName"] = true;
                $_SESSION["messageErrorName"] = "Họ tên gồm 5 tới 50 ký tự";
                header('Location: index.php?controller=Account&action=create');
            }
        }

        public function update(){
            $id = isset($_GET['id']) ? $_GET['id'] : NULL;
            $name = $_POST['name'];
            $password = $_POST['password']; 
            $updated_at = date("Y-m-d H:i:s");

            $data = MAccount::get();
            foreach ($data as $value) {
                if($value->id == $id){
                    $email = $value->email;
                }
            }
            $remember_token = $email.$password;

            $object = array(
                "id"                    =>$id,
                "name"                  =>$name,
                "password"              =>md5($password),
                "remember_token"        =>md5($remember_token),
                "updated_at"            =>$updated_at
            );

            session_start();
            if(strlen($name) > 5 && strlen($name) < 50 && stripslashes($name)){
                if(strlen($password) > 5 && strlen($password) < 15){
                    MAccount::update($object);
                    $_SESSION["message"] = "Cập nhật thành công";
                    header('Location: index.php?controller=Account&action=index');
                }else{
                    $_SESSION["checkErrorPass"] = true;
                    $_SESSION["messageErrorPass"] = "Password gồm 5 tới 15 ký tự";
                    header('Location: index.php?controller=Account&action=create&id='.$id);
                }
            }else{
                $_SESSION["checkErrorName"] = true;
                $_SESSION["messageErrorName"] = "Họ tên gồm 5 tới 50 ký tự";
                header('Location: index.php?controller=Account&action=create&id='.$id);
            }
            
        }

        public function destroy(){
            $id = isset($_GET['id']) ? $_GET['id'] : NULL;
            MACcount::delete($id);
            session_start();
            $_SESSION["message"] = "Xóa thành công";
            header('Location: index.php?controller=Account&action=index');
        }
    }
?>