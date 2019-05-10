<?php
$page = 'panel';
$tab = 'add_task';
require './bootstrapper.php';
require './header.php';
?>
<?php
if(isset($_POST['add_task'])) {
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
        $query = $conn->prepare("insert into task(user_id, title, content, status, created_at) values(:user_id, :title, :content, :status, :created_at)");
        $query->bindParam(':user_id', $user['id']);
        $query->bindParam(':title', $title);
        $query->bindParam(':content', $content);
        $query->bindParam(':status', $status);
        $query->bindParam(':created_at', $created_at);

        if($query->execute())
            echo "<div class=\"alert success\">تسک مورد نظر با موفقیت اضافه شد.</div>";
        else
            echo "<div class=\"alert danger\">خطایی رخ داد.</div>";
    } else {
        foreach ($err as $message) {
            echo "<div class=\"alert danger\">".$message."</div>";
        }
    }
}
?>
<!-- Add Cards -->
<form class="view_form" action="./task_add.php" method="post">
    <input name="title" placeholder="عنوان تسک" type="text" />
    <input name="content" placeholder="توضیحات" type="text" />
    <input name="created_at" placeholder="تاریخ ثبت" type="text" />
    <input type="radio" name="status" id="done" value="done"> <label for="done">انجام شده</label>
    <input type="radio" name="status" id="not_done" value="not_done"> <label for="not_done">انجام نشده</label>
    <button type="submit" name="add_task">افزودن تسک</button>
</form>
<?php
require './footer.php';
?>
