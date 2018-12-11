


function enviar() {

    var username = $('#username').val();
    var password = $('#password').val();
    var reppassword = $('#repeatedPassword').val();
    var email = $('#email').val();
    var fechanac = $('#birthDate').val();

    $(".error").remove();
    if (username.length < 1) {
        $('#username').after('<span class="error text-danger">El usuario es requerido</span>');
    }
    if (password.length < 1) {
        $('#password').after('<span class="error text-danger">Introduzca la password</span>');
    }
    if (reppassword.length < 1) {
        $('#repeatedPassword').after('<span class="error text-danger">repetir password</span>');
    }
    if (reppassword.length > 1 && reppassword!==password) {
        $('#repeatedPassword').after('<span class="error text-danger">Las contrase&ntilde;as introducidas no son iguales</span>');
    }
    if (email.length < 1) {
        $('#email').after('<span class="error text-danger">El email es requerido</span>');
    } else {
        var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
        var validEmail = regEx.test(email);
        if (!validEmail) {
            $('#email').after('<span class="error text-danger">El correo introducido no es válido</span>');
        }
    }
    if (password.length < 8) {
        $('#psword').after('<span class="error text-danger">Password must be at least 8 characters long</span>');
    }

}


