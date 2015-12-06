<?php
    require_once 'database.php';
    session_start();
    $chat = new Chats;
    if (!empty($_POST['nickname'])) {
        $_SESSION['nickname'] = $_POST['nickname'];
    }
    if (!empty($_POST['message']) && !empty($_SESSION['nickname'])) {
        $message = $_POST['message'];
        $name = $_SESSION['nickname'];
        $chat->sendmessage($message, $name);
    }
    class Chats {
        public function __construct(){
            $this->sodb = new Database;
            $this->base = (object) '';
            $this->base->url = 'http://'.$_SERVER['SERVER_NAME'];
            $this->index();
        }

        public function index(){
            $return = array();
            $query = $this->sodb->db->prepare('SELECT * FROM messages');
            try {
                $query->execute();
                for ($i=0; $row = $query->fetch() ; $i++) {
                    $return[$i] = array();
                    foreach ($row as $key => $value) {
                        $return[$i][$key] = $value;
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
            $messages = $return;
            require_once 'templates/shouts.php';
        }

        public function join(){
            require_once 'templates/nickname.php';
        }

        public function send(){
            require_once 'templates/sendmessage.php';
        }

        public function sendmessage($message, $name)
        {
            echo $message . ' ' . $name;

            try {
                $queryStr = "INSERT INTO messages (nickname, message) VALUES('$name','$message')";
               $this->sodb->db->query($queryStr);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $this->index();
        }

    }
