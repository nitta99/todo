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
        $sql = sprintf("INSERT INTO public.todo (name, deadline, fix_flg) VALUES ('%s', '%s', %s);", $this->name, $this->deadline, false);
        $pdo->exec($sql);
        $check=$pdo->exec($sql);
        if($check){
            echo '成功';
        }else{
            echo '失敗';
        }
        echo $sql;
    }

    //タスクを更新するメソッド
    public function updateTask(){

    }
}
?>