function cargarMensajes() {
  // Hace una solicitud GET a 'recibir.php' para obtener los mensajes en formato JSON
  $.get('recibir.php', function(data) {
    const mensajes = JSON.parse(data); // Convierte la respuesta (JSON) en un arreglo de objetos
    const chatDiv = $('#chat'); // Selecciona el contenedor del chat por su id
    chatDiv.html(''); // Limpia el contenido actual del chat

    // Recorre cada mensaje recibido y lo agrega al chat en formato HTML
    mensajes.forEach(m => {
      chatDiv.append(`<p><strong>${m.usuario}:</strong> ${m.mensaje}</p>`);
    });

    // Desplaza automáticamente el scroll hacia abajo para mostrar el último mensaje
    chatDiv.scrollTop(chatDiv[0].scrollHeight); // auto scroll
  });
}

function enviarMensaje() {
  const usuario = $('#usuario').val(); // Obtiene el valor del campo de texto con id 'usuario'
  const mensaje = $('#mensaje').val(); // Obtiene el valor del campo de texto con id 'mensaje'

  // Verifica que el mensaje no esté vacío o solo con espacios
  if (mensaje.trim() !== '') {
    // Envía el mensaje al servidor usando POST hacia 'enviar.php'
    $.post('enviar.php', { usuario, mensaje }, function() {
      $('#mensaje').val(''); // Limpia el campo del mensaje
      cargarMensajes(); // Recarga los mensajes para mostrar el nuevo
    });
  }
}

// Configura una actualización automática cada 2 segundos para cargar mensajes nuevos
setInterval(cargarMensajes, 2000);

// Llama a la función cargarMensajes una vez al iniciar para mostrar los mensajes al entrar
cargarMensajes(); // al iniciar
