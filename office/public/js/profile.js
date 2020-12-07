// API Key
let promise = new Promise(res => {
  $.getJSON('api/users/apikeys', data => {
    res(data);
    console.log(data);
  });
});

$(document).ready(() => {
  promise.then(apiKey => {
    $.getJSON(`api/users?api_key=${apiKey}`, function (data) {
      $.each(data, function (index) {
        $('#inputEmail').val(`${data[index].email}`);
        $('#input-name-dep').val(`${data[index].department}`);
        $('#input-address').val(`${data[index].street}`);
        $('#input-web').val(`${data[index].web_site}`);
        $('#inputSurname').val(`${data[index].second_name}`);
        $('#inputName').val(`${data[index].first_name}`);
        $('#inputBirthday').val(`${data[index].date_birthday}`);
        $('#inputPhone').val(`${data[index].telephone_number}`);
      });
    });
  });
});

function changePassword() {
  $('#password_change').ready(() => {
    let inputOldPassword = $('#inputOldPassword').val();
    let inputNewPassword = $('#inputNewPassword').val();
    let confirmNewPassword = $('#confirmNewPassword').val();

    promise.then(apiKey => {
      $.ajax({
        url: `api/users?api_key=${apiKey}`,
        method: 'PUT',
        contentType: "application/json",
        dataType: 'text',
        data: `password=${inputOldPassword}&new=${inputNewPassword}&repeat=${confirmNewPassword}`,
        success: function (data) {
          $('.toast.success').toast('show');
          $('.toast .toast-body.success').text("Пароль змінено");
        },
        error: function (data) {
          $('.toast.error').toast('show');
          $('.toast .toast-body.error').text(data);
        }
      });
    });
  });
};

function changeData() {
  $('#change-user-info').ready(() => {
    let name = $('#inputName').val();
    let surname = $('#inputSurname').val();
    let birthday = $('#inputBirthday').val();
    let phone = $('#inputPhone').val();
    let email = $('#inputEmail').val();
    let department = $('#input-name-dep').val();
    let street = $('#input-address').val();
    let web_site = $('#input-web').val();

    promise.then(apiKey => {
      $.ajax({
        url: `api/users?api_key=${apiKey}`,
        method: 'PUT',
        contentType: "application/json",
        dataType: 'text',
        data: `name=${name}&surname=${surname}&birthday=${birthday}&phone=${phone}&email=${email}&department=${department}&street=${street}&web_site=${web_site}`,
        success: function (data) {
          $('.toast.success').toast('show');
          $('.toast .toast-body.success').text("Інформацію змінено");
        },
        error: function (data) {
          $('.toast.error').toast('show');
          $('.toast .toast-body.error').text(data);
        }
      });
    });
  });
};