<!doctype html>
<html lang="en">
<?php
include "header.php";
?>
<div class="container pt-2">
  <form action="api/firms" method="POST">
    <h5 class="text-center">Додати організацію</h5>
    <br>
    <div class="form-row">
      <div class="form-group col-lg-3 col-md-6">
        <label for="inputFirm">Назва організації / ФОП</label>
        <input type="text" id="create-firm-name" class="form-control" placeholder="Назва організації чи ФОП" name="name" required>
        <small class="text-muted">* вводити у форматі - ТОВ "Назва компанії" або ФОП "ПІП"</small>
      </div>

      <div class="form-group col-lg-3 col-md-6">
        <label for="inputIDNumberFirm">ЄДРПОУ / іден. код</label>
        <input type="text" id="create-id-firm" class="form-control inputIDNumberFirm" placeholder="ЄДРПОУ або іден. код" name="id_firm" required>
      </div>

      <div class="form-group col-lg-3 col-md-6">
        <label for="inputPhoneFirm">Телефон організації</label>
        <input type="text" id="create-firm-number" class="form-control inputPhoneFirm" placeholder="Номер контактного телефону" name="telephone">
      </div>

      <div class="form-group col-lg-3 col-md-6">
        <label for="inputEmailFirm">Електронна адреса організації</label>
        <input type="email" id="create-firm-email" class="form-control" placeholder="example@mail.com" name="email">
      </div>

      <div>
        <div class="row" style="height: 2em;"></div>

      </div>
    </div>
    <div class="form-group offset-md-4 col-md-4">
      <input class="btn btn-outline-success btn-block" type="submit" value="Додати нову організацію" id="create-firm">
    </div>
  </form>
</div>
<hr>


<div style="padding: 1em;">
  <h5 class="text-center">Зведений список фірм</h5>
  <div class="row" style="height: 1em;"></div>
  <div class="row">
    <div class="col-md-4 offset-md-4 text-center">
      <label class="text-center"><small>Пошук по таблиці</small></label>
      <input class="form-control table-filter " type="text">
    </div>
  </div>

  <div class="row" style="height: 1em;"></div>

  <div class="table-responsive">
    <table id="table-id" class="table table-sm table-hover table-bordered text-center">
      <thead>
        <tr class="bg-white text-success">
          <th class="align-middle header-cursor">Назва фірми</th>
          <th class="align-middle header-cursor">ЄДРПОУ / <br> іден. код</th>
          <th class="align-middle header-cursor">Контактний <br> номер тел.</th>
          <th class="align-middle header-cursor">Контактний E-mail</th>
          <th class="align-middle header-cursor">Редагування<br>даних</th>
        </tr>
      </thead>
      <tbody id="filter-table" class="main-table">

      </tbody>
    </table>
  </div>
</div>

<!-- Edit Modal for Firms -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Редагування</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body edit-table">
        <div class="form-group">
          <label for="inputFirm">Організація / Фірма / ФОП</label>
          <input type="text" id="firm-name" class="form-control" placeholder="Введіть назву" name="name" required>
          <small class="text-muted">* у форматі - ТОВ "Назва" або ФОП "ПІП"</small>
        </div>
        <div class="form-group">
          <label for="inputIDNumberFirm">ЄДРПОУ / іден. код</label>
          <input type="text" id="id-firm" class="form-control inputIDNumberFirm" placeholder="12345678" name="id_firm" required>
          <small class="text-muted">* лише цифри</small>
        </div>
        <div class="form-group">
          <label for="inputPhoneFirm">Контактний номер тел.</label>
          <input type="text" id="firm-contacts" class="form-control inputPhoneFirm" placeholder="+380771234567" name="telephone">
        </div>
        <div class="form-group">
          <label for="inputEmailFirm">Контактний E-mail</label>
          <input type="email" id="firm-email" class="form-control" placeholder="example@mail.com" name="email">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
        <!-- <button id="delete-request" type="button" class="btn btn-danger" data-dismiss="modal">Видалити</button> -->
        <button id="put-request" type="button" class="btn btn-success">Зберегти</button>
      </div>
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

<style>
  .header-cursor {
    cursor: pointer;
  }
</style>

<!-- Masks on input -->
<script>
  $(document).ready(function() {
    $(".inputIDNumberFirm").mask("99999999");
    $(".inputPhoneFirm").mask("+380999999999");
  });
</script>

<!-- Table Sort JS -->
<script src="public/js/tablesort.min.js"></script>
<script src="public/js/sorts/tablesort.date.min.js"></script>
<script src="public/js/sorts/tablesort.dotsep.min.js"></script>
<script src="public/js/sorts/tablesort.filesize.min.js"></script>
<script src="public/js/sorts/tablesort.monthname.min.js"></script>
<script src="public/js/sorts/tablesort.number.min.js"></script>

<!-- Filter Plugin -->
<script src="public/js/filter/jquery.easysearch.min.js"></script>

<!-- JS Scripts -->
<script src="public/js/firms.js"></script>

<!-- TableSort -->
<script>
  new Tablesort(document.getElementById('table-id'));
</script>


<?php
include "footer.php";
?>
</body>

</html>