<?php
require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');
$mysql = (new Database())->connect();
$mysql->set_charset("utf8");
session_start();
if (empty($_SESSION["uid"])) {
  header('Location: index.php');
}
$uid = $_SESSION["uid"];
$user_data = $mysql->query("SELECT * FROM users WHERE id_client = '" . $uid . "'");
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="public/favicon.ico" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/569da4ff6a.js" crossorigin="anonymous"></script>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- Masked Input JS -->
  <script type="text/javascript" src="public/js/jquery.maskedinput.min.js"></script>

  <!-- Editable Select And Search JS -->
  <script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
  <link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">
  
  <!-- Select2 Styles -->
  <link rel="stylesheet" href="public/js/select2/css/select2.min.css">
  <link rel="stylesheet" href="public/css/otis-style.css" type="text/css">

  <title>OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів</title>
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" sticky-top>

    <a href="about" id="/status" class="navbar-brand align-baseline" alt="OTIS logo">
     <img src="public/img/logo.png" width="80" alt="OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів" title="OTIS logo">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a href="main" id="/main" class="nav-link">Головна</a></li>
        <li class="nav-item"><a href="profile" id="/profile" class="nav-link">Мій профіль</a></li>
        <li class="nav-item"><a href="firms" id="/firms" class="nav-link">Мої фірми</a></li>
        <li class="nav-item"><a href="apark" id="/apark" class="nav-link">Мій автопарк</a></li>        
        <li class="nav-item"><a href="view" id="/view" class="nav-link">ТО та сертифікати</a></li>
        <li class="nav-item"><a href="settings" id="/settings" class="nav-link">Налаштування</a></li>
        <!--li class="nav-item"><a href="about" id="/status" class="nav-link">Про систему</a></li-->
      </ul>
      <div class="text-secondary" style="padding-right: 1em;">
        <?php
        while ($row = $user_data->fetch_assoc()) {
          echo $row['second_name'];
          echo ' ';
          echo $row['first_name'];
		  echo '<br>';
          echo '<small>'.$row['user_type'].'.<span class="_package">'.$row['package_type'].'</span></small>';
        }
        ?>
      </div>
      <a href="vendor/auth/exit.php">
        <button class="btn btn-outline-success my-2 my-sm-0">Вийти</button>
      </a>

    </div>
  </nav>

  <script>
    let path = location.pathname;
    
    document.getElementById(`${path}`).classList.add('active');
  </script>