window.onload = function () {
 tb_paciente();
}
$(document).ready(function (e) {
    $("#formulario").on('submit',(function(e) {
        e.preventDefault();
        $("#message").empty();
        $('#loading').show();
            $.ajax({
            url: "extra/ERegistrar.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
            $('#loading').hide();
                limpiar();
                $("#resultados").delay().fadeIn("slow");
                $("#resultados").html(data);
                $("#resultados").delay(3000).fadeOut("slow");
            }
        });
    }));

    // Function to preview image after validation
    $(function() {
        $("#file").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('#previewing').attr('src','noimage.png');
                    $("#message").html("<p id='error'>Por favor seleccionar una formato de imagen jpeg, jpg y png, Tipo de imagen permitido.</span>");
                    return false;
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
        });
    });
    function imageIsLoaded(e) {
        $("#file").css("color","green");
        $("#file").css("font-size","14px");

        $('#image_preview').css("display", "block");
        $('#image_preview').css("text-align", "center");

        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '300px');
        $('#previewing').attr('height', '200px');
        $('#previewing').css("border", "2px solid");
    };
});
function tb_paciente(){
    var parametros = {};
    $.ajax({
        data:parametros, 
        url:"extra/paciente.php",             
        type:"POST", 
        cache:false,
        success: function(response){
            $("#paciente_tabla").html(response);
        }
    });
};
function ERegistrar(){
$("#enviar").click(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"extra/ERegistrar.php",
            data:formData,
            success: function(data){
            }
        });
    // Nos permite cancelar el envio del formulario
    return false;
    });   
};
 function limpiar(){
    $("#identification").val("");
    $("#dni").val("");
    $("#nombre_one").val("");
    $("#nombre_two").val("");
    $("#apellidopa").val("");
    $("#apellidoma").val("");
    $("#fechana").val("");
    $("#genero").val("");
    $("#estadocivil").val("");
    $("#cargo").val("");
    $("#direccion").val("");
    $("#tlfijo").val("");
    $("#tlfmovil").val("");
    $("#email").val("");
    $("#file").val("");$('#image_preview').css('display','none');


}
function mostrar(id) {
    if (id != "NaH") {
        $("#txt_dni").show();
        $("#dni").val("");
    }
    if (id == "Nah") {
        $("#dni").val("");
        $("#txt_dni").hide();
    }
}
 //Se utiliza para que el campo de texto solo acepte letras
function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario que se quiere que se muestre.
    especiales = [8, 9, ,13, 37, 39, 46]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial){
        return false;
      }
}
//Se utiliza para que el campo de texto solo acepte numeros
function SoloNumeros(evt){
    if(window.event){//asignamos el valor de la tecla a keynum
        keynum = evt.keyCode; //IE
    }else{
        keynum = evt.which; //FF
    } 
 //comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
 if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 0 )
    {
      return true;
    }else{
      return false;
 }
}