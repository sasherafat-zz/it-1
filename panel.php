<?php
$page = 'panel';
$tab = 'dashboard';
require './bootstrapper.php';
require './header.php';
?>
<!-- Fetch User's Cards -->
<table class="task_table">
    <tr>
        <th>عنوان کارت</th>
        <th>توضیحات</th>
        <th>تاریخ ثبت</th>
        <th>وضعیت</th>
        <th>جزئیات</th>
    </tr>
    <?php
    if(isset($_GET['action'])) {
        $query = $conn->prepare("update task set status = :status where user_id = :user_id AND id = :task_id");
        $query->bindParam(':user_id', $user['id']);
        $query->bindParam(':task_id', $_GET['task_id']);
        $query->bindParam(':status', $_GET['action']);
        if($query->execute())
            echo "<div class=\"alert success\">تسک مورد نظر با موفقیت بروزرسانی شد.</div>";
    }
    ?>
    <?php
    $query = $conn->prepare("select * from task where user_id = :user_id");
    $query->bindParam(':user_id', $user['id']);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if(count($result)) {
        foreach ($result as $task) {
            ?>
                <tr>
                    <td><?php echo $task['title']; ?></td>
                    <td><?php echo $task['content']; ?></td>
                    <td><?php echo $task['created_at']; ?></td>
                    <td><?php if($task['status']) { ?>انجام شده <a href="./panel.php?task_id=<?php echo $task['id']; ?>&action=0" class="task_btn done">لغو انجام</a><?php } else { ?>انجام نشده <a href="./panel.php?task_id=<?php echo $task['id']; ?>&action=1" class="task_btn not_done">انجام</a><?php } ?></td>
                    <td><a href="./task_view.php?task_id=<?php echo $task['id'] ?>" class="task_btn view">نمایش</a></td>
                </tr>
            <?php
        }
    } else {
        ?>
        <tr>
           <td colspan="5">هیچ تسکی یافت نشد، برای افزودن تسک جدید از گزینه افزودن لیست استفاده کنید</td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
require './footer.php';
?>
