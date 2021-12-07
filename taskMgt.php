<?php
class TaskMgtClass{
    //タスク一覧
    public $tasklist;

    //未完了タスク一覧を取得するメソッド
    public function getIncompleteList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo WHERE fix_flg = false;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[0], $data[1], $data[2], $data[3]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //完了タスク一覧を取得するメソッド
    public function getCompleteList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo WHERE fix_flg = true;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[0], $data[1], $data[2], $data[3]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限切れタスク一覧を取得するメソッド
    public function getExpiredList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo WHERE deadline < CURRENT_DATE;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[0], $data[1], $data[2], $data[3]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //全てのタスク一覧を取得するメソッド
    public function getAllList(){
        require "connect.php";
        $sql = "SELECT * FROM public.todo;";
        $result = $pdo->exec($sql);
        foreach($result as $data){
            $task = new TaskClass($data[0], $data[1], $data[2], $data[3]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }
}
?>