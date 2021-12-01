<?php
class TaskClass{
    //ID
    public $id;

    //タイトルネーム
    public $name;

    //期限
    public $deadline;

    //完了フラグ
    public $fix_flg;

    function __construct(){
        $this->id = null;
        $this->name;
        $this->deadline;
        $this->fix_flg;
    }

    //タスクが完了済みか確認するメソッド
    public function completeTask(){

    }

    //タスクが期限切れか確認するメソッド
    public function expiredTask(){

    }

    //タスクを登録するメソッド
    public function registTask(){

    }

    //タスクを更新するメソッド
    public function updateTask(){

    }
}
?>