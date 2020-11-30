<?php
    session_start();
    require_once('controllers/BaseController.php');
    require_once('models/MAccount.php');
    require_once('models/MNews.php');

    class NewController extends BaseController{
       function __construct(){
          $this->folder = 'news';
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


       public function index() {
           $items = MNews::get();
           $data = array('tintuc' => $items);
           $this->render('home', $data);
       }

       public function create(){
    
        $this->render('form_add'); 
    }
  
    public function stoge(){
      $title = $_POST['title'];
      $content = $_POST['content'];
      $time = date("Y-m-d H:i:s");
      $url_anh = $_POST['url_anh'];
      $tag = $_POST['tag'];
  
      $post = array(
        'title' => $title,
        'content' => $content,
        'time' => $time,
        'url_anh' => $url_anh,
        'tag' => $tag
      );
  
      session_start();
      if(strlen($title) < 5 && strlen($content) < 5 && strlen($tag) < 3){
        $_SESSION['errorLength'] = "Phải trên 5 kí tự !!";
        header('Location: index.php?controller=home_controller&action=create');
  
      }else{
        $items = Model::stoge($post);
  
        $_SESSION["message1"] = "Thêm mới thành công";
         header('Location: index.php?controller=home_controller&action=index');
        // $_SESSION["message"] = "Thêm mới thành công";
        //  header('Location: index.php?controller=home_controller&action=index');
      }
    }
    
    public function update(){
      $id = isset($_GET['id']) ? $_GET['id'] : NULL;
      $items = Model::getById($id);
      
      
      $data = array('tintuc' => $items);
      $this->render('form_update', $data);
       
  
    }
    public function doUpdate(){
      $id = isset($_POST['id']) ? $_POST['id'] : NULL;
      $title = $_POST['title'];
      $content = $_POST['content'];
      $time = $_POST['time'];
      $url_anh = $_POST['url_anh'];
      $tag = $_POST['tag'];
  
      $post = array(
        'id' => $id,
        'title' => $title,
        'content' => $content,
        'time' => $time,
        'url_anh' => $url_anh,
        'tag' => $tag
      );
  
      $items = Model::doUpdate($post);
      header('Location: index.php?controller=home_controller&action=index');
    }
  
    public function destroy(){
      $id = isset($_GET['id']) ? $_GET['id'] : NULL;
              Model::delete($id);
              session_start();
              $_SESSION["message"] = "Xóa thành công";
              header('Location: index.php?controller=home_controller&action=index');
    }
    }

?>