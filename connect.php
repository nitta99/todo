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

    //データ数取得
    $count = "SELECT COUNT(*) AS count FROM public.todo;";
    $res = pg_query($pdo,$count or die("データ抽出エラー"));
    $row = pg_fetch_array($res,0,PGSQL_ASSOC);
    $dtcnt = $row['count'];

    //取り出す最大レコード数
    $lim = 10;

    //表示するページ位置を取得
    $p = intval(@$_GET['p']);
    if ($p < 1){
        $p = 1;
    }

    //表示するデータ位置を取得
    $st = ($p - 1) * $lim;

    // 前のページ／次のページのページ番号を取得する
    $prev = $p - 1;
    if ($prev < 1) {
        $prev = 1;
    }
    $next = $p + 1;
?>