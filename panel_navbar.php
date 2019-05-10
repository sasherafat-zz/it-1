<ul class="nav_right">
    <li><a href="./index.php">صفحه اصلی</a></li>
    <li><a href="./panel.php" <?php if($tab == 'dashboard') { ?>class="active"<?php } ?>>لیست کارها</a></li>
    <li><a href="./task_add.php" <?php if($tab == 'add_task') { ?>class="active"<?php } ?>>افزودن لیست</a></li>
</ul>
<ul class="nav_left">
    <li><a href="./profile.php" <?php if($tab == 'profile') { ?>class="active"<?php } ?>>پروفایل (‌ <?php echo $user['username'] ?> )</a></li>
    <li><a href="./logOut.php">خروج</a></li>
</ul>