<?php
//クラスファイルの読み込み
require "connect.php";
//クラスの生成
$obj=new connect();
$sql="SELECT * FROM public.todo";
//変数の設定
$test=1;
//クラスの中の関数の呼び出し
$items=$obj->select($sql);

require "task.php";
$task = new TaskClass($name,$deadline,$fix_flg);
//登録
$task->registTask();

require "taskMgt.php";
$taskManager = new TaskMgtClass();
//未完了タスクを取得
$taskManager->getExpiredList();
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
                            <td>
                            <?php foreach($items as $item) : ?>
                            <p><?php echo $item['name']; ?></p>
                            <?php endforeach; ?>
                            </td>
                            <td>期限出力スペース</td>
                            <td>
                            <?php foreach($items as $item) : ?>
                            <p><?php echo $item['deadline']; ?></p>
                            <?php endforeach; ?>
                            </td>
                            <td>
                                <input type="button" value="完了">
                            </td>
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

