window.onload = function () {
tb_usuario();
}
$(document).ready(function () {
ERegistrar();
    $("#tp_usuario").on('change', function () {            
        var op = $(this).val();
        switch (op) {
            case "1":
                alert("Advertencia selecciono Root.");
                break;
            case "2":
                alert("Advertencia selecciono Administrador.");
                break;
        }
    });
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
                $("#user").val("");
                $("#pass").val("");
                $("#tp_usuario").val("");
                $("#resultados").delay(2000).fadeOut("slow");
            }
        });
    // Nos permite cancelar el envio del formulario
    return false;
    }));   
};
function tb_usuario(){
    var parametros = {};
    $.ajax({
        data:parametros, 
        url:"extra/usuario.php",
        type:"POST", 
        cache:false,
        success: function(response){
            $("#usuario_tabla").html(response);
        }
    });
};