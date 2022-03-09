$('#send-mail').on('submit',function(ev){
    ev.preventDefault();
    message_body = {
      Nombre:   $('#Nombre').val(),
      Apellido: $('#Apellido').val(),
      Telefono: $('#Telefono').val(),
      Email:    $('#Email').val(),
      Servicio: $('#Servicio').val(),
      Mensaje:  $('#Mensaje').val()
    }
    $.post( "ajax/mailing.php", message_body, function( data ) {
      $('.modal-body').html(data);
      $('.modal').modal('show');
      $('#send-mail').trigger('reset');
    });
  });

$('.btn.custom').on('click', function(){
    location.href="contacto.html#contacto"
});