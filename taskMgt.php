<?php
class TaskMgtClass{
    //タスク一覧
    public $tasklist;

    //未完了タスク一覧を取得するメソッド
    public function getIncompleteList($page_id = 1){
        require "connect.php";
        $sql = sprintf("SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = false ORDER BY id LIMIT 5 OFFSET %d;",5 * ($page_id - 1));
        echo $sql;
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //完了タスク一覧を取得するメソッド
    public function getCompleteList($page_id = 1){
        require "connect.php";
        $sql = sprintf("SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = true ORDER BY id LIMIT 5 OFFSET %d;",5 * ($page_id - 1));
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限切れタスク一覧を取得するメソッド
    public function getExpiredList(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE deadline < CURRENT_DATE ORDER BY id;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //全てのタスク一覧を取得するメソッド
    public function getAllList(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo ORDER BY id;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }
}
?>