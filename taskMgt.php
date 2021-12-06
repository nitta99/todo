<?php
class TaskMgtClass{
    //タスク一覧
    public $tasklist;

    //未完了タスク一覧を取得するメソッド
    public function getIncompleteList(){
        require "connect.php";
        try{
            $sql = "SELECT * FROM public.todo WHERE fix_flg = false;";
            echo $sql;
            $pdo->query($sql);
            return true;
        }catch(PDOException $e){
            echo "DB登録で例外が発生" . $e->getMessage();
            return false;
        }
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
        try{
            $sql = "SELECT * FROM public.todo WHERE 1 = 1;";
            $pdo->exec($sql);
            return true;
        }catch(PDOException $e){
            echo "DB登録で例外が発生" . $e->getMessage();
            return false;
        }
    }
}
?>