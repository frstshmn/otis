// API Key
let promise = new Promise(res => {
  $.getJSON('api/users/apikeys', data => {
    res(data);
  });
});

// JSON Data
promise.then(apiKey => {
  $.getJSON(`api/firms?api_key=${apiKey}`, function (data) {
    $.each(data, function (index) {
      $('#selectFirm').append(`<option value='${data[index].id_firm}'>${data[index].name}</option>`);

      // SEARCH IN SELECT
      $("#selectFirm").select2();
      // SEARCH IN SELECT
    });
  });



  $.getJSON('public/lists/Models.php', function (data) {
    $.each(data, function (index) {
      $('#insertBrandVehicle').append(`<option value="${data[index].brand}">${data[index].brand}</option>`);
      $('#selectBrandVehicle').append(`<option value="${data[index].brand}">${data[index].brand}</option>`);
    });
    $("#selectBrandVehicle").select2();
    $('#insertBrandVehicle').editableSelect();
  });


  $('#selectBrandVehicle').change(function () {
    let value = $('#selectBrandVehicle').val();
    $.getJSON(`public/lists/Models.php?brand=${value}`, function (data) {
      $(".model").remove();
      $.each(data, function (index) {
        $('#selectModelVehicle').append(`<option class="model" value="${data[index].id_model}">${data[index].model}</option>`);
        $("#selectModelVehicle").select2();
      });
    });
  });

  $('#selectModelVehicle').change(function () {
    let value = $('#selectModelVehicle').val();
    $.getJSON(`public/lists/Models.php?model=${value}`, function (data) {
      $(".type").remove();
      $.each(data, function (index) {
        $('#selectTypeVehicle').val(data[index].type);
      });
    });
  });


  //Request for create car
  $('#create-car').click(() => {

    let idFirm = $('#selectFirm').val();
    let idModel = $('#selectModelVehicle').val(); // if selected car

    // if new car
    let brand = $('#insertBrandVehicle').val();
    let model = $('#insertModelVehicle').val();
    let type = $('#insertTypeVehicle').val();

    let vinCode = $('#inputIDVehicle').val();
    let regNumber = $('#inputStateNumberVehicle').val();

    let passingDate = $('#inputDateTO').val();
    let nextPassingDate = $('#inputNextDateTO').val();

    let sertificationDate = $('#inputDateSert').val();
    let nextSertificationDate = $('#inputNextDateSert').val();

    let check = ``;
    if (brand == null, model == null, type == null) {
      check = ``;
      check = `&id_model=${idModel}`;
    } else {
      check = ``;
      check = `&brand=${brand}&model=${model}&type=${type}`;
    }

    let checkSertificate = ``;
    if (sertificationDate && nextSertificationDate) {
      checkSertificate = ``;
      checkSertificate = `1`;
    } else {
      checkSertificate = ``;
      checkSertificate = `0`;
    }

    console.log(idFirm, idModel, brand, model, type, vinCode, regNumber, passingDate, nextPassingDate, sertificationDate, nextSertificationDate);

    $.ajax({
      url: `api/cars?api_key=${apiKey}`,
      type: 'POST',
      data: `${check}
      &registration_number=${regNumber}
      &id_firm=${idFirm}
      &vin_code=${vinCode}
      &date_of_passing=${passingDate}
      &next_passing_date=${nextPassingDate}
      &date_of_receiving_sertificate=${sertificationDate}
      &next_sertification_date=${nextSertificationDate}
      &availability_sertificate=${checkSertificate}`,

      success(data) {
        alert(data);
        // $('.toast.success').toast('show');
        // $('.toast .toast-body.success').text(data);
      },
      error(data) {
        alert(data);
        // $('.toast.error').toast('show');
        // $('.toast .toast-body.error').text(data);
      }
    });
  });
});


// Masks and animation
$(document).ready(function () {
  $("#inputIDNumberFirm").mask("9999999999");
  $("#inputPhoneFirm").mask("+380999999999");
  $("#inputIDVehicle").mask("*****************");
  $("#inputStateNumberVehicle").mask("aa9999aa");
  $('#insert').hide();


  $('#CheckSertVehicle').change(function () {
    if ($('#CheckSertVehicle').prop('checked')) {
      $('#inputDateSert').prop('disabled', false);
      $('#inputNextDateSert').prop('disabled', false);
    } else {
      $('#inputDateSert').prop('disabled', true);
      $('#inputNextDateSert').prop('disabled', true);
    }
  });

  $('#select_exist').click(function () {
    $('#select_exist').removeClass('btn-outline-success').addClass('btn-success');
    $('#insert_new').removeClass('btn-success').addClass('btn-outline-success');
    $('#insertBrandVehicle').val('');
    $('#insertModelVehicle').val('');
    $('#insertTypeVehicle').val('');
    $('#insert').slideUp('slow');
    $('#select').slideDown('slow');
  });

  $('#insert_new').click(function () {
    $('#insert_new').removeClass('btn-outline-success').addClass('btn-success');
    $('#select_exist').removeClass('btn-success').addClass('btn-outline-success');
    $('#selectBrandVehicle').val('');
    $('#selectModelVehicle').val('');
    $('#selectTypeVehicle').val('');
    $('#select').slideUp('slow');
    $('#insert').slideDown('slow');
  });
});