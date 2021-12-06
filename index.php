<?php
require "task.php";

require "taskMgt.php";
$taskManager = new TaskMgtClass();
//未完了タスクを取得
if (isset($_POST['inComplete'])){
    $tasklist = $taskManager->getIncompleteList();
}
//完了タスクを取得
if (isset($_POST['complete'])){
    $tasklist = $taskManager->getCompleteList();
}
//期限切れタスクを取得
if (isset($_POST['expired'])){
    $tasklist = $taskManager->getExpiredList();
}
//全てのタスクを取得
if (isset($_POST['all'])){
    $tasklist = $taskManager->getAllList();
}
?>

<script type="text/javascript">
function nameCheck(){
    if(isset($_POST['add'])){
        getName = document.todo.name.value;
        if(getName){
            return true;
        }else {
            alert("タイトルを入力してください");
            return false;
        }
    }
}

function regist(){
    <?php if($_POST['name']): ?>
        <?php $task = new TaskClass($_POST['name'],$_POST['deadline'],false); ?>
        var result ="<?php var_export($task->registTask()); ?>";
        if(result){
            alert('登録完了いたしました');
        }
    <?php endif; ?>
}
window.onload = regist;

</script>

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
                    <?php foreach ($tasklist as $data): ?>
                        <tr>
                            <td><?php echo $data[1]?></td>
                            <td><?php echo $data[2]?></td>
                            <td><input type="button" value="完了"></td>
                        </tr>
                    <?php endforeach; ?>
                        <tr>
                            <td><?php echo htmlspecialchars(@$_POST['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars(@$_POST['deadline'], ENT_QUOTES, 'UTF-8'); ?></td>
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
                            <input type="submit" name="add" value="登録">
                        </td>
                        <td>
                            <input type="submit" name="inComplete" value="未完了">
                        </td>
                        <td>
                            <input type="submit" name="complete" value="完了">
                        </td>
                        <td>
                            <input type="submit" name="expired" value="期限切れ">
                        </td>
                        <td>
                            <input type="submit" name="all" value="全て">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>