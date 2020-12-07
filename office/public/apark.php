<?php
include "header.php";
?>

<div class="container pt-2">
  <h4>Додавання / редагування даних по транспортним засобам:</h4>
  <br>

  <form action="api/cars" method="POST">
    <h5 class="text-center">Додати транспорт</h5>
    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="selectFirm">Виберіть організацію</label>
        <select class="custom-select" id="selectFirm" name="id_firm" required>
          <option selected disabled></option>
        </select>
      </div>

      <div class="form-group col-12">
        <div class="btn btn-success offset-md-3 col-md-3" id="select_exist">Вибрати існуючу марку/модель</div>
        <div class="btn btn-outline-success col-md-3" id="insert_new">Додати нову марку/модель</div>
      </div>


      <div id="insert" class="form-row col-md-12">
        <div class="col-md-4">
          <label for="insertBrandVehicle">Марка ТЗ</label>
          <select class="custom-select" id="insertBrandVehicle" name="brand">
          </select>
        </div>

        <div class="col-md-4">
          <label for="insertModelVehicle">Модель ТЗ</label>
          <input class="form-control" id="insertModelVehicle" name="model">
        </div>

        <div class="col-md-4">
          <label for="insertTypeVehicle">Тип ТЗ</label>
          <select class="custom-select" id="insertTypeVehicle" name="type">
            <option selected disabled>Виберіть тип</option>
            <option value="тягач">тягач</option>
            <option value="причіп">причіп</option>
            <option value="н/причіп">н/причіп</option>
            <option value="фургон">фургон</option>
            <option value="автобус">автобус</option>
            <option value="легковий автомобіль">легковий автомобіль</option>
            <option value="трактор">трактор</option>
            <option value="комбайн">комбайн</option>
            <option value="спецтехніка">спецтехніка</option>
          </select>
        </div>

      </div>

      <div id="select" class="form-row col-md-12">
        <div class="col-md-4">
          <label for="selectBrandVehicle">Марка ТЗ</label>
          <select class="custom-select" id="selectBrandVehicle">
            <option selected disabled>Виберіть марку</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="selectBrandVehicle">Модель ТЗ</label>
          <select class="custom-select" id="selectModelVehicle" name="id_model">
            <option selected>Виберіть модель</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="selectBrandVehicle">Тип ТЗ</label>
          <input class="form-control" id="selectTypeVehicle" disabled>
        </div>

      </div>

      <div id="insert" class="form-row col-md-12 pt-2">
        <div class="offset-md-2 col-md-4">
          <label for="inputIDVehicle">VIN-код</label>
          <input type="text" class="form-control" id="inputIDVehicle" placeholder="VIN-код" name="vin_code" required>
          <small class="text-muted">* латинськими літерами без пропусків</small>
        </div>

        <div class="col-md-4">
          <label for="inputStateNumberVehicle">Державний номер</label>
          <input type="text" class="form-control" id="inputStateNumberVehicle" placeholder="Державний номер" name="registration_number" required>
          <small class="text-muted">* латинськими літерами у форматі - AC7777AC</small>
        </div>
      </div>

      <div class="row col-md-12" style="height: 2em;"></div>

      <div class="form-group col-lg-6 col-md-6">
        <label for="inputDateTO">ТО пройдено</label>
        <input type="date" class="form-control" id="inputDateTO" name="date_of_passing" required>
      </div>

      <div class="form-group col-lg-6 col-md-6">
        <label for="inputDateTO">наступний ТО</label>
        <input type="date" class="form-control" id="inputNextDateTO" name="next_passing_date" required>
      </div>

      <div class="form-group col-lg-12 col-md-12 mt-5">
        <div class="custom-control custom-checkbox text-center">
          <input type="checkbox" class="custom-control-input" id="CheckSertVehicle" name="availability_sertificate">
          <label class="custom-control-label" for="CheckSertVehicle">Сертифікат видано</label>
        </div>
      </div>

      <div class="form-group col-lg-6 col-md-6">
        <label for="inputDateSert">сертифікат отримано</label>
        <input type="date" class="form-control" id="inputDateSert" name="date_of_receiving_sertificate" disabled>
      </div>

      <div class="form-group col-lg-6 col-md-6">
        <label for="inputDateSert">Наступний сертифікат</label>
        <input type="date" class="form-control" id="inputNextDateSert" name="next_sertification_date" disabled>
      </div>

      <div class="form-group offset-md-4 col-md-4">
        <input class="btn btn-outline-success btn-block" id="create-car" value="Додати новий ТЗ">
      </div>
    </div>

  </form>
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

<!-- Select2 -->
<script src="public/js/select2/js/select2.min.js"></script>
<script src="public/js/select2/js/select2.full.min.js"></script>

<!-- JS Scripts -->
<script src="public/js/apark.js"></script>

<?php
include "footer.php";
?>
</body>

</html>