<?php
require "task.php";
?>

<script type="text/javascript">
function edit(){
    <?php if($_POST['taskId']): ?>
        <?php $task = new TaskClass($_POST['name'],$_POST['deadline'],false); ?>
        <?php var_export($task->editTask($_POST['taskId'])); ?>
    <?php endif; ?>
}
window.onload = edit;

function editOnflg(name, deadline){
    check = window.confirm('このタスクを更新します');
    if (check){
        document.todo.taskName.value = name;
        document.todo.taskDeadline.value = deadline;
        document.todo.submit();
        return true;
    }else{
        return false;
    }
}
</script>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="todo.css" media="all" />
        <title>ToDoリスト編集</title>
    </head>
    <body>
        <form action="taskEdit.php" method="post" name='todo'>
            <div class="contact">
                <h1 class="titlearea">タスク編集</h1>
                <table class="textarea">
                    <tr>
                        <td>タイトル</td>
                        <td>
                            <input class="text" type="text" id="name" name="name" value="<?php echo htmlspecialchars(@$_POST['taskName'], ENT_QUOTES, 'UTF-8'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>期限</td>
                        <td>
                            <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars(@$_POST['taskDeadline'], ENT_QUOTES, 'UTF-8'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="editButton" type="button" onclick="editOnflg()" value="更新">
                        </td>
                        <td>
                            <input class="backButton" type="button" onclick="location.href='./index.php'" value="戻る">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>