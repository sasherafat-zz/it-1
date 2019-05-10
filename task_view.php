<?php
$page = 'panel';
$tab = '';
require './bootstrapper.php';
require './header.php';
?>
<?php
if(isset($_POST['edit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_at = $_POST['created_at'];
    if(isset($_POST['status']) && $_POST['status'] == 'done')
        $status = 1;
    elseif(isset($_POST['status']))
        $status = 0;
    else
        $status = null;
    $err = [];
    if($title == null || $content == null || $created_at == null || $status === null) {
        $err[] = 'همه فیلدها الزامی است';
    }
    if(count($err) == 0) {
        $query = $conn->prepare("update task set title = :title, content = :content, status = :status, created_at = :created_at where id = :task_id");
        $query->bindParam(':title', $title);
        $query->bindParam(':content', $content);
        $query->bindParam(':status', $status);
        $query->bindParam(':created_at', $created_at);
        $query->bindParam(':task_id', $_GET['task_id']);

        if($query->execute())
            echo "<div class=\"alert success\">تسک مورد نظر با موفقیت بروزرسانی شد.</div>";
        else
            echo "<div class=\"alert danger\">خطایی رخ داد.</div>";
    } else {
        foreach ($err as $message) {
            echo "<div class=\"alert danger\">".$message."</div>";
        }
    }
}
?>
<?php
if(isset($_POST['delete'])) {
    $query = $conn->prepare("delete from task where id = :task_id");
    $query->bindParam(':task_id', intval($_GET['task_id']));
    if($query->execute())
        $_SESSION['deleted'] = 1;
    else
        echo "<div class=\"alert danger\">خطایی رخ داد.</div>";
}
?>
<?php
$query = $conn->prepare("select * from task where user_id = :user_id AND id = :task_id");
$query->bindParam(':user_id', $user['id']);
$query->bindParam(':task_id', $_GET['task_id']);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
if(count($result))
    $task = $result[0];
else
    header('location: ./panel.php')
?>
<!-- Edit Cards -->
<form class="view_form" action="./task_view.php?task_id=<?php echo $task['id']; ?>" method="post">
    <input name="title" value="<?php echo $task['title']; ?>" placeholder="عنوان تسک" type="text" />
    <input name="content" value="<?php echo $task['content']; ?>" placeholder="توضیحات" type="text" />
    <input name="created_at" value="<?php echo $task['created_at']; ?>" placeholder="تاریخ ثبت" type="text" />
    <input <?php if($task['status']) { ?>checked<?php } ?>  type="radio" name="status" id="done" value="done"> <label for="done">انجام شده</label>
    <input <?php if(!$task['status']) { ?>checked<?php } ?> type="radio" name="status" id="not_done" value="not_done"> <label for="not_done">انجام نشده</label>
    <button type="submit" name="delete">حذف تسک</button>
    <button type="submit" name="edit">ذخیره تغییرات</button>
</form>
<?php
require './footer.php';
?>
