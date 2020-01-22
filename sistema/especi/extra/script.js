$(document).ready(function () {
ERegistrar();ERegistrar2();
agregar();

$('#bt_del').click(function(){
    eliminar(id_fila_selected);
});
});
window.onload = function () {
  tb_especi();buscar();
  buscare();
}

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
                $("#especialidad").val("");
                $("#detalle").val("");
                $("#resultados").delay(1000).fadeOut("slow");
            }
        });
    // Nos permite cancelar el envio del formulario
    return false;
    }));
};
function tb_especi(){
    var parametros = {};
    $.ajax({
        data:parametros, 
        url:"extra/especialidad.php",             
        type:"POST", 
        cache:false,
        success: function(response){
            $("#especialidad_tabla").html(response);
        }
    });
};
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
/*========================================
=            Section empleado            =
========================================*/
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

/*========================================
=            Section especi            =
========================================*/


function buscare(busqueda){
    $.ajax({
        url: "extra/evalida.php",
        type: "POST",
        data: { busqueda: busqueda },
        success: function(response){
            $("#result_search_e").html(response);
        }
    });
};
$(document).on('keyup','#textespeci', function(){
    var valorBusqueda=$(this).val();
    if (valorBusqueda!="") {
        buscare(valorBusqueda);
    }
    else
    {
        buscare();
    }
})
function ERegistrar2(){
 $("#formulario2").on('submit',(function(e) {
        e.preventDefault();

        var filas = [];
        $('#tabla tbody tr').each(function() {
          var esp_id = $(this).find('td').eq(0).text();
          var em_id = $(this).find('td').eq(2).text();
        var fila   = {em_id,esp_id};
        filas.push(fila);
        });
        var opcion =$("#formulario2 #opcion").val();
        valores = JSON.stringify(filas);
        $.ajax({
        type: "POST",
        url:"extra/ERegistrar.php",
        data: { valores : JSON.stringify(filas),"opcion": opcion },
        success: function(data) { 
                $("#resultados").delay().fadeIn("slow");
                $("#resultados").html(data);
                $("#resultados").delay(2000).fadeOut("slow");
                eliminarTodasFilas();
                $("#especialidad").val();
                $("#employee").val();
                $("#textespeci").val();
                $("#textdni").val();
                 $('#bt_add').css("background","#5a6268");
        }
        });
 
    // Nos permite cancelar el envio del formulario
    return false;
    }));

};

/*===================================================
= FUNCTIONES PARA AGREGAR ESPECIALIDAD EN LA TABLA  =
====================================================*/


var cont=0;
var id_fila_selected=[];
function agregar(){
 var va = 0;
  $('#bt_add').on('click', function(){
    if (va == 0) {
      $('#bt_add').css("background","#17a2b8");
      var valor=$("#especialidad option:selected").val();
      var tex=$("#especialidad option:selected").text();
      var em=$("#employee option:selected").val();
      if (em == "" || tex == "" ) {
        alert("Debe seleccionar un Empleado y una Especialidad");
      }else{
      cont++;
          var fila='<tr class="selected" id="fila'+cont+'" onclick="seleccionar(this.id);"><td>'+valor+'</td><td>'+tex+'</td><td>'+em+'</td></tr>';
          $('#tabla').append(fila);
          va = 0;
          $("#especialidad").val();
      }
     }
  });
}

function seleccionar(id_fila){
    if($('#'+id_fila).hasClass('seleccionada')){
        $('#'+id_fila).removeClass('seleccionada');
    }
    else{
        $('#'+id_fila).addClass('seleccionada');
    }
    //2702id_fila_selected=id_fila;
    id_fila_selected.push(id_fila);
}

function eliminar(id_fila){
    /*$('#'+id_fila).remove();
    reordenar();*/
    for(var i=0; i<id_fila.length; i++){
        $('#'+id_fila[i]).remove();
    }
    reordenar();
}

function reordenar(){
    var num=1;
    $('#tabla tbody tr').each(function(){
        $(this).find('td').eq(0).text(num);
        num++;
    });
}
    function eliminarTodasFilas(){
        $('#tabla tbody tr').each(function(){
            $(this).remove();
        });

    }