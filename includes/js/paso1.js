$(document).ready(function(){
    


    let paso1 = document.getElementById('formpaso1');
        
    paso1.addEventListener('submit', function(){
        
        if($("#Usuario").val() ===''){
            alert("El Nombre de Usuario no puede ser vacio");
            
        }
        else if($("#Contrasenia").val() ===''){
            alert("Debe Ingresar una contrasenia");
        }
        else if($("#Apellido").val() ===''){
            alert("Debe Ingresar un Apellido");
        }
        else    if($("#Nombre").val() ===''){
            alert("Debe Ingresar un Nombre");
        }
        
        else if($("#Documento").val() ===''){
            alert("Debe Ingresar un Documento");
        }
        else if  (!document.validar.Sexo[0].checked && !document.validar.Sexo[1].checked){
            alert ("El campo Sexo es requerido");
        } 
        else if($("#Nacionalidad").val() ===''){
            alert("Debe Ingresar una Nacionalidad");
        }
        else if ($("#Documento").val() !==''){
            let x = 0;
            let y = 0;
            for(i=0; i<$("#Documento").val().length;i++){
                for (j=48;j<58;j++){
                    if($("#Documento").val()[i] === String.fromCharCode(j)){
                        x++;
                    }
                }
                y++;
            }
            if (x!=y){
                alert ("Los campos deben ser numericos");
            }
            else{
            
                if ($("#Contrasenia").val().length < 6){
                    
                    alert("La contrasenia no cumple lo requerido");
                } 
            
                else {
                    
                    let x = 0;
                    let y = 0;
                    for (i=0;i<$("#Contrasenia").val().length;i++){
                        
                        for (j=65;j<123;j++){
                            if ($("#Contrasenia").val()[i]  === String.fromCharCode(j)){
                                
                                x++;
                                
                            }
                        }
                    }
                    for (i=0;i<$("#Contrasenia").val().length;i++){
                        for(k=0;k<9;k++){
                            if($("#Contrasenia").val()[i] == k){
                                
                                y++;
                            
                            }
                        }
                    }
                    if(x<1 || y<1){
                        
                        alert("La contrasenia NO cumple lo requerido");
                    }
                   
                }
            }
        }
        
        
    })
  
})
