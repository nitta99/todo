<?php
class TaskMgtClass{
    //タスク一覧
    public $tasklist;

    //未完了タスク一覧を取得するメソッド
    public function getIncompleteList(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = false ORDER BY id LIMIT :start, :max;";
        $result = $pdo->prepare($sql);

        if($now == 1){
            //1ページ目の処理
            $result->bindValue(":start",$now -1,PDO::PARAM_INT);
            $result->bindValue(":max",max_view,PDO::PARAM_INT);
        }else{
            $result->bindValue(":start",($now -1) * max_view,PDO::PARAM_INT);
            $result->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        $result->execute();
        $taskData = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach($taskData as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //完了タスク一覧を取得するメソッド
    public function getCompleteList(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = true ORDER BY id;";
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