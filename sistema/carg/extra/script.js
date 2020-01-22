window.onload = function () {
tb_cargo();
}

$(document).ready(function () {
ERegistrar();
});
function ERegistrar(){
 $("#formulario").on('submit',(function(e) {
        e.preventDefault();
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
                $("#cargo").val("");
                $("#detalle").val("");
                $("#resultados").delay(2000).fadeOut("slow");
            }
        });
    // Nos permite cancelar el envio del formulario
    return false;
    }));
};
function tb_cargo(){
    var parametros = {};
    $.ajax({
        data:parametros, 
        url:"extra/cargo.php",             
        type:"POST", 
        cache:false,
        success: function(response){
            $("#cargo_tabla").html(response);
        }
    });
};
