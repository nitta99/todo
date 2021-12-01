<?php
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);

    $NAME = $_POST['name'];
    $DEADLINE = $_POST['deadline'];
    $FIX_FLG = $_POST['fix_flg'];
?>