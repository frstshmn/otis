<!doctype html>
<html lang="ua">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="css/fonts.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <title>OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів</title>
  <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>

</head>

<body class="bg-light">
  <div class="row" style="height: 1.6em;"></div>
  <div class="container bg-light">
    <div class="row">
      <div class="col-md-3 col-sm-2"></div>
      <div class="col-md-6 col-sm-8 border border-success rounded-lg">
        <div class="row" style="height: 1em;"></div>
        <div class="text-center">
          <img src="img/logo.png" width="240" alt="OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів" title="OTIS - Онлайн-система обліку ТО та сертифікатів транспортних засобів">
        </div>
        <div class="row" style="height: 1em;"></div>
        <h3 class="text-center">Реєстрація</h3>
        <form action="api/users" method="POST">
          <div class="form-group">
            <label for="email" class="font-weight-bolder">E-mail адреса</label>
            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введіть електронну пошту" required>
            <small id="emailHelp" class="form-text text-muted">В якості логіну використовується E-mail адреса</small>
          </div>
          <div class="form-group">
            <label class="font-weight-bolder">Прізвище та ім'я</label>
            <div class="row">
              <div class="col-md-6">
                <input name="first_name" type="text" class="form-control" placeholder="Прізвище" required>
              </div>
              <div class="col-md-6">
                <input name="second_name" type="text" class="form-control" placeholder="Ім'я" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="font-weight-bolder">Номер телефону</label>
            <input name="telephone" id="phone" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="font-weight-bolder">Дата народження</label>
            <input name="birthdate" id="date" type="date" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="font-weight-bolder">Пароль</label>
            <small class="form-text text-muted">Нікому не поширюйте власний пароль!</small>
            <input name="password" type="password" class="form-control mb-1" placeholder="Введіть пароль" minlength="8" required>
            <input name="password" type="password" class="form-control" placeholder="Повторіть пароль" minlength="8" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-outline-success btn-block">Зареєструватись</button>
          </div>
        </form>

        <div class="row" style="height: 1.6em;"></div>

        <div class="row text-center">
          <div class="col-lg-6 col-md-12">
            <a href="#" class="badge badge-light">Не пам'ятаю логін чи пароль</a>
          </div>
          <div class="col-lg-6 col-md-12">
            <a href="index.php" class="badge badge-light">Уже зареєстровані? Увійдіть</a>
          </div>
        </div>

        <div class="row" style="height: 1.6em;"></div>
        <div class="text-bottom text-center"><small>&copy All right reserved, <a href="authors.html">OTIS 2020</a></small></div>
        <div class="row" style="height: 1em;"></div>
      </div>
      <div class="col-md-3 col-sm-2"></div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <script>
    $(document).ready(function() {
      $("#phone").mask("+380999999999");
    });
  </script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>