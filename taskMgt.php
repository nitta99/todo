<?php
class TaskMgtClass{
    //タスク一覧
    public $tasklist;

    //未完了タスク一覧を取得するメソッド
    public function getIncompleteList(){

    }

    //完了タスク一覧を取得するメソッド
    public function getCompleteList(){

    }

    //期限切れタスク一覧を取得するメソッド
    public function getExpiredList(){

    }

    //全てのタスク一覧を取得するメソッド
    public function getAllList(){
        require "connect.php";
        $query = "SELECT * FROM public.todo WHERE 1 = 1";
        $stmt = $pdo->query($query);
        return $this->tasklist;
    }
}
?>