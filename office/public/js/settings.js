// API Key
let promise = new Promise(res => {
  $.getJSON('api/users/apikeys', data => {
    res(data);
    console.log(data);
  });
});

promise.then(apiKey => {
  $.getJSON(`api/users?api_key=${apiKey}`, data => {
    $.each(data, (index) => {
      $('#smslogin').val(data[index]["sms-login"]);
      $('#smspassword').val(data[index]["sms-pass"]);
      $('#smsapikey').val(data[index]["sms-api-key"]);
      $('#smsalphaname').val(data[index]["sms-alpha-name"]);
      $('#smstext').val(data[index]["sms-text-template"]);
    })
  });
});

$('#send-info').click( () => {
  const smslogin = $('#smslogin').val();
  const smspassword = $('#smspassword').val();
  const smsapikey = $('#smsapikey').val();
  const smsalphaname = $('#smsalphaname').val();
  const smstext = $('#smstext').val();

  promise.then(apiKey => {
    $.ajax({
      url: `api/users/sms?api_key=${apiKey}`,
      type: 'PUT',
      data: `&sms_login=${smslogin}&sms_pass=${smspassword}&sms_api_key=${smsapikey}&sms_alpha_name=${smsalphaname}&sms_text_template=${smstext}`,
      success(data) {
        alert(data);
      },
      error(data) {
        alert(data);
      }
    });
  });
});

