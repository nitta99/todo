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

    //必要なページ数取得
    $count = $pdo->prepare("SELECT COUNT(*) AS count FROM public.todo;");
    $count->execute();
    $total_count = $count->fetch(PDO::FETCH_ASSOC);
    $pages = ceil($total_count['count'] / 5);

    //現在のページ番号を取得
    if(!isset($_GET['page_id'])){
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
?>