<?php
$NAME = $_POST['name'];
$DEADLINE = $_POST['deadline'];
$FIX_FLG = $_POST['fix_flg'];

require "connect.php";
$obj = new connect();
$sql = "SELECT * FROM public.todo";
$test = 1;
$items=$obj->select($sql);

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
                    <?php foreach($items as $item) : ?>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['deadline']; ?></td>
                    <?php endforeach; ?>
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

