<?php
require "connect.php";
define('max_page',5);
//必要なページ数取得
$count = $pdo->prepare("SELECT COUNT(*) AS count FROM public.todo;");
$count->execute();
$total_count = $count->fetch(PDO::FETCH_ASSOC);
$pages = (int)ceil($total_count['count'] / max_page);

//現在のページ番号を取得
if(!isset($_GET['page_id'])){
    $now = 1;
}else{
    $now = $_GET['page_id'];
}

require "task.php";

require "taskMgt.php";
$taskManager = new TaskMgtClass();
//未完了タスクを取得
if (isset($_POST['inComplete'])){
    $tasklist = $taskManager->getIncompleteList($_GET['page_id']);
    $selectTask = "未完了タスク一覧";
}
//完了タスクを取得
if (isset($_POST['complete'])){
    $tasklist = $taskManager->getCompleteList();
    $selectTask = "完了タスク一覧";
}
//期限切れタスクを取得
if (isset($_POST['expired'])){
    $tasklist = $taskManager->getExpiredList();
    $selectTask = "期限切れタスク一覧";
}
//全てのタスクを取得
if (isset($_POST['all'])){
    $tasklist = $taskManager->getAllList();
    $selectTask = "全タスク一覧";
}
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

function regist(){
    <?php if(($_POST['name'])): ?>
        <?php $task = new TaskClass($_POST['name'],$_POST['deadline'],false); ?>
        result ="<?php var_export($task->registTask()); ?>";
        if(result){
            alert("登録完了しました");
        }
    <?php endif; ?>
    <?php if($_POST['taskId']): ?>
        <?php $task = new TaskClass($_POST['name'],$_POST['deadline'],false); ?>
        result = "<?php var_export($task->updateTask($_POST['taskId'])); ?>";
        if (result){
            alert("タスクが完了しました");
        }
    <?php endif; ?>
}
window.onload = regist();

function updateOnflg(id){
    check = window.confirm('このタスクを完了します');
    if (check){
        document.todo.taskId.value = id;
        document.todo.submit();
    }
}

function editOnflg(id, name, deadline){
    check = window.confirm('このタスクを編集します');
    if (check){
        document.todo.action = 'taskEdit.php';
        document.todo.taskId.value = id;
        document.todo.taskName.value = name;
        document.todo.taskDeadline.value = deadline;
        document.todo.submit();
    }
}

</script>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="todo.css" media="all" />
        <title>ToDoリスト</title>
    </head>
    <body>
        <form action="index.php" method="post" name='todo'>
            <input type="hidden" name="taskId" value="" >
            <input type="hidden" name="taskName" value="" >
            <input type="hidden" name="taskDeadline" value="" >
            <div class="contact">
                <h1 class="titlearea">ToDoリスト</h1>
                <table class="listarea">
                    <tr>
                        <?php if(isset($_POST['inComplete'])): ?>
                            <td class="font-change"><font color="black"><?php echo $selectTask; ?></font></td>
                        <?php endif; ?>
                        <?php if(isset($_POST['complete'])): ?>
                            <td class="font-change"><font color="gray"><?php echo $selectTask; ?></font></td>
                        <?php endif; ?>
                        <?php if(isset($_POST['expired'])): ?>
                            <td class="font-change"><font color="#ff7f50"><?php echo $selectTask; ?></font></td>
                        <?php endif; ?>
                        <?php if(isset($_POST['all'])): ?>
                            <td class="font-change"><font color="skyblue"><?php echo $selectTask; ?></font></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th class="font-change">タイトル</th>
                        <th class="font-change">期限</th>
                    </tr>
                    <?php foreach ($tasklist as $task): ?>
                        <tr>
                            <?php if ($task->expiredTask() && !$task->completeTask()): ?>
                                <td class="font_red"><?php echo $task->getName(); ?></td>
                                <td class="font_red"><?php echo $task->getDeadline(); ?></td>
                                <td>
                                    <input class="expiredButton" type="button" onclick="updateOnflg(<? echo $task->getId() ?>)" value="完了">
                                </td>
                                <td>
                                    <input class="editButton" type="button" onclick="editOnflg(<? echo $task->getId() ?>, '<? echo $task->getName() ?>' , '<? echo $task->getDeadline() ?>')" value="編集">
                                </td>
                            <?php elseif($task->expiredTask() && $task->completeTask()): ?>
                                <td class="font_red"><?php echo $task->getName(); ?></td>
                                <td class="font_red"><?php echo $task->getDeadline(); ?></td>
                                <td>
                                    <input class="editButton" type="button" onclick="editOnflg(<? echo $task->getId() ?>, '<? echo $task->getName() ?>', '<? echo $task->getDeadline() ?>')" value="編集">
                                </td>
                            <?php elseif($task->completeTask()): ?>
                                <td class="font_gray"><?php echo $task->getName(); ?></td>
                                <td class="font_gray"><?php echo $task->getDeadline(); ?></td>
                                <td>
                                    <input class="editButton" type="button" onclick="editOnflg(<? echo $task->getId() ?>, '<? echo $task->getName() ?>', '<? echo $task->getDeadline() ?>')" value="編集">
                                </td>
                            <?php else: ?>
                                <td class="font_black"><?php echo $task->getName(); ?></td>
                                <td class="font_black"><?php echo $task->getDeadline(); ?></td>
                                <td>
                                    <input class="inCompleteButton" type="button" onclick="updateOnflg(<? echo $task->getId() ?>)" value="完了">
                                </td>
                                <td>
                                    <input class="editButton" type="button" onclick="editOnflg(<? echo $task->getId() ?>, '<? echo $task->getName() ?>', '<? echo $task->getDeadline() ?>')" value="編集">
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td class="font-change"><?php echo htmlspecialchars(@$_POST['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="font-change"><?php echo htmlspecialchars(@$_POST['deadline'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <?php if(isset($_POST['inComplete']) || isset($_POST['complete']) || isset($_POST['expired']) || isset($_POST['all'])): ?>
                    <tr>
                        <td><?php echo '全件数'.$total_count['count'].'件'; ?></td>
                        <?php if($now > 1): ?>
                            <td><a href="index.php?page_id=<?php $now - 1 ?>">前のページ＜</a></td>
                        <?php else: ?>
                            <td><?php echo "前のページ＜" ?></td>
                        <?php endif; ?>
                        <?php for($i = 1;$i <= $pages;$i++): ?>
                            <?php if($i == $now): ?>
                                <td><?php echo $now; ?></td>
                            <?php else: ?>
                            <td><a href="index.php?page_id=<?php $i ?>"><?php echo $i; ?></a></td>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if($now < $pages): ?>
                            <td><a href="index.php?page_id=<?php $now + 1 ?>">＞次のページ</a></td>
                        <?php else: ?>
                            <td><?php echo "次のページ＜" ?></td>
                        <?php endif; ?>
                        <?php var_dump($now); ?>
                        <?php var_dump($pages); ?>
                    </tr>
                    <?php endif; ?>
                </table>
                <hr class="hr-border">
                <table class="buttonarea">
                    <tr>
                        <td>
                            <input class="inCompleteButton" type="submit" name="inComplete" value="未完了">
                        </td>
                        <td>
                            <input class="completeButton" type="submit" name="complete" value="完了">
                        </td>
                        <td>
                            <input class="expiredButton" type="submit" name="expired" value="期限切れ">
                        </td>
                        <td>
                            <input class="allButton" type="submit" name="all" value="全て">
                        </td>
                    </tr>
                </table>
                <table class="textarea">
                    <tr>
                        <td>
                            <input class="text" type="text" id="name" name="name" value="">
                        </td>
                        <td>
                            <input type="date" id="deadline" name="deadline" value="">
                        </td>
                        <td>
                            <input class="registButton" type="submit" value="登録" onclick="nameCheck();regist()">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>