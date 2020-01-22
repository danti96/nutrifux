window.onload = function () {
    buscar();tb_empleado();
}
$(document).ready(function () {
ERegistrar();

});
function buscar(busqueda){
    $.ajax({
        url: "extra/valida.php",
        type: "POST",
        data: { busqueda: busqueda },
        success: function(response){
            $("#result_search").html(response);
        }
    });
};
$(document).on('keyup','#textdni', function(){
    var valorBusqueda=$(this).val();
    if (valorBusqueda!="") {
        buscar(valorBusqueda);
    }
    else
    {
        buscar();
    }
})

function tb_empleado(){
    var parametros = {};
    $.ajax({
        data:parametros, 
        url:"extra/admin_tera.php",             
        type:"POST", 
        cache:false,
        success: function(response){
            $("#empleado_tabla").html(response);
        }
    });
};
function ERegistrar(){
 $("#formulario").on('submit',(function(e) {
    $( "#formulario" ).submit();
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"extra/ERegistrar.php",
            data:$("#formulario").serialize(),
            success: function(data){
                $("#resultados").delay().fadeIn("slow");
                $("#resultados").html(data);
                $("#resultados").delay(2000).fadeOut("slow");
                $("#employee").val("");
                $("#textdni").val("");
                $("#hora_inicio").val("");  $("#min_inicio").val("");
                $("#hora_almuerzo").val("");$("#min_almuerzo").val("");
                $("#hora_retorno").val(""); $("#min_retorno").val("");
                $("#hora_salida").val("");  $("#min_salida").val("");
                $("#especialidad").val("");

                $('#formulario input[type="checkbox"]').prop("checked",false);
            }   
        });
 
    // Nos permite cancelar el envio del formulario
    return false;
    }));

};
