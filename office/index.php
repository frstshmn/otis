<!doctype html>
<html lang="ua">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="public/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="public/css/fonts.css" rel="stylesheet">
  <link href="public/css/font-awesome.min.css" rel="stylesheet">

  <title>OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів</title>
  
  
</head>

<body class="bg-light">
  <div class="row" style="height: 1.6em;"></div>
  <div class="container bg-light">
    <div class="row">
      <div class="col-md-3 col-sm-2"></div>
      <div class="col-md-6 col-sm-8 border border-success rounded-lg">
        <div class="row" style="height: 1em;"></div>
        <div class="text-center">
          <img src="public/img/logo.png" width="40%" alt="OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів" title="OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів">
		  <span style="font-size: 2em;">OFFICE</span>
        </div>
        <div class="row" style="height: 1em;"></div>
        <h3 class="text-center">Авторизація</h3>

        <form action="vendor/auth/login.php" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1" class="font-weight-bolder">Логін</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введіть електронну пошту">
            <small id="emailHelp" class="form-text text-muted">В якості логіну використовується E-mail адреса</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" class="font-weight-bolder">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введіть пароль">
            <small id="passHelp" class="form-text text-muted">Нікому не поширюйте власний пароль!</small>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Запам'ятати мене</label>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-outline-success btn-block">Увійти в систему</button>
          </div>
        </form>

        <div class="row" style="height: 1.6em;"></div>
        <div class="row text-center">
          <div class="col-lg-6 col-md-12">
            <a href="#" class="badge badge-light">Не пам'ятаю пароль</a>
          </div>
          <!--div class="col-lg-6 col-md-12">
            <a href="registration.php" class="badge badge-light">Реєстрація нового користувача</a>
          </div-->
        </div>
        <div class="row" style="height: 1.6em;"></div>
        <div class="text-bottom text-center"><small>&copy All right reserved, <a href="authors.html">OTIS 2020</a></small></div>
        <div class="row" style="height: 1em;"></div>
      </div>
      <div class="col-md-3 col-sm-2"></div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>