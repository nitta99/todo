<?php
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    try{
        $pdo = new PDO($dsn, $url['user'], $url['pass']);
    }catch(Exception $e){
        echo 'error' .$e->getMesseage;
        die();
    }
    //エラーを表示してくれる。
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    return $pdo;

    //現在のページ番号を取得
    if(isset($_GET['page_id'])){
        $page = $_GET['page_id'];
    }else{
        $page = 1;
    }

    if($page > 1){
        $start = ($page * 5) - 5;
    }else{
        $start = 0;
    }

    //必要なページ数取得
    $count = $pdo->prepare("SELECT COUNT(*) AS count FROM public.todo;");
    $count->execute();
    $count = $count->fetchColumn();
    $pages = ceil($count / 5);

?>