// API Key
let promise = new Promise(res => {
  $.getJSON('api/users/apikeys', data => {
    res(data);
  });
});

// Create table 

function fillingData() {
  promise.then(apiKey => {
    $.getJSON(`api/cars?api_key=${apiKey}`, function (data) {
      $.each(data, function (index) {
        let dateNextPassing = data[index].next_passing_date;
        let dateNextSert = data[index].next_sertification_date;

        // Format for next passing date
        let dateNextPassingFormat = new Date(dateNextPassing);
        let nextPassingDay = dateNextPassingFormat.getDate();
        let nextPassingMonth = dateNextPassingFormat.getMonth() + 1;
        let nextPassingYear = dateNextPassingFormat.getFullYear();
        let outputNextPassingDate = `${nextPassingDay}/${nextPassingMonth}/${nextPassingYear}`;

        // Format for next sertificate date
        let dateNextSertFormat = new Date(dateNextSert);
        let nextSertDay = dateNextSertFormat.getDate();
        let nextSertMonth = dateNextSertFormat.getMonth() + 1;
        let nextSertYear = dateNextSertFormat.getFullYear();
        let outputNextSertDate = `${nextSertDay}/${nextSertMonth}/${nextSertYear}`;


        let currentDate = new Date(); //date1
        let diffDays = Math.ceil((dateNextPassingFormat - currentDate) / (1000 * 3600 * 24));

        // Status for filter data
        let status = '';
        let statusDay = '';
        if (diffDays < 30) {
          status = 'status-month';
          statusDay = 'month';
        }
        if (diffDays < 14) {
          status = 'status-week';
          statusDay = 'week';
        }
        if (diffDays <= 0) {
          status = 'status-today';
          statusDay = 'out-day';
        }
        if (diffDays > 30) {
          statusDay = 'more-month';
        }


        let sertificateStatus = '';
        if (data[index].next_sertification_date !== '0000-00-00' && data[index].date_of_receiving_sertificate !== '0000-00-00') {
          sertificateStatus = 'sertAvailable';
        } else {
          sertificateStatus = 'sertNotAvailable';
        }

        $('.main-table').append(`
          <tr class="table-data ${statusDay} ${sertificateStatus}">
            <td class="align-middle ${status}">${data[index].name}</td>
            <td class="align-middle ${status}">${data[index].brand}</td>
            <td class="align-middle ${status}">${data[index].model}</td>
            <td class="align-middle ${status}">${data[index].registration_number}</td>
            <td class="align-middle ${status}">${data[index].vin_code}</td>
            <td class="align-middle ${status}">${outputNextPassingDate}</td>
            <td class="align-middle ${status}">${data[index].next_sertification_date !== '0000-00-00' || data[index].date_of_receiving_sertificate !== '0000-00-00' ? 'є' : 'немає'}</td>
            <td class="align-middle ${status}">${data[index].next_sertification_date !== '0000-00-00' ? outputNextSertDate : '-'}</td>
            <td class="edit-btn align-middle">
              <div title="Редагування" onclick="editModal('${data[index].registration_number}')" class="edit-button btn btn-outline-success align-middle btn-sm" data-toggle="modal" data-target=".bd-edit-modal-lg">
                <i  class="fas fa-edit"></i>
              </div>
              <div title="Відправка листа" onclick="emailModal('${data[index].registration_number}')" class="edit-button btn btn-outline-success align-middle btn-sm" data-toggle="modal" data-target="#emailModal">
                <i class="fas fa-envelope"></i>
              </div>
              <div title="Відправка SMS" onclick="smsModal('${data[index].registration_number}')" class="edit-button btn btn-outline-success align-middle btn-sm" data-toggle="modal" data-target="#smsModal">
                <i class="fas fa-sms"></i>
              </div>
              <div title="Видалення" onclick="deleteModal('${data[index].registration_number}')" class="edit-button btn btn-outline-danger align-middle btn-sm" data-toggle="modal" data-target="#deleteModal">
                <i class="fas fa-trash-alt"></i>
              </div>
            </td> 
          </tr>`).show(350);
      });
    });
  });
}

fillingData();


// Filter data with categories
function filterData(value) {
  switch (value) {

    // TO filter
    case 'all-to':
      $('.table-data.month').show(350);
      $('.table-data.out-day').show(350);
      $('.table-data.week').show(350);
      $('.table-data.more-month').show(350);
      break;

    case 'month':
      $('.main-table').ready(() => {
        $('.table-data.month').show(350);
        $('.table-data.out-day').hide(350);
        $('.table-data.week').show(350);
        $('.table-data.more-month').hide(350);
      });
      break;

    case 'week':
      $('.main-table').ready(() => {
        $('.table-data.month').hide(350);
        $('.table-data.out-day').hide(350);
        $('.table-data.week').show(350);
        $('.table-data.more-month').hide(350);
      });
      break;

    case 'out-day':
      $('.table-data.month').hide(350);
      $('.table-data.out-day').show(350);
      $('.table-data.week').hide(350);
      $('.table-data.more-month').hide(350);
      break;

    // Sertification filter
    case 'all-sert':
      $('.table-data.sertAvailable').show(350);
      $('.table-data.sertNotAvailable').show(350);
      break;

    case 'available':
      $('.table-data.sertAvailable').show(350);
      $('.table-data.sertNotAvailable').hide(350);
      break;

    case 'not-available':
      $('.table-data.sertAvailable').hide(350);
      $('.table-data.sertNotAvailable').show(350);
      break;
  }
}

$('#to-filter').change(() => {
  let value = $('#to-filter').val();

  filterData(value);
});

$('#sert-filter').change(() => {
  let value = $('#sert-filter').val();

  filterData(value);
});


// Output information about vechicle in modal window
function editModal(value) {
  $('.modal.fade.bd-edit-modal-lg.show').ready(() => {
    $.getJSON('public/lists/Models.php', (data) => {
      $(".brand").remove();
      $.each(data, function (index) {
        $('#insertBrandVehicle').append(`
        <option class="brand" value="${data[index].brand}">
          ${data[index].brand}
        </option>`);

        $('#selectBrandVehicle').append(`
        <option class="brand" value="${data[index].brand}">
          ${data[index].brand}
        </option>`);
      });
      $('#insertBrandVehicle').editableSelect();
      $('#selectBrandVehicle').select2();
    });

    $('#selectBrandVehicle').on("change", () => {
      let value = $('#selectBrandVehicle').val();
      $.getJSON(`public/lists/Models.php?brand=${value}`, function (data) {
        $(".model").remove();
        $.each(data, function (index) {
          $('#selectModelVehicle').append(`
          <option class="model" value="${data[index].id_model}">
            ${data[index].model}
          </option>`);

          $('#selectModelVehicle').select2();
        });
      });
    });

    $('#selectModelVehicle').on("change", () => {
      let value = $('#selectModelVehicle').val();
      $.getJSON(`public/lists/Models.php?model=${value}`, function (data) {
        $(".type").remove();
        $.each(data, function (index) {
          $('#selectTypeVehicle').val(data[index].type);
        });
      });
    });

    $('.edit-table').attr('id', value);
  });

  promise.then(apiKey => {
    $('.modal.fade.bd-edit-modal-lg.show').ready(() => {
      $.getJSON(`api/cars/${value}?api_key=${apiKey}`, (data) => {
        $.each(data, (index) => {
          $('#selectBrandVehicle').ready(() => {
            $('#selectBrandVehicle').val(data[index].brand);
            $('#select2-selectBrandVehicle-container').text(data[index].brand);

            let value = $('#selectBrandVehicle').val();
            $.getJSON(`public/lists/Models.php?brand=${value}`, (data) => {
              $(".model").remove();
              $.each(data, (index) => {
                $('#selectModelVehicle').append(`
                <option class="model" value="${data[index].id_model}">
                  ${data[index].model}
                </option>`);
              });
            });
          });

          $('#selectModelVehicle').val(data[index].model);

          $('#inputIDVehicle').val(data[index].vin_code);
          $('#inputStateNumberVehicle').val(data[index].registration_number);
          $('#inputDateTO').val(data[index].date_of_passing);
          $('#inputNextDateTO').val(data[index].next_passing_date);

          if (data[index].next_sertification_date !== '0000-00-00') {
            $('#CheckSertVehicle').prop('checked', true);
            $('#inputDateSert').prop('disabled', false);
            $('#inputNextDateSert').prop('disabled', false);
            $('#inputDateSert').val(data[index].date_of_receiving_sertificate);
            $('#inputNextDateSert').val(data[index].next_sertification_date);
          } else {
            $('#CheckSertVehicle').prop('checked', false);
            $('#inputDateSert').prop('disabled', true);
            $('#inputDateSert').val(false);
            $('#inputNextDateSert').prop('disabled', true);
            $('#inputNextDateSert').val(false);
          }
        });
      });
    });
  });
}
// -------------------------------------------------------------------

// Function for send edit request
$('#put-request').click(function () {
  let regNumber = $('#inputStateNumberVehicle').val();
  let vinCode = $('#inputIDVehicle').val();
  let idModel = $('#selectModelVehicle').val(); // if selected car

  // if new car
  let brand = $('#insertBrandVehicle').val();
  let model = $('#insertModelVehicle').val();
  let type = $('#insertTypeVehicle').val();

  let nextPassingDate = $('#inputNextDateTO').val();
  let nextSertificationDate = $('#inputNextDateSert').val();

  let regNumberJson = $('.edit-table').attr('id');

  let check = ``;
  if (brand == null, model == null, type == null) {
    check = ``;
    check = `&id_model=${idModel}`;
  } else {
    check = ``;
    check = `&brand=${brand}&model=${model}&type=${type}`;
  }

  promise.then(apiKey => {
    $.ajax({
      url: `api/cars?api_key=${apiKey}`,
      type: 'PUT',
      dataType: "json",
      contentType: "application/json",
      data: `prev_rn=${regNumberJson}&next_rn=${regNumber}&vin_code=${vinCode}${check}&next_passing_date=${nextPassingDate}&next_sertification_date=${nextSertificationDate}`,

      success(data) {
        $('.toast.success').toast('show');
        $('.toast .toast-body.success').text('Інформацію про машину змінено');
        $('.table-data').remove();
        fillingData();
      },
      error(data) {
        $('.toast.error').toast('show');
        $('.toast .toast-body.error').text('Сталася помилка. Неправильно введена інформація');
      },
    });
  });
});



// Creating modal for submit email send
function emailModal(value) {

  $('.createModal').ready(() => {
    $('.sendEmail').attr('id', value);

    promise.then(apiKey => {
      $.getJSON(`api/cars/${value}?api_key=${apiKey}`, (data) => {
        $('.date').remove();
        $('.firm').remove();
        $.each(data, (index) => {
          $('.date-info').append(`
          <div class="date d-flex justify-content-between w-75 mb-2">
            <div class="date-text">Дата наступного ТО: </div>
            <div class="date-nx-passing">${data[index].next_passing_date}</div> 
          </div>
  
          <div class="date d-flex justify-content-between w-75 mb-2">
            <div class="date-text">Дата наступного сертифікату: </div>
            <div class="date-nx-sertificate">${data[index].next_sertification_date}</div>
          </div>
        `);
          $('.firm-info').append(`
          <div class="firm d-flex justify-content-between w-75 mb-2">
            <div class="firm-text">Фірма: </div>
            <div class="firm-sender">${data[index].name}</div>
          </div>
        `);
        });
      });

      $.getJSON(`api/users?api_key=${apiKey}`, (data) => {
        $('.email').remove();
        $.each(data, (index) => {
          $('.email-info').append(`
          <div class="email d-flex justify-content-between w-75 mb-2">
            <div class="email-text">Ваш Email: </div>
            <div class="email-sender">${data[index].email}</div>
          </div>
        `);
        });
      });

      // $('.sendEmail').ready(() => {
      $.getJSON(`api/firms?api_key=${apiKey}`, (data) => {
        let checkPromise = new Promise(res => {
          let nameFirm = $('.firm-sender').text();
          $.each(data, (index) => {
            if (nameFirm === data[index].name) {
              setTimeout(() => res(data[index].email), 300);
            }
          });
        });

        checkPromise.then(res => {
          $('.email-info').ready(() => {
            $('.email-info').append(`
              <div class="email d-flex justify-content-between w-75 mb-4">
                <div class="email-text">Email отримувача: </div>
                <div class="email-recipient">${res}</div>
              </div>
            `);
          });
        });
      });
    });
  });
}
// ---------------------------------------------------------------------


// Function for send email
$('#send-email').click(() => {
  let promiseEmail = new Promise((resolve, reject) => {
    let dataObj = {};
    dataObj.regNumber = $('.sendEmail').attr('id');
    dataObj.firmName = $('.firm-sender').text();
    dataObj.recipient = $('.email-recipient').text();

    promise.then(apiKey => {
      $.getJSON(`api/cars/${dataObj.regNumber}?api_key=${apiKey}`, data => {
        $.each(data, index => {
          dataObj.carBrand = data[index].brand;
          dataObj.carModel = data[index].model;
        });
      });

      $.getJSON(`api/users?api_key=${apiKey}`, data => {
        $.each(data, index => {
          dataObj.department = data[index].department;
          dataObj.sender = data[index].email;
          dataObj.phone = data[index].telephone_number;
          dataObj.address = data[index].street;
          dataObj.web = data[index].web_site;
        });
      });
    });

    dataObj.dateNxPassing = $('.date-nx-passing').text();
    dataObj.dateNxSertificate = $('.date-nx-sertificate').text();

    setTimeout(() => resolve(dataObj), 500);
  });

  promiseEmail.then((resolve) => {
    $.ajax({
      url: '../vendor/dispatch/email_outofdate.php',
      type: 'POST',
      data: `department=${resolve.department}&sender_email=${resolve.sender}&phone=${resolve.phone}&address=${resolve.address}&web=${resolve.web}&firm_name=${resolve.firmName}&recipient=${resolve.recipient}&registration_number=${resolve.regNumber}&car_mark=${resolve.carBrand}&car_model=${resolve.carModel}&sertification_date=${resolve.dateNxSertificate}&passing_date=${resolve.dateNxPassing}`,

      success(data) {
        $('.toast.success').toast('show');
        $('.toast .toast-body.success').text(data);
        $('.table-data').remove();
        fillingData();
      },
      error(data) {
        $('.toast.error').toast('show');
        $('.toast .toast-body.error').text("Помилка при відправлені листа");
      }
    });
  });
});


// Creating modal for submit sms send
function smsModal(value) {
  $('.createModal').ready(() => {
    $('.sendSms').attr('id', value);

    $('.sms-info').remove();
    promise.then(apiKey => {
      $.getJSON(`api/cars/${value}?api_key=${apiKey}`, data => {
        $.each(data, index => {
          $('.sendSms').append(`
          <div class="sms-info">
            <div class="sms-reg-number d-flex justify-content-between w-75 mb-5">
              <div class="sms-title">Регістраційний номер машини: </div>
              <div class="sms-reg-number">${value}</div> 
            </div>
            <div class="sms-phone d-flex justify-content-between w-75">
              <div class="sms-title">Телефонний номер: </div>
              <div class="sms-telephone">${data[index].telephone}</div> 
            </div>
          </div>
        `);
        })
      });
    });
  });
}

// Request for send sms
$('#send-sms').click(() => {
  let promiseSms = new Promise(res => {
    promise.then(apiKey => {
      let dataInfo = {};
      dataInfo.regNumber = $('.sendSms').attr('id');

      $.getJSON(`api/users?api_key=${apiKey}`, data => {
        $.each(data, index => {
          // dataInfo.smsLogin = data[index]["sms-login"];
          // dataInfo.smsPass = data[index]["sms-pass"];
          // dataInfo.smsApiKey = data[index]["sms-api-key"];
          dataInfo.smsApiKey = apiKey;
          dataInfo.smsAlphaName = data[index]["sms-alpha-name"];
        });
      });

      dataInfo.phone = $('.sms-telephone').text();
      setTimeout(() => res(dataInfo), 500);
    });
  });

  promiseSms.then(res => {
    debugger;
    $.ajax({
      url: 'vendor/dispatch/sms.php',
      type: 'POST',
      data: `login=${res.smsLogin}&pass=${res.smsPass}&api_key=${res.smsApiKey}&alpha_name=${res.smsAlphaName}&phone=${res.phone}&registration_number=${res.regNumber}`,

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


// Delete cars from table
function deleteModal(value) {
  $('.delete-vehicle').attr('id', value);

  $('.delete-info').remove();
  $('.reg-number__delete').append(`
    <div class="delete-info d-flex justify-content-between w-75 mb-5">
      <div class="delete-text">Регістраційний номер машини: </div>
      <div class="delete-reg-number">${value}</div> 
    </div>
  `);
}

$('#delete-request').click(() => {
  let regNumber = $('.delete-vehicle').attr('id');

  promise.then(apiKey => {
    $.ajax({
      url: `api/cars?api_key=${apiKey}`,
      type: 'DELETE',
      data: `&registration_number=${regNumber}`,
      success(data) {
        $('.toast.success').toast('show');
        $('.toast .toast-body.success').text("Машину видалено");
        $('.table-data').remove();
        fillingData();
      },
      error(data) {
        $('.toast.error').toast('show');
        $('.toast .toast-body.error').text("Помилка при видалені машини");
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
// --------------------------------------------------------------------------------

