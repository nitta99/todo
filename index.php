<!-- <?php
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);

    $NAME = $_POST['name'];
    $DEADLINE = $_POST['deadline'];
    $FIX_FLG = $_POST['fix_flg'];

    $sql = "INSERT INTO public.todo VALUES ('$NAME', '$DEADLINE', '$FIX_FLG');";
    $pdo->exec ($sql);
?> -->
<?php
require "task.php";
$task = new TaskClass($name,$deadline,$fix_flg);
$task->registTask();

require "taskMgt.php";
$taskManager = new TaskMgtClass();
$taskManager->expiredList();
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ToDoリスト</title>
    </head>
    <body>
        <form action="index.php" method="post">
            <div>
                <h1>ToDoリスト</h1>
                    <table>
                    <tr>
                        <td>タイトル</td>
                        <td>期限</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>タイトル</td>
                        <td>期限</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" />
                        </td>
                        <td>
                            <input type="date" />
                        </td>
                        <td>
                            <input type="submit" value="登録" />
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </body>

