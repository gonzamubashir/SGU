$(document).ready(function(){
    let paso2 = document.getElementById('formpaso2');
    //sljdafhkjsdhfjashfdkj
    paso2.addEventListener('submit', function(){
        if($("#Telefono").val() !=''){
            if($("#Telefono").val().length < 9){
                
                alert("Tipo de telefono invalido");
            }
            else { 
                
                let x = 0;
                for (i=0;i<$("#Telefono").val().length;i++){
                    if ($("#Telefono").val()[i] != '-'){
                        
                        x++;
                    }
                    if (x == ($("#Telefono").val().length)){
                        
                        alert("Telefono invalido");
                    }
                }
            }
        }
        if($("#Celular").val() !=''){
            if($("#Celular").val().length < 9){
                alert("Tipo de Celular invalido");
            }
            else { 
                
                let x = 0;
                for (i=0;i<$("#Celular").val().length;i++){
                    if ($("#Celular").val()[i] != '-'){
                        x++;
                    }
                    if (x == ($("#Celular").val().length)){
                        alert("Celular invalido");
                    }
                }
            }
        }
        if($("#Domicilio").val() ===''){
            alert("Debe ingresar un domicilio");
        }
        if($("#Localidad").val() ===''){
            alert("Debe ingresar una Localidad");
        }
        if($("#Email").val() ===''){
            alert("Debe Ingresar un Correo");
        }
        if ($("#Email").val() !=''){
            for (i=0;i<$("#Email").val().length;i++){
                    
                if ($("#Email").val()[i] == '@'){
               
                        return true;
                    }
                else{ if (($("#Email").val().length-1) == i){
                 
                    alert("El correo es Invalido");
                    }
                }
            }
        }
           
    })
})