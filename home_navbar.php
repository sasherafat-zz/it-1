<ul class="nav_right">
    <li><a href="#about">درباره ما</a></li>
    <li><a href="#services">خدمات ما</a></li>
</ul>
<ul class="nav_left">
    <li>
        <?php if(isset($user)) { ?>
            <a style="white-space: nowrap;" href="./panel.php">داشبورد ( <?php echo $user['username'] ?> )</a>
        <?php } else { ?>
            <a href="./auth.php">ورود / عضویت</a>
        <?php } ?>
    </li>
</ul>