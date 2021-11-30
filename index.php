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
                        <tr>
                            <td>タイトル出力スペース</td>
                            <td>期限出力スペース</td>
                        </tr>
                </table>
                <hr>
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

