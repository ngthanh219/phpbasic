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
      $title = htmlspecialchars($_POST['title']);
      $content = htmlspecialchars($_POST['content']);
      $time = date("Y-m-d H:i:s");
      $url_anh = htmlspecialchars($_POST['url_anh']);
      $tag = htmlspecialchars($_POST['tag']);
  
      $post = array(
        'title' => $title,
        'content' => $content,
        'time' => $time,
        'url_anh' => $url_anh,
        'tag' => $tag
      );
  
      session_start();
      if(strlen($title) < 5){
          $_SESSION['errorLength'] = "Yêu cầu nhập field title!!";
          header('Location: index.php?controller=New&action=create');
      }
        if(strlen($content) < 5){
          $_SESSION['errorLength1'] = "Yêu cầu nhập field content!!";
          header('Location: index.php?controller=New&action=create');
        }
          if(strlen($tag) < 3 ){
            $_SESSION['errorLength2'] = "Yêu cầu nhập field tag!!";
            header('Location: index.php?controller=New&action=create');
          }
            if(strlen($url_anh) < 10 ){
              $_SESSION['errorLength3'] = "Yêu cầu URL !!";
              header('Location: index.php?controller=New&action=create');
            }
      else{
        $items = MNews::stoge($post);
  
        $_SESSION["message1"] = "Thêm mới thành công";
         header('Location: index.php?controller=New&action=index');
        // $_SESSION["message"] = "Thêm mới thành công";
        //  header('Location: index.php?controller=New&action=index');
      }
    }
    
    public function update(){
      $id = isset($_GET['id']) ? $_GET['id'] : NULL;
      $items = MNews::getById($id);
      
      
      $data = array('tintuc' => $items);
      $this->render('form_update', $data);
       
  
    }
    public function doUpdate(){
      $id = isset($_POST['id']) ? $_POST['id'] : NULL;
      $title = htmlspecialchars($_POST['title']);
      $content = htmlspecialchars($_POST['content']);
      $time = date("Y-m-d H:i:s");
      $url_anh = htmlspecialchars($_POST['url_anh']);
      $tag = htmlspecialchars($_POST['tag']);
  
      $post = array(
        'id' => $id,
        'title' => $title,
        'content' => $content,
        'time' => $time,
        'url_anh' => $url_anh,
        'tag' => $tag
      );
      
      session_start();
      if(strlen($title) < 5){
          $_SESSION['errorLength'] = "Yêu cầu nhập field title!!";
          header('Location: index.php?controller=New&action=create');
      }
        if(strlen($content) < 5){
          $_SESSION['errorLength1'] = "Yêu cầu nhập field content!!";
          header('Location: index.php?controller=New&action=create');
        }
          if(strlen($tag) < 3 ){
            $_SESSION['errorLength2'] = "Yêu cầu nhập field tag!!";
            header('Location: index.php?controller=New&action=create');
          }
            if(strlen($url_anh) < 10 ){
              $_SESSION['errorLength3'] = "Yêu cầu URL !!";
              header('Location: index.php?controller=New&action=create');
            }
      else {
      $items = MNews::doUpdate($post);
      header('Location: index.php?controller=New&action=index');
      }
    }
  
    public function destroy(){
      $id = isset($_GET['id']) ? $_GET['id'] : NULL;
              MNews::delete($id);
              session_start();
              $_SESSION["message"] = "Xóa thành công";
              header('Location: index.php?controller=New&action=index');
    }
    }

?>