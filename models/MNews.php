<?php
class MNews {
  public $id;
  public $title;
  public $content;
  public $time;
  public $url_anh;
  public $tag;

  function __construct($id, $title, $content, $time, $url_anh, $tag)
        {
            $this->id = $id;
            $this->title = $title;
            $this->content = $content;
            $this->time = $time;
            $this->url_anh = $url_anh;
            $this->tag = $tag;
          
        }
    static function get(){
      $object = [];
      $db = DB::getInstance();
      $result = $db->query("SELECT * FROM mvc_post ORDER BY id DESC");
      foreach($result->fetchAll() as $value){
          $object[] = new MNews($value['id'], $value['title'], $value['content'], $value['time'], $value['url_anh'] ,$value['tag'] );
      }
      return $object;
    }

    static function stoge($post){
      $db = DB::getInstance();
           $sql = "INSERT INTO mvc_post (id, title, content, time, url_anh, tag)
         VALUES (null, '".$post['title']."', '".$post['content']."', '".$post['time']."', '".$post['url_anh']."', '".$post['tag']."')";
            $db->query($sql);
    }

    static function getById($id){
      $object = [];
      $db = DB::getInstance();
      $result = $db->query("SELECT * FROM mvc_post WHERE id = " .$id );
      foreach($result->fetchAll() as $value){
        $object[] = new MNews($value['id'], $value['title'], $value['content'], $value['time'], $value['url_anh'] ,$value['tag'] );
      }
      return $object;
      }

      static function doUpdate($post){
        $db = DB::getInstance();
        $sql = "UPDATE `mvc_post` SET title = '".$post['title']."', content = '".$post['content']."' , time = '".$post['time']."', url_anh = '".$post['url_anh']."', tag = '".$post['tag']."' 
        WHERE id = ".$post['id'];
        return $db->query($sql);
      }

      static function delete($id){
        $db = DB::getInstance();
        $sql = "DELETE FROM mvc_post WHERE id=" .$id;
        $db->query($sql);
      }
}
?>