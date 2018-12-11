$(document).ready(function(){
    $('#panel').load('inicio.html');
    $('#inicio').click(function () {
        $('#panel').load('inicio.html');
    });
    $('#servicio').click(function(){
        $('#panel').load('servicios.html');
    });

    $('#instalaciones').click(function(){
        $("#panel").load('instalaciones.html');
    });

    $('#reserva').click(function(){
        $('#panel').load('reservas.html');
    });

    $('#registro').click(function(){
        $('#panel').load('registro.html');
    });

    $('#login').click(function(){

        $('#panel').load('login.html');


    });



    $(".nav a").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });
    if(sessionStorage.getItem('dataStored')!=='') {
        $("#login").children('span').prop('class').replace('fa-sign-in-alt', '');
    }
});
var http_request = new XMLHttpRequest();

function login(){
    var user=document.getElementById('username').value;
    var pass=document.getElementById('password').value;
    if(validainputlogin(user,pass)) {
        var url = "http://fenw.etsisi.upm.es:1723/users/login?username=" + user + "&password=" + pass;
        http_request.open("GET", url, true);
        http_request.responseType = 'json';
        http_request.onload = TrataRespuesta;
        http_request.send();
    }
}
function validainputlogin(usr,pass){
let valido=true;
    if (usr === '' || pass==='') {
        document.getElementById("erroincompleto").style.display = 'inline';
        valido= false;
    }

    return valido;
}
function TrataRespuesta() {
    let respuesta="";
    if(http_request.status==200){
        respuesta = http_request.response;

        console.log(respuesta);
        sessionStorage.setItem('dataStored', respuesta);
        updateToIconlogin("in");
        //document.getElementById('respuesta').innerHTML=respuesta;
    }
    if(http_request.status==401 || http_request.status==400){
        swal({
            type: 'error',
            title: 'Oops...',
            text: 'Usuario y/o Contraseña incorrecta!',
            footer: '<a href>No ha sido posible autenticarlo</a>'
        })
    }
}
function updateToIconlogin(val){

    var nodeLogin = document.getElementById("login");
    while (nodeLogin.firstChild) {
        nodeLogin.removeChild(nodeLogin.firstChild);
    }
    if(val=='in') {

        $('#panel').load('reservas.html');
        $('#login').attr('onClick', 'logout();');
        $("#login").append("<span class='fa fa-sign-out-alt' onclick='logout();'></span>logout");
    }else{
        $('#login').attr('onClick', '');
        $("#login").append("<span class='fa fa-sign-in-alt' ></span>login");

    }
}

function logout(){

        swal(
        'Se cerrará su sesión?',
        'Esta seguro?',
        ''
    ).then((result) => {
            updateToIconlogin("out");
            // Remove saved data from sessionStorage
            sessionStorage.removeItem('dataStored');

// Remove all saved data from sessionStorage
            sessionStorage.clear()

    })

}


