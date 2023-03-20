function registerUser() {
    var formData = $('#gf').serialize();
    
    $.ajax({
      type: 'POST',
      url: 'php/register.php',
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      console.log(data);
    });
  }
  
  $(document).ready(function() {
    $('#gf').submit(function(event) {
      event.preventDefault();
      registerUser();
    });
  });