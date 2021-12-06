<?php
class TaskMgtClass{
    //タスク一覧
    public $tasklist;

    //未完了タスク一覧を取得するメソッド
    public function getIncompleteList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo WHERE fix_flg = false;";
        $result = $pdo->query($sql);
        return $result;
    }

    //完了タスク一覧を取得するメソッド
    public function getCompleteList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo WHERE fix_flg = true;";
        $result = $pdo->query($sql);
        return $result;
    }

    //期限切れタスク一覧を取得するメソッド
    public function getExpiredList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo WHERE deadline < CURRENT_DATE;";
        $result = $pdo->query($sql);
        return $result;
    }

    //全てのタスク一覧を取得するメソッド
    public function getAllList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo WHERE 1 = 1;";
        $result = $pdo->exec($sql);
        return $result;
    }
}
?>