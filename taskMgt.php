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
        try{
            $sql = "SELECT * FROM public.enquete WHERE 1 = 1";
            echo $sql;
            $pdo->exec($sql);
            return true;
        }catch(PDOException $e){
            echo "DB登録で例外が発生" . $e->getMessage();
            return false;
        }
    }
}
?>