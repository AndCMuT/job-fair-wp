<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Job-fair</title>
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <div class="logo"><?php the_custom_logo() ?></div>
        <div class="navbar">
            <!-- <ul class="list-navigation">
                <li class="nav-item"><a href="index.html">Главная</a></li>
                <li class="nav-item"><a href="">О нас</a></li>
                <li class="nav-item"><a href="">Новости</a></li>
                <li class="nav-item"><a href="">Контакты</a></li>
            </ul> -->
            <?php wp_nav_menu( [
                'theme_location'  => 'header-menu',
                'container_class' => 'navbar',
                'menu_class'      => 'list-navigation'
            ]) ?>
        </div>
        <div class="signup">
            <a href="" class="signup-link">Вход</a>
            <a href="" class="signup-link">Регистрация</a>
        </div>
    </header>