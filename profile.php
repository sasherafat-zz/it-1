<?php
$page = 'panel';
$tab = 'profile';
require './bootstrapper.php';
require './header.php';
?>
<?php
if(isset($_POST['edit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $err = [];
    if($username == null) {
        $err[] = 'نام کاربری نمی تواند خالی باشد.';
    }
    if($password != null || $re_password != null) {
        if($password != $re_password)
            $err[] = 'رمزهای عبور با هم تطابق ندارند.';
        else
            $password = $_POST['password'];
    }
    else
        $password = $user['password'];
    if(count($err) == 0) {
        $query = $conn->prepare("select * from user where username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) > 0 && !(count($result) == 1 && $result[0]['username'] == $user['username'])) {
            echo "<div class=\"alert danger\">اطلاعات پروفایل شما با موفقیت بروز رسانی شد.</div>";
        } else {
            $query = $conn->prepare("update user set username = :username, password = :password where id = :user_id");
            $query->bindParam(':username', $username);
            $query->bindParam(':password', $password);
            $query->bindParam(':user_id', $user['id']);

            if($query->execute())
                echo "<div class=\"alert success\">اطلاعات پروفایل شما با موفقیت بروز رسانی شد.</div>";
            else
                echo "<div class=\"alert danger\">خطایی رخ داد.</div>";
        }
    } else {
        foreach ($err as $message) {
            echo "<div class=\"alert danger\">".$message."</div>";
        }
    }
}
?>
<?php
$user_id = $_SESSION['user_id'];
$query = $conn->prepare("select * from user where id = :user_id");
$query->bindParam(':user_id', $user_id);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$finded_user = $result[0];
if(count($result)) {
    $user = $result[0];
}
?>
<!-- Edit Profile -->
<form class="view_form profile_form" action="./profile.php" method="post">
    <input name="username" value="<?php echo $user['username']; ?>" placeholder="نام کاربری" type="text" />
    <input name="password" value="" placeholder="رمز عبور" type="password" />
    <input name="re_password" placeholder="تکرار رمز عبور" type="password" />
    <button type="submit" name="edit">ذخیره تغییرات</button>
</form>
<span>توجه:‌ درصورت تمایل به تغییر رمز عبور، رمز عبور جدید را وارد کنید، در غیر این صورت خالی بگذارید.</span>
<?php
require './footer.php';
?>
