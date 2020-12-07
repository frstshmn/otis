<!doctype html>
<html lang="en">
<?php
include "header.php";
?>

<div class="p-5">
  <h5 class="text-center">Налаштування даних для СМС-розсилання:</h5>
  <br>
  <div class="row">
    <div class="col-md-6">
      <form id="sms_settings">
        <!--input type="text" value="password" name="type" hidden-->
        <h6>Введіть відповідні дані з системи ALPHASMS</h6>
        <div class="form-row" style="padding-left: 2em; padding-right: 2em;">

          <div class="form-group col-lg-6 col-md-12 col-sm-6">
            <label for="input_sms_login">Логін</label>
            <input type="text" class="form-control" id="smslogin" placeholder="Логін AlphaSMS" name="input_sms_login" required>
          </div>
          <div class="form-group col-lg-6 col-md-12 col-sm-6">
            <label for="input_sms_pass">Пароль</label>
            <input type="password" class="form-control" id="smspassword" placeholder="Пароль AlphaSMS" name="input_sms_pass" required>
          </div>
          <div class="form-group col-md-12">
            <label for="input_sms_api_key">API ключ</label>
            <input type="text" class="form-control" id="smsapikey" placeholder="API ключ AlphaSMS" name="input_sms_api_key" required>
          </div>
          <div class="form-group col-md-12">
            <label for="input_sms_alpha_name">ALPHA ім'я</label>
            <input type="text" class="form-control" id="smsalphaname" placeholder="Alpha-ім'я" name="input_sms_alpha_name" required>
          </div>
          <div class="form-group col-md-12">
            <label for="input_sms_text">Шаблон повідомлень</label>
            <textarea class="form-control" rows="4" id="smstext" placeholder="Введіть текст повідомлення" name="input_sms_text" required></textarea>
            <span id="counter">0 символів - 0 смс</span>
          </div>

          <div class="form-group col-md-12">
            <div class="row" style="height: 2em;"></div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6 text-justify">
      <p><b>AльфаSMS</b> - провідна компанія на українському ринку SMS-послуг для корпоративних та приватних замовників. Компанія займається розвитком телекомунікаційних рішень для бізнесу, котрі дозволяють в короткий період з невисокими затратами досягнути нових вершин в управлінні бізнесом, випереджаючи своїх конкурентів.</p>
      <p>Надсилайте SMS в будні дні з 9:00 до 20:00, у вихідні та святкові дні з 11:00 до 18:00. Поважайте своїх клієнтів.</p>
      <p><b>ВАЖЛИВО!</b> Усі альфа-імена проходять попередню перевірку на стороні операторів. Перевірка імен відбувається ДВА рази в місяць. Усі неперевірені імена будуть ЗАМІНЕНІ при відправці</p>
      <p>Пишіть текст повідомлення кирилицею - одержувачу буде приємно читати.</p>
      <p>При відправці повідомлення зверніть увагу на кількість частин SMS. Кирилицею - <b>70</b> символів в одному SMS.</p>
    </div>
  </div>

  <div class="row text-center">
    <div class="col-3"></div>
    <div class="col-sm-3">
      <div class="btn btn-outline-success btn-block" id="send-info">Зберегти дані</div>
    </div>

    <div class="col-sm-3">
      <div class="btn btn-outline-danger btn-block">Очистити дані</div>
    </div>
    <div class="col-sm-3"></div>
  </div>
</div>

<script type="text/javascript">
  $("#smstext").keyup(function() {
    $('#counter').text($("#smstext").val().length + " символів - " + Math.floor(($("#smstext").val().length - 1) / 70 + 1) + " смс");
  });
</script>

<script src="public/js/settings.js"></script>

<?php
include "footer.php";
?>
</body>

</html>