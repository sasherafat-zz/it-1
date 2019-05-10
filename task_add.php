<?php
$page = 'panel';
$tab = 'add_task';
require './bootstrapper.php';
require './header.php';
?>
<!-- Add Cards -->
<form class="view_form" action="#" method="post">
    <input placeholder="عنوان تسک" type="text" />
    <input placeholder="توضیحات" type="text" />
    <input placeholder="تاریخ ثبت" type="text" />
    <input type="radio" name="status" id="done" value="done"> <label for="done">انجام شده</label>
    <input type="radio" name="status" id="not_done" value="not_done"> <label for="not_done">انجام نشده</label>
    <button type="submit" name="add_task">افزودن تسک</button>
</form>
<?php
require './footer.php';
?>
