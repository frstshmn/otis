<!doctype html>
<html lang="en">
<?php
include "header.php";
?>



<div class="p-5">
  <div class="row">
    <div class="col-xl-6 col-md-6">
      <form id="password_change">
        <input type="text" value="password" name="type" hidden>

        <div class="form-row" style="padding-left: 2em; padding-right: 2em;">
          <h6 style="padding-bottom: 2em;">Логін та пароль для доступу до системи</h6>
          <div class="form-group col-md-12">
            <label for="inputEmail">E-mail / (логін)</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="E-mail / (логін)" name="email">
          </div>

          <div class="form-group col-md-12">
            <label for="inputOldPassword">Поточний пароль</label>
            <input type="password" class="form-control" id="inputOldPassword" placeholder="Поточний пароль" name="password" required>
          </div>

          <h6 style="padding: 2em 0;">Змінити пароль</h6>

          <div class="form-group col-md-12">
            <label for="inputNewPassword">Новий пароль</label>
            <input type="password" class="form-control" id="inputNewPassword" placeholder="Новий пароль" name="new" required>
          </div>
          <div class="form-group col-md-12">
            <label for="confirmNewPassword">Новий пароль ще раз</label>
            <input type="password" class="form-control" id="confirmNewPassword" placeholder="Новий пароль ще раз" name="repeat" required>
          </div>
          <div>
            <div class="row" style="height: 2em;"></div>
            <div class="btn btn-outline-success btn-block" onclick="changePassword();">Зберегти зміни</div>
          </div>
        </div>
      </form>
    </div>

    <div class="col-xl-6 col-md-6">
      <form id="change-user-info" action="api/users" method="PUT">

        <div class="form-row" style="padding-left: 2em; padding-right: 2em;">
          <h6 style="padding-bottom: 2em;">Особисті контактні дані користувача</h6>

          <div class="form-group col-md-12">
            <label for="inputNameDep">Назва організації / філії</label>
            <input type="text" class="form-control" id="input-name-dep" placeholder="Назва організації / філії" name="namedepartment" title="Використовується в підписі при відправці е-мейл листів клієнтам">
          </div>

          <div class="form-group col-md-12">
            <label for="inputaddress">Адреса</label>
            <input type="text" class="form-control" id="input-address" placeholder="м. Київ, вул. Промислова, буд. 16, оф. 4" name="useraddress" title="Використовується в підписі при відправці е-мейл листів клієнтам">
          </div>

          <div class="form-group col-md-12">
            <label for="inputWeb">WEB-сайт</label>
            <input type="text" class="form-control" id="input-web" placeholder="www.yourfirm.com.ua" name="webaddress" title="Використовується в підписі при відправці е-мейл листів клієнтам">
          </div>

          <div class="form-group col-md-6">
            <label for="inputSurname">Прізвище співробітника</label>
            <input type="text" class="form-control" id="inputSurname" placeholder="Прізвище" name="surname">
          </div>
          <div class="form-group col-md-6">
            <label for="inputName">Ім'я співробітника</label>
            <input type="text" class="form-control" id="inputName" placeholder="Ім'я" name="name">
          </div>
          <div class="form-group col-md-6">
            <label for="inputBirthday">Дата народження співробітника</label>
            <input type="date" class="form-control" id="inputBirthday" name="birthday">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPhone">Контактний номер телефону</label>
            <input type="text" class="form-control" id="inputPhone" placeholder="Номер мобільного телефону" name="phone" title="Використовується в підписі при відправці е-мейл листів клієнтам">
          </div>
          <div>
            <div class="row" style="height: 2em;"></div>
            <div class="btn btn-outline-success btn-block" onclick="changeData();">Зберегти зміни</div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Notifications for requests -->
<div class="toast success" style="position: absolute; bottom: 0; right: 0; margin: 0px 30px 30px 0px; border: 1px solid green;" data-delay="3000">
  <div class="toast-header">
    <strong class="mr-auto">OTIS</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body success"></div>
</div>

<div class="toast error" style="position: absolute; bottom: 0; right: 0; margin: 0px 30px 30px 0px; border: 1px solid red;" data-delay="3000">
  <div class="toast-header">
    <strong class="mr-auto">OTIS</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body error"></div>
</div>

<script src="public/js/profile.js"></script>

<script>
  $(document).ready(function() {
    $("#inputPhone").mask("+380999999999");
  });
</script>

<?php
include "footer.php";
?>
</body>

</html>