<?php
class TaskClass{
    //ID
    protected $id;

    //タイトルネーム
    protected $name;

    //期限
    protected $deadline;

    //完了フラグ
    protected $fix_flg;

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