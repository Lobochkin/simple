<?php 
function show_menu_li($item, $name_page)
{
  global $page;
  $class = $page == $item ? 'class="active"' : '' ;
  return '<li><a ' . $class . ' href="?page=' . $item . '">' . $name_page . '</a></li>'; 
} 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Учебный проект: Седона</title>
  <link href="css/normalize.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
  <div class="container">
    <header class="main-header">
      <nav class="main-navigation">
        <a class="main-header-logo" href="index.php">
          <img src="img/logo.png" width="138" height="70" alt="Логотип Sedona">
        </a>
        <ul class="site-navigation">
          <?=show_menu_li('main', 'Главная')?>
          <?=show_menu_li('hotel', 'Гостиницы')?>
        </ul>
      </nav>
    </header>