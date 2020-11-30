<?php
    class MAccount{
        public $id;
        public $name;
        public $email;
        public $email_verified_at;
        public $password;
        public $remember_token;
        public $created_at;
        public $update_at;
        
        function __construct($id, $name, $email, $email_verified_at, $password, $remember_token, $created_at, $update_at)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->email_verified_at = $email_verified_at;
            $this->password = $password;
            $this->remember_token = $remember_token;
            $this->created_at = $created_at;
            $this->update_at = $update_at;
        }

        static function get()
        {
            $object = [];
            $db = DB::getInstance();
            $req = $db->query('SELECT * FROM users ORDER BY id DESC');
            foreach ($req->fetchAll() as $value) {
                $object[] = new MAccount($value['id'],$value['name'],$value['email'],$value['email_verified_at'],$value['password'],$value['remember_token'],$value['created_at'],$value['updated_at']);
            }
            return $object;
        }
        static function getById($id)
        {
            $object = [];
            $db = DB::getInstance();
            $req = $db->query('SELECT * FROM users WHERE id = '.$id);
            foreach ($req->fetchAll() as $value) {
                $object[] = new MAccount($value['id'],$value['name'],$value['email'],$value['email_verified_at'],$value['password'],$value['remember_token'],$value['created_at'],$value['updated_at']);
            }
            return $object;
        }

        static function stoge($object)
        {
            $db = DB::getInstance();
            $sql = "INSERT INTO phpbasic.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at)
            VALUES (null, '".$object['name']."', '".$object['email']."', '".$object['email_verified_at']."', '".$object['password']."', '".$object['remember_token']."', '".$object['created_at']."', '".$object['updated_at']."')";
            $db->query($sql);
        }

        static function update($object)
        {
            $db = DB::getInstance();
            $sql = "UPDATE phpbasic.users SET name = '".$object['name']."', password = '".$object['password']."', remember_token = '".$object['remember_token']."', updated_at = '".$object['updated_at']."' WHERE id = ".$object['id']."";
            $db->query($sql);
        }

        static function delete($id)
        {
            $db = DB::getInstance();
            $sql = "DELETE FROM phpbasic.users WHERE id = ".$id;
            $db->query($sql);
        }
    }
?>