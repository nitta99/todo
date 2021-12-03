<?php
require "task.php";
$task = new TaskClass($name,$deadline,false);
if(isset($_POST['add'])){
    //登録
    $task->registTask();
    $check=$pdo->exec($sql);
    if($check){
        echo '成功';
    }else{
        echo '失敗';
    }
}
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
        <form action="index.php" method="post" name='todo'>
            <div>
                <h1>ToDoリスト</h1>
                <table>
                    <tr>
                        <td>タイトル</td>
                        <td>期限</td>
                    </tr>
                        <tr>
                            <td>タイトル出力スペース</td>
                                <td><?php echo htmlspecialchars(@$name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>期限出力スペース</td>
                                <td><?php echo htmlspecialchars(@$deadline, ENT_QUOTES, 'UTF-8'); ?></td>
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
                            <input type="text" name="name" value="">
                        </td>
                        <td>
                            <input type="date" name="deadline">
                        </td>
                        <td>
                            <input type="submit" name="add" value="登録">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>