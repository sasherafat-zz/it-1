<?php require './bootstrapper.php'; ?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>صفحه ورود / ثبت نام</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<div class="logmod">
    <div class="logmod__wrapper">
        <div class="logmod__container">
            <ul class="logmod__tabs">
                <li data-tabtar="lgm-1"><span>ثبت نام</span></li>
                <li data-tabtar="lgm-2"><span>ورود</span></li>
            </ul>
            <div class="logmod__tab-wrapper">
                <div style="padding: 5px;">
                    <?php
                        if(isset($_POST['register'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $re_password = $_POST['re_password'];
                            $err = [];
                            if($username == null || $password == null || $re_password == null)
                                array_push($err, 'همه فیلدها الزامی است.');
                            if($password != null && $re_password != null && $password != $re_password)
                                array_push($err, 'رمزهای عبور با هم مطابقت ندارند.');
                            if(count($err) == 0) {
                                $query = $conn->prepare("select * from user where username = :username");
                                $query->bindParam(':username', $username);
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                if(count($result)) {
                                    echo '<p>نام کاربری از قبل وجود دارد.</p>';
                                } else {
                                    $query = $conn->prepare("insert into user(username, password, created_at) values(:username, :password, ".time().")");
                                    $query->bindParam(':username', $username);
                                    $query->bindParam(':password', $password);

                                    if($query->execute())
                                        echo '<p>عضویت با موفقیت انجام شد</p>';
                                    else
                                        echo '<p>خطایی رخ داد</p>';
                                }
                            } else {
                                foreach ($err as $error) {
                                    echo '<p>'.$error.'</p>';
                                }
                            }
                        } elseif(isset($_POST['login'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $query = $conn->prepare("select * from user where username = :username");
                            $query->bindParam(':username', $username);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            if(count($result) && $result[0]['password'] == $password) {
                                $_SESSION["user_id"] = $result[0]['id'];
                                header('location: ./panel.php');
                            } else
                                echo '<p>کاربری با مشخصات وارد شده یافت نشد!</p>';
                        }
                    ?>
                </div>
                <div class="logmod__tab lgm-1">
                    <div class="logmod__heading">
                        <span class="logmod__heading-subtitle">اطلاعات شخصیتان را برای <strong>ثبت نام</strong> وارد کنید.</span>
                    </div>
                    <div class="logmod__form">
                        <form accept-charset="utf-8" action="./auth.php" class="simform" method="post">
                            <div class="sminputs">
                                <div class="input full">
                                    <label class="string" for="user-name">نام کاربری *</label>
                                    <input class="string" name="username" maxlength="255" id="user-name" placeholder="نام کاربری" type="username" size="50" />
                                </div>
                            </div>
                            <div class="sminputs">
                                <div class="input string">
                                    <label class="string" for="user-pw-repeat">تکرار رمز عبور *</label>
                                    <input class="string" name="re_password" maxlength="255" id="user-pw-repeat" placeholder="تکرار رمز عبور" type="password" size="50" />
                                </div>
                                <div class="input string">
                                    <label class="string" for="user-pw">رمز عبور *</label>
                                    <input class="string" name="password" maxlength="255" id="user-pw" placeholder="رمز عبور" type="password" size="50" />
                                </div>
                            </div>
                            <div class="simform__actions">
                                <button class="sumbit" name="register" type="submit">ساخت اکانت</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="logmod__tab lgm-2">
                    <div class="logmod__heading">
                        <span class="logmod__heading-subtitle">نام کاربری و رمزعبور خود را <strong>وارد</strong> کنید.</span>
                    </div>
                    <div class="logmod__form">
                        <form accept-charset="utf-8" action="./auth.php" class="simform" method = "POST">
                            <div class="sminputs">
                                <div class="input full">
                                    <label class="string" for="user-name">نام کاربری *</label>
                                    <input class="string" name="username" maxlength="255" id="user-name" placeholder="نام کاربری" type="username" size="50" />
                                </div>
                            </div>
                            <div class="sminputs">
                                <div class="input full">
                                    <label class="string" for="user-pw">رمز عبور *</label>
                                    <input class="string" name="password" maxlength="255" id="user-pw" placeholder="رمزعبور" type="password" size="50" />
                                </div>
                            </div>
                            <div class="simform__actions">
                                <button class="sumbit" name="login" type="submit">ورود</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="assets/js/index.js"></script>

</body>

</html>