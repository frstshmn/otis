// User info
let promise = new Promise(res => {
  $.getJSON('api/users/apikeys', data => {
    res(data);
    console.log(data);
  });
});

promise.then(apiKey => {
  $.getJSON(`api/users?api_key=${apiKey}`, (data) => {
    $.each(data, (index) => {
      $('#user-name').text(`${data[index].first_name} ${data[index].second_name}`);
      $('#user-telephone').text(`${data[index].telephone_number}`);
      $('#user-email').text(`${data[index].email}`);
      $('#user-department').text(`${data[index].department}`);
      $('#user-street').text(`${data[index].street}`);
      $('#alphasms-count').text(`${data[index].balance == null ? '-' : data[index].balance}`);
    });
  });
  
  
  
  // Firms info
  let firmsArr = $.getJSON(`api/firms?api_key=${apiKey}`, () => {
    let jsonArr = firmsArr.responseJSON;
    let lenghtArr = Object.keys(jsonArr).length;
  
    $('#firms-count').text(`${lenghtArr}`);
  });
  
  // Cars info
  let carsArr = $.getJSON(`api/cars?api_key=${apiKey}`, () => {
    let jsonArr = carsArr.responseJSON;
    let lenghtArr = Object.keys(jsonArr).length;
  
    $('#cars-count').text(`${lenghtArr}`);
  });
  
  // TO count
  $.getJSON(`api/cars?api_key=${apiKey}`, (data) => {
    let sumThirty = 0;
    let sumSeven = 0;
    $.each(data, (index) => {
      let date = data[index].next_passing_date;
      let dateFormat = new Date(date); // date 2
      let currentDate = new Date(); //date1
  
      let diffDays = Math.ceil((dateFormat - currentDate) / (1000 * 3600 * 24));
  
      if (diffDays < 30) {
        sumThirty++;
      }
      if (diffDays <= 0) {
        sumThirty--;
      }
  
      if (diffDays < 14) {
        sumSeven++;
      }
      if (diffDays <= 0) {
        sumSeven--;
      }
  
      // if (diffDays <= 0) {
      //   status = 'status-today';
      //   statusDay = 'today';
      // }
    });
    $('#next-thirty').text(`${sumThirty}`);
    $('#next-seven').text(`${sumSeven}`);
  });
  
  // Sertificate count
  $.getJSON(`api/cars?api_key=${apiKey}`, (data) => {
    let sum = 0;
    $.each(data, (index) => {
      let dateSert = data[index].date_of_receiving_sertificate;
      let nextSert = data[index].next_sertification_date;
  
      if (dateSert !== '0000-00-00' && nextSert !== '0000-00-00') {
        sum++;
      }
    });
    $('#sertificate-count').text(sum);
  });
});

