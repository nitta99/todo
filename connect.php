<?php
class connect {
    //データベースに接続する関数
    function pdo(){
        $url = parse_url(getenv('DATABASE_URL'));
        $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
        $pdo = new PDO($dsn, $url['user'], $url['pass']);
    }

}
?>