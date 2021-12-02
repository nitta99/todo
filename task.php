<?php
class TaskClass{
    //ID
    private $id;

    //タイトルネーム
    private $name;

    //期限
    private $deadline;

    //完了フラグ
    private $fix_flg;

    function __construct($name,$deadline,$fix_flg){
        $this->id = null;
        $this->name = $name;
        $this->deadline = $deadline;
        $this->fix_flg = $fix_flg;
    }

    //タスクが完了済みか確認するメソッド
    public function completeTask(){

    }

    //タスクが期限切れか確認するメソッド
    public function expiredTask(){

    }

    //タスクを登録するメソッド
    public function registTask(){
        require "connect.php";
        $sql = "INSERT INTO public.todo (name, deadline, fix_flg) VALUES ('$this->name', '$this->deadline', false);";
        echo $sql;
        $pdo->exec ($sql);
    }

    //タスクを更新するメソッド
    public function updateTask(){

    }
}
?>