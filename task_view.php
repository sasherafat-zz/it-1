<?php
$page = 'panel';
$tab = '';
require './bootstrapper.php';
require './header.php';
?>
<!-- Edit Cards -->
<form class="view_form" action="#" method="post">
    <input value="عنوان آزمایشی" placeholder="عنوان تسک" type="text" />
    <input value="توضیحات آزمایشی" placeholder="توضیحات" type="text" />
    <input value="تاریخ آزمایشی" placeholder="تاریخ ثبت" type="text" />
    <input  type="radio" name="status" id="done" value="done"> <label for="done">انجام شده</label>
    <input checked type="radio" name="status" id="not_done" value="not_done"> <label for="not_done">انجام نشده</label>
    <button type="submit" name="delete">حذف تسک</button>
    <button type="submit" name="save">ذخیره تغییرات</button>
</form>
<?php
require './footer.php';
?>
