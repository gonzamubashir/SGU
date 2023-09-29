$(document).ready(function(){
    let index = document.getElementById('formindex');

    index.addEventListener('submit', function(){
        if ($("#Usuario").val() ===''){
            alert("Ingrese un nombre de Usuario");
        }
        else if ($("#Contrasenia").val() ===''){
            alert("Ingrese una Contrasenia");
        }
    })

})