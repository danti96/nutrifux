window.onload = function () {
tb_tpusuario();
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
                $("#resultados").delay().fadeIn("slow");
                $("#resultados").html(data);
                $("#nombre").val("");
                $("#detalle").val("");
                $("#resultados").delay(2000).fadeOut("slow");
            }
        });
    // Nos permite cancelar el envio del formulario
    return false;
    }));   
};

function tb_tpusuario(){
    var parametros = {};
    $.ajax({
        data:parametros, 
        url:"extra/tp_usuario.php",
        type:"POST", 
        cache:false,
        success: function(response){
            $("#tp_usuario_tabla").html(response);
        }
    });
};
