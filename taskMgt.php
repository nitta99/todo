<?php
class TaskMgtClass{
    //タスク一覧
    public $tasklist;

    //未完了タスク一覧を取得するメソッド
    public function getIncompleteList($page_id = 1){
        require "connect.php";
        $sql = sprintf("SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = false ORDER BY id LIMIT 5 OFFSET %d;",5 * ($page_id - 1));
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
    public function getExpiredList($page_id = 1){
        require "connect.php";
        $sql = sprintf("SELECT id, name, deadline, fix_flg FROM public.todo WHERE deadline < CURRENT_DATE ORDER BY id LIMIT 5 OFFSET %d;",5 * ($page_id - 1));
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //全てのタスク一覧を取得するメソッド
    public function getAllList($page_id = 1){
        require "connect.php";
        $sql = sprintf("SELECT id, name, deadline, fix_flg FROM public.todo ORDER BY id LIMIT 5 OFFSET %d;",5 * ($page_id - 1));
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    // //必要ページを取得するメソッド
    // public function getPages(){
    //     require "connect.php";
    //     //必要なページ数取得
    //     $count_sql = "SELECT COUNT(*) AS count FROM public.todo WHERE fix_flg = false;";

    //     //現在のページ番号を取得
    //     if(isset($_GET['page_id']) && is_numeric($_GET['page_id'])){
    //         $now = $_GET['page_id'];
    //     }else{
    //         $now = 1;
    //     }

    //     $count = $pdo->query($count_sql);
    //     $total_count = $count->fetch(PDO::FETCH_ASSOC);
    //     $pages = (int)ceil($total_count['count'] / 5);

    //     $from_record = ($now - 1) * 5 + 1;
    //     if($now == $pages && $total_count['count'] % 5 !== 0){
    //         $to_record = ($now - 1) * 5 + $total_count['count'] % 5;
    //     }else{
    //         $to_record = $now * 5;
    //     }

    // }

    //名前の昇順でタスク一覧を取得するメソッド（未完了）
    public function getIncompleteNameAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = false ORDER BY name ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //名前の降順でタスク一覧を取得するメソッド（未完了）
    public function getIncompleteNameDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = false ORDER BY name DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //名前の昇順でタスク一覧を取得するメソッド（完了）
    public function getCompleteNameAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = true ORDER BY name ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //名前の降順でタスク一覧を取得するメソッド（完了）
    public function getCompleteNameDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = true ORDER BY name DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //名前の昇順でタスク一覧を取得するメソッド（期限切れ）
    public function getDeadlineNameAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE deadline < CURRENT_DATE ORDER BY name ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //名前の降順でタスク一覧を取得するメソッド（期限切れ）
    public function getDeadlineNameDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE deadline < CURRENT_DATE ORDER BY name DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //名前の昇順でタスク一覧を取得するメソッド（全て）
    public function getAllNameAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo ORDER BY name ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //名前の降順でタスク一覧を取得するメソッド（全て）
    public function getAllNameDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo ORDER BY name DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の昇順でタスク一覧を取得するメソッド(未完了)
    public function getIncompleteExpiredAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = false ORDER BY deadline ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の降順でタスク一覧を取得するメソッド(未完了)
    public function getIncompleteExpiredDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = false ORDER BY deadline DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の昇順でタスク一覧を取得するメソッド(完了)
    public function getCompleteExpiredAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = true ORDER BY deadline ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の降順でタスク一覧を取得するメソッド(完了)
    public function getCompleteExpiredDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE fix_flg = true ORDER BY deadline DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の昇順でタスク一覧を取得するメソッド(期限切れ)
    public function getDeadlineExpiredAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE deadline < CURRENT_DATE ORDER BY deadline ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の降順でタスク一覧を取得するメソッド(期限切れ)
    public function getDeadlineExpiredDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo WHERE deadline < CURRENT_DATE ORDER BY deadline DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の昇順でタスク一覧を取得するメソッド(全て)
    public function getAllExpiredAsc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo ORDER BY deadline ASC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }

    //期限の降順でタスク一覧を取得するメソッド(全て)
    public function getAllExpiredDesc(){
        require "connect.php";
        $sql = "SELECT id, name, deadline, fix_flg FROM public.todo ORDER BY deadline DESC;";
        $result = $pdo->query($sql);
        foreach($result as $data){
            $task = new TaskClass($data[1], $data[2], $data[3], $data[0]);
            $this->tasklist[] = $task;
        }
        return $this->tasklist;
    }
}
?>