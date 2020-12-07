let promise = new Promise(res => {
  $.getJSON('api/users/apikeys', data => {
    res(data);
  });
});

promise.then(apiKey => {
  function updateData() {
    $.getJSON(`api/firms?api_key=${apiKey}`, function (data) {
      $.each(data, function (index) {
        $('.main-table').append(`
          <tr class="table-data">
            <td class="align-middle ${status}">${data[index].name}</td>
            <td class="align-middle ${status}">${data[index].id_firm}</td>
            <td class="align-middle ${status}">${data[index].telephone}</td>
            <td class="align-middle ${status}">${data[index].email}</td>
            <td class="edit-btn align-middle">
              <div onclick="editFunc('${data[index].id_firm}')" class="edit-button btn btn-outline-success btn-block align-middle btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                Редагувати
              </div>
            </td> 
          </tr>`);
      });
    });
  }

  updateData();

  // Firms Filter
  $('.table-filter').jSearch({
    selector: '.main-table',
    child: 'tr > td',
    minValLength: 0,
    Before: function () {
      $('.main-table tr').data('find', '');
    },
    Found: function (elem, event) {
      $(elem).parent().data('find', 'true');
      $(elem).parent().show();
    },
    NotFound: function (elem, event) {
      if (!$(elem).parent().data('find'))
        $(elem).parent().hide();
    },
    After: function (t) {
      if (!t.val().length) $('.main-table tr').show();
    }
  });

  // $('#create-firm').click( () => {
  //   let idFirm = $('#create-id-firm').val();
  //   let firmName = $('#create-firm-name').val();
  //   let firmNumber = $('#create-firm-number').val();
  //   let firmEmail = $('#create-firm-email').val();

  //   console.log(idFirm,
  //     firmName,
  //     firmNumber,
  //     firmEmail);
  //   $.ajax({
  //     url: `api/firms`,
  //     method: 'POST',
  //     dataType: "json",
  //     data: `id_firm=${idFirm}&name=${firmName}&telephone=${firmNumber}&email${firmEmail}`,
  //     success(data) {
  //       $('.toast.success').toast('show');
  //       $('.toast .toast-body.success').text(data);
  //     },
  //     error(data) {
  //       $('.toast.error').toast('show');
  //       $('.toast .toast-body.error').text(data);
  //       console.log(data);
  //     }
  //   })
  // });

  // Editing information about firms
  $('#put-request').click(function () {
    let firmName = String($('#firm-name').val());
    let firmCode = String($('#id-firm').val());
    let firmContacts = String($('#firm-contacts').val());
    let firmEmail = String($('#firm-email').val());

    let firmCodeJson = $('.edit-table').attr('id');

    $.ajax({
      url: `api/firms?api_key=${apiKey}`,
      type: 'PUT',
      dataType: "json",
      contentType: "application/json",
      data: 'id_firm_prev=' + firmCodeJson + '&id_firm_next=' + firmCode + '&name=' + firmName + '&telephone=' + firmContacts + '&email=' + firmEmail,
      success(data) {
        alert(data);
        $('.table-data').remove();
        updateData();
      },
      error() {
        alert(data);
      },
    });
  });
});

// Output info in input
function editFunc(value) {
  promise.then(apiKey => {
    $('.edit-table').attr('id', value);

    $.getJSON(`api/firms/${value}?api_key=${apiKey}`, (data) => {
      $.each(data, (index) => {
        $('#firm-name').val(data[index].name);
        $('#id-firm').val(data[index].id_firm);
        $('#firm-contacts').val(data[index].telephone);
        $('#firm-email').val(data[index].email);
      });
    });
  });
}