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
        $sql = sprintf("INSERT INTO public.todo (name, deadline, fix_flg) VALUES ('%s','%s',%s);", $this->name, $this->deadline, false);
        $pdo->exec ($sql);
        echo $sql;
        echo $this->name;
        echo $this->deadline;
        echo $this->fix_flg;
    }

    //タスクを更新するメソッド
    public function updateTask(){

    }
}
?>