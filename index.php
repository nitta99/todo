<?php
require "task.php";

require "taskMgt.php";
$taskManager = new TaskMgtClass();
//未完了タスクを取得
$tasklist[] = $taskManager->getIncompleteList();
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

window.onload = function(){
    <?php if($_POST['name']): ?>
        <?php $task = new TaskClass($_POST['name'],$_POST['deadline'],false); ?>
        var result ="<?php var_export($task->registTask()); ?>";
        if(result){
            alert('登録完了いたしました');
        }
    <?php endif; ?>
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
                    <?php foreach ($tasklist as $data): ?>
                        <tr>
                            <td><?php echo $data[1]?></td>
                            <td><?php echo $data[2]?></td>
                        </tr>
                    <?php endforeach; ?>
                        <tr>
                            <td><?php echo htmlspecialchars(@$_POST['name'], ENT_QUOTES, 'UTF-8'); ?></td>
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
                            <input type="text" id="name" name="name" value="">
                        </td>
                        <td>
                            <input type="date" id="deadline" name="deadline" value="">
                        </td>
                        <td>
                            <input type="submit" value="登録">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>