$(document).ready(function () {
ERegistrar();
});
function ERegistrar(){
$("#enviar").click(function(e){
    e.preventDefault;
        $.ajax({
            type:"POST",
            url:"extra/ERegistrar.php",
            data:$("#formulario").serialize(),
            success: function(data){
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */
                $("#resultados").delay().fadeIn("slow");
                $("#resultados").html(data);
                $("#especialidad").val("");
                $("#detalle").val("");
                $("#resultados").delay(800).fadeOut("slow");
    
                setTimeout ("redireccionar()", 800);

            }
        });
    // Nos permite cancelar el envio del formulario
    return false;
    });   
};
function redireccionar(){
window.location="cuenta.php";
} 