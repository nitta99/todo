<?php
require "task.php";
$task = new TaskClass($_POST['name'],$_POST['deadline'],false);
if(isset($_POST['add'])){
    //登録
    $result = $task->registTask();
    if ($result) {
        echo "登録成功";
    } else {
        echo "登録失敗";
    }
}
require "taskMgt.php";
$taskManager = new TaskMgtClass();
//未完了タスクを取得
$taskManager->getExpiredList();
?>

<script type="text/javascript">
function nameCheck(){
    getName = document.todo.name.value;
    if(getName){
        return true;
    }else {
        alert("タイトルを入力してください");
        return false;
    }
}

</script>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ToDoリスト</title>
    </head>
    <body>
        <form action="index.php" method="post" name='todo'
            onsubmit="return(nameCheck())">
            <div>
                <h1>ToDoリスト</h1>
                <table>
                    <tr>
                        <td>タイトル</td>
                        <td>期限</td>
                    </tr>
                        <tr>
                            <td>タイトル出力スペース</td>
                                <td><?php echo htmlspecialchars(@$_POST['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>期限出力スペース</td>
                                <td><?php echo htmlspecialchars(@$_POST['deadline'], ENT_QUOTES, 'UTF-8'); ?></td>
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
                            <input type="date" name="deadline" value="">
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