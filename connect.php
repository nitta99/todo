<?php
    //1ページに表示するタスク数をmax_viewに定数として定義
    define('max_view',5);

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

    //必要なページ数を求める
    $count = $pdo->prepare('SELECT COUNT(*) AS count FROM public.todo');
    $count->execute();
    $total_count = $count->fetch(PDO::FETCH_ASSOC);
    $pages = ceil($total_count['count'] / max_view);

    //現在のいるページのページ番号を取得
    if(!isset($_GET['page_id'])){
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
?>