<!doctype html>
<html lang="en">
<?php
include "header.php";
?>
<div class="container pt-2">


  <table class="table table-hover col-lg-8 col-md-12">
    <tbody class="user-info">

      <tr class="table-secondary">
        <td>Користувач:</td>
        <th class="text-center" id="user-name"></th>
      </tr>
	  
	  <tr class="table-secondary">
        <td>Дата реєстрації:</td>
        <th class="text-center">22.22.2222</th>
      </tr>


      <tr class="table-secondary">
        <td>Назва організації / фірми:</td>
        <th class="text-center" id="user-department">-</th>
      </tr>

      <tr class="table-secondary">
        <td>Адреса:</td>
        <th class="text-center" id="user-street">-</th>
      </tr>

      <tr class="table-secondary">
        <td>Номер телефону:</td>
        <th class="text-center" id="user-telephone"></th>
      </tr>

      <tr class="table-secondary">
        <td>E-mail:</td>
        <th class="text-center" id="user-email"></th>
      </tr>

      <tr class="table-info">
        <td>Організацій в системі:</td>
        <th class="text-center" id="firms-count"></th>
      </tr>

      <tr class="table-info">
        <td>Транспортних засобів в системі:</td>
        <th class="text-center" id="cars-count"></th>
      </tr>

      <tr class="table-warning">
        <td>ТО у найближчі 30 днів:</td>
        <th class="text-center" id="next-thirty"></th>
      </tr>

      <tr class="table-warning">
        <td>ТО у найближчі 14 днів:</td>
        <th class="text-center" id="next-seven"></th>
      </tr>
	  
	  <tr class="table-warning">
        <td>Сертифікати у найближчі 30 днів:</td>
        <th class="text-center">-</th>
      </tr>
	  
	  <tr class="table-warning">
        <td>Сертифікати у найближчі 14 днів:</td>
        <th class="text-center">-</th>
      </tr>
	  
	  <tr class="table-success">
        <td>Пройдено ТО:</td>
        <th class="text-center">10</th>
      </tr>

      <tr class="table-success">
        <td>Видано сертифікатів:</td>
        <th class="text-center" id="sertificate-count"></th>
      </tr>
      <tr class="table-danger">
        <td>Стан рахунку (сервіс AlphaSMS):</td>
        <th class="text-center" id="alphasms-count"></th>
      </tr>     

    </tbody>
  </table>

  <script src="public/js/main.js"></script>

</div>
<?php
include "footer.php";
?>
</body>

</html>