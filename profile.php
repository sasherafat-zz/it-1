<?php
$page = 'panel';
$tab = 'profile';
require './bootstrapper.php';
require './header.php';
?>
<!-- Edit Profile -->
<form class="view_form profile_form" action="#" method="post">
    <input value="علی صفری" placeholder="نام کاربری" type="text" />
    <input value="" placeholder="رمز عبور" type="password" />
    <input value="" placeholder="تکرار رمز عبور" type="password" />
    <button type="submit" name="save">ذخیره تغییرات</button>
</form>
<span>توجه:‌ درصورت تمایل به تغییر رمز عبور، رمز عبور جدید را وارد کنید، در غیر این صورت خالی بگذارید.</span>
<?php
require './footer.php';
?>
