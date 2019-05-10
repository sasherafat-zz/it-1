<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>لیست کار</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="navbar">
    <?php
        if($page == 'home')
            require './home_navbar.php';
        elseif($page == 'panel')
            require './panel_navbar.php';
    ?>
</div>

<header>
    <h1>با <a href="#" title="لیست کارد">لیست کارد</a> ، تسک های خودرا فراموش نکنید</h1>
</header>

<div class="container">