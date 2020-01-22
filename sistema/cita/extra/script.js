window.onload = function () {
tb_especi();
}

$(document).ready(function () {
$("#evaluacion").hide();
$("#terapia").hide();
$("#result_search").hide();
$("#evaluacion").hide();
$("#terapia").hide();
$("#result_search").hide();
 });
function tb_especi(){
    var parametros = {};
    $.ajax({
        data:parametros, 
        url:"extra/valida.php",             
        type:"POST", 
        cache:false,
        success: function(response){
            $("#result_search").html(response);
        }
    });
};
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
 
function tipo_reservacion(id) {
    if (id == "NaH") {
        $("#evaluacion").hide();
        $("#terapia").hide();
        $("#result_search").hide();
        $("#formulario #terapista").val("");
        $("#formulario #id").val("");
     }
    if (id == "evaluacion") {
        $("#evaluacion").show();
        $("#terapia").hide();
        $("#result_search").hide();
        $("#formulario #terapista").val("");
        $("#formulario #id").val("");
     }
    if (id == "terapia") {
        $("#evaluacion").hide();
        $("#terapia").show(); 

        $("#matutinohora").hide();
        $("#divfecha").hide();
        $("#vespertinohora").hide();
        $("#divterapista").hide();
        $("#result_search").hide();
        $("#formulario #tipojornada").val("");
        $("#formulario #terapista").val("");
        $("#formulario #id").val("");
    }
}
function tipo_jornada(id) {
    if (id == "NaH") {
        $("#divfecha").hide();
        $("#matutinohora").hide();
        $("#vespertinohora").hide();
        $("#divterapista").hide();
        $("#result_search").hide();
        $("#formulario #terapista").val("");
        $("#formulario #id").val("");
     }
    if (id == "Matutino") {
         if (id!="") {
            buscar(id);
        }
        else
        {
            buscar();
        }
        $("#divfecha").show();
        $("#matutinohora").show();
        $("#vespertinohora").hide();
        $("#divterapista").show();
        $("#result_search").show();
        $("#formulario #terapista").val("");
        $("#formulario #id").val("");
        $('input[type="date"]').val("");
     }
    if (id == "Vespertino") {
                if (id!="") {
            buscar(id);
        }
        else
        {
            buscar();
        }
        $("#divfecha").show();
        $("#matutinohora").hide();
        $("#vespertinohora").show();
        $("#divterapista").show();
        $("#result_search").show();
        $("#formulario #terapista").val("");
        $("#formulario #id").val("");
        $('input[type="date"]').val("");
     }
}