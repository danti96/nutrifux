<?php
    require '../../../func/conexion.php';
    session_start(); //Iniciar una nueva sesión o reanudar la existente
    
    if(!isset($_SESSION["us_id"])){ //En caso de no existir la sesión redireccionamos
        header("Location: ../admin_tera.php");
    }
    $id = $_SESSION['us_id'];
    $sql = "SELECT us_id, us_usuario FROM usuario WHERE us_id = '$id'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<div class="col-sm-offset-2 col-sm" style="background-color:white;padding: 10px;text-align: center;font-size: 15px;font-weight: bold">
<p id="mensaje"></p>
</div>
<br><br>
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="col-sm btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <strong>Tabla </strong>
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body table-responsive">
        <table id="example" class="display table table-hover" width="100%">
            <thead class="thead-dark">
              <tr>
                <th>Nombre Empleado</th>
                <th>Hora Inicio</th>
                <th>Hora Almuerzo</th>
                <th>Hora Retorno</th>
                <th>Hora Salida</th>
                <th>Dia Laboral</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

 <!-- Modal Editar-->
  <div>
    <form id="frmeditartipo" action="" method="POST">
      <!-- Modal -->
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modalEliminarLabel">Editar Jornada de trabajo del Terapista</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="opcion" name="opcion" value="editar">
              <input type="hidden" id="id" name="id" value="">

              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Nombre del Empleado  </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="employee" id="employee" readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                <label class="col-sm-2">Hora de Inicio</label>
                  <div class="col-sm-10">
                    <div class="col-sm-9  row">
                      <select class="form-control col-sm-3" name="hora_inicio" id="hora_inicio">
                        <option value=""></option>
                        <option value="00">00 </option>
                        <option value="08">08 </option>
                        <option value="09">09 </option>
                        <option value="10">10 </option>
                        <option value="11">11 </option>
                        <option value="12">12 </option>
                        <option value="13">13 </option>
                        <option value="14">14 </option>
                        <option value="15">15 </option>
                        <option value="16">16 </option>
                        <option value="17">17 </option>
                        <option value="18">18 </option>
                        <option value="19">19 </option>
                        <option value="20">20 </option>
                      </select>
                      <label for="" style="padding: 5px"><strong>Hrs</strong></label>
                    <select class="form-control col-sm-3" name="min_inicio" id="min_inicio">
                      <option value=""></option>
                      <option value="00">00 </option>
                      <option value="30">30 </option>
                    </select>
                      <label for="" style="padding: 5px"><strong>Mns</strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Hora de Almuerzo</label>
                  <div class="col-sm-10">
                    <div class="col-sm-9  row">
                      <select class="form-control col-sm-3" name="hora_almuerzo" id="hora_almuerzo">
                        <option value=""></option>
                        <option value="00">00 </option>
                        <option value="08">08 </option>
                        <option value="09">09 </option>
                        <option value="10">10 </option>
                        <option value="11">11 </option>
                        <option value="12">12 </option>
                        <option value="13">13 </option>
                        <option value="14">14 </option>
                        <option value="15">15 </option>
                        <option value="16">16 </option>
                        <option value="17">17 </option>
                        <option value="18">18 </option>
                        <option value="19">19 </option>
                        <option value="20">20 </option>
                      </select>
                      <label for="hrs" style="padding: 5px"><strong>Hrs</strong></label>
                    <select class="form-control col-sm-3" name="min_almuerzo" id="min_almuerzo">
                      <option value=""></option>
                      <option value="00">00 </option>
                      <option value="30">30 </option>
                    </select>
                      <label for="s" style="padding: 5px"><strong>Mns</strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Hora de Retorno</label>
                  <div class="col-sm-10">
                    <div class="col-sm-9  row">
                      <select class="form-control col-sm-3" name="hora_retorno" id="hora_retorno">
                        <option value=""></option>
                        <option value="00">00 </option>
                        <option value="08">08 </option>
                        <option value="09">09 </option>
                        <option value="10">10 </option>
                        <option value="11">11 </option>
                        <option value="12">12 </option>
                        <option value="13">13 </option>
                        <option value="14">14 </option>
                        <option value="15">15 </option>
                        <option value="16">16 </option>
                        <option value="17">17 </option>
                        <option value="18">18 </option>
                        <option value="19">19 </option>
                        <option value="20">20 </option>
                      </select>
                      <label for="hrs" style="padding: 5px"><strong>Hrs</strong></label>
                    <select class="form-control col-sm-3" name="min_retorno" id="min_retorno">
                      <option value=""></option>
                      <option value="00">00 </option>
                      <option value="30">30 </option>
                    </select>
                      <label for="s" style="padding: 5px"><strong>Mns</strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Hora de Salida</label>
                  <div class="col-sm-10">
                    <div class="col-sm-9  row">
                      <select class="form-control col-sm-3" name="hora_salida" id="hora_salida">
                        <option value=""></option>
                        <option value="00">00 </option>
                        <option value="08">08 </option>
                        <option value="09">09 </option>
                        <option value="10">10 </option>
                        <option value="11">11 </option>
                        <option value="12">12 </option>
                        <option value="13">13 </option>
                        <option value="14">14 </option>
                        <option value="15">15 </option>
                        <option value="16">16 </option>
                        <option value="17">17 </option>
                        <option value="18">18 </option>
                        <option value="19">19 </option>
                        <option value="20">20 </option>
                      </select>
                      <label for="hrs" style="padding: 5px"><strong>Hrs</strong></label>
                    <select class="form-control col-sm-3" name="min_salida" id="min_salida">
                      <option value=""></option>
                      <option value="00">00 </option>
                      <option value="30">30 </option>
                    </select>
                      <label for="s" style="padding: 5px"><strong>Mns</strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label for="dia" class="col-sm-2 control-label">Asistencia</label>
                  <div class="col-sm-10">
                    <label class="checkbox-inline">
                    <input type="checkbox" id="Luness" name="dia[]" value="Lunes"> Lunes
                    </label>

                    <label class="checkbox-inline">
                    <input type="checkbox" id="Martes" name="dia[]" value="Martes"> Martes
                    </label>

                    <label class="checkbox-inline">
                    <input type="checkbox" id="Mierco" name="dia[]" value="Miercoles"> Miercoles
                    </label>

                    <label class="checkbox-inline">
                    <input type="checkbox" id="Jueves" name="dia[]" value="Jueves"> Jueves
                    </label>
                    <label class="checkbox-inline">
                    <input type="checkbox" id="Vierne" name="dia[]" value="Viernes"> Viernes
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">              
              <button type="submit" id="editaR" class="btn btn-primary" data-dismiss="modal">Editar Tipo de Usuario</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
  </div>
   <!-- Modal Eliminar -->
  <div>
    <form id="frmEliminarTipo" action="" method="POST">
      <input type="hidden" id="id" name="id" value="">
      <input type="hidden" id="opcion" name="opcion" value="eliminar">
      <!-- Modal -->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Jornada de trabajo del Terapista</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              ¿Está seguro de eliminar permanentemente la especialidad?<strong data-name=""></strong>
            </div>
            <div class="modal-footer">
              <button type="button" id="eliminar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
  </div>
   <!-- Modal Cambiar -->
  <div>
    <form id="frmestadoTipo" action="" method="POST">
      <input type="hidden" id="id" name="id" value="">
      <input type="hidden" id="opcion" name="opcion" value="cambiar">
      <!-- Modal -->
      <div class="modal fade" id="modalEstado" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modalEliminarLabel">Cambiar estado de la Jornada de trabajo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              ¿Está seguro que desea cambiar el estado de la especialidad?<strong data-name=""></strong>
            </div>
            <div class="modal-footer">
              <button type="button" id="cambiar-usuario" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
    </form>
  </div>
<!--===========================================-->  
<script>
$(document).ready(function() {
  listar();
  editar();
  eliminar();
  cambiar();
});
 
    var editar = function(){
      $("#editaR").on("click", function(){
          $.ajax({
            method:"POST",
            cache:false,
            url: "extra/ERegistrar.php",
            data: $("#frmeditartipo").serialize(),
          }).done( function( info ){
            var json_info = JSON.parse( info );
            console.log( info );
            mostrar_mensaje( json_info );
            limpiar_datos();
            $('#example').DataTable().ajax.reload();
          });
      });  
    };
    var eliminar = function(){
      $("#eliminar-usuario").on("click", function(){
        var id=$("#frmEliminarTipo #id").val(),
        opcion=$("#frmEliminarTipo #opcion").val();
          $.ajax({
            method:"POST",
            url: "extra/ERegistrar.php",
            data: {"id": id, "opcion": opcion}
          }).done( function( info ){
            var json_info = JSON.parse( info );
            mostrar_mensaje( json_info );
            limpiar_datos();
           $('#example').DataTable().ajax.reload();
          });
      });  
    };
    var cambiar = function(){
      $("#cambiar-usuario").on("click", function(){
        var id=$("#frmestadoTipo #id").val(),
        opcion=$("#frmestadoTipo #opcion").val();
          $.ajax({
            method:"POST",
            url: "extra/ERegistrar.php",
            data: {"id": id, "opcion": opcion}
          }).done( function( info ){
            var json_info = JSON.parse( info );
            mostrar_mensaje( json_info );
            limpiar_datos();
           $('#example').DataTable().ajax.reload();
          });
      });  
    };
    var mostrar_mensaje = function( informacion ){
      var texto = "", color = "";
      if( informacion.respuesta == "BIEN" ){
          texto = "<div class='col-sm' style='banckground-color:white;'><strong>Bien!</strong> Se han guardado los cambios correctamente.</div>";
          color = "#379911";
      }else if( informacion.respuesta == "ERROR"){
          texto = "<strong>Error</strong>, no se ejecutó la consulta.";
          color = "#C9302C";
      }else if( informacion.respuesta == "EXISTE" ){
          texto = "<strong>Información!</strong> el usuario ya existe.";
          color = "#5b94c5";
      }else if( informacion.respuesta == "VACIO" ){
          texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
          color = "#ddb11d";
      }else if( informacion.respuesta == "VACIO_H" ){
          texto = "<strong>Advertencia!</strong> Debe seleccionar las horas de trabajo.";
          color = "#ddb11d";
      }else if( informacion.respuesta == "VACIO_A" ){
          texto = "<strong>Advertencia!</strong> Debe marcar los dias de asistencia.";
          color = "#ddb11d";
      }else if( informacion.respuesta == "VACIO_ESP" ){
          texto = "<strong>Advertencia!</strong> Debe seleccionar una especialidad.";
          color = "#ddb11d";
      }

      $("#mensaje").html( texto ).css({"color": color});
      $("#mensaje").fadeOut(3000, function(){
          $(this).html("");
          $(this).fadeIn(1000);
      });     
    }
    var limpiar_datos = function(){
      $("#opcion").val("Registrar");
      $("#employee").val("");
      $("#especialidad").val("");
      $("#Luness").prop("checked",false);
      $("#Martes").prop("checked",false);
      $("#Mierco").prop("checked",false);
      $("#Jueves").prop("checked",false);
      $("#Vierne").prop("checked",false);
      $("#id").val("");
    }
var listar = function(){  
  var table = $("#example").DataTable({
    "destroy": false,
    "searching": true,
      "ajax": {
        "method":"POST",
        "url":"listae.php"
      },
      "columns": [
          { "data": "empleado" },
          { "data": "hora_inicio" },
          { "data": "hora_almuerzo" },
          { "data": "hora_retorno" },
          { "data": "hora_salida" },
          { "data": "jorem_dia" },
          { "className":'text-center',"defaultContent":'<button type="button" class="editar btn btn-primary" data-toggle="modal" data-target="#modalEditar">Editar <span><i class="fas fa-pencil-alt"></i></span></button>'
          },
          { "className":'text-center',"defaultContent":'<button type="button" class="eliminar btn btn-danger" data-toggle="modal" data-target="#modalEliminar">Eliminar <span><i class="fas fa-ban"></i></span></button>'
          },
          { "className":'text-center',"defaultContent":'<button type="button" class="estado btn btn-secondary" data-toggle="modal" data-target="#modalEstado">Habilitar / Deshabilitar </button>'
          },
     ],
     "columnDefs": [{
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('padding', '5px')
                } 
            }],
    "language": idioma_espanol
  } );
    obtener_data_editar("#example tbody", table);
    obtener_id_eliminar("#example tbody", table);
    obtener_id_cambiar("#example tbody", table);
}
    
    var obtener_data_editar = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row($(this).parents("tr")).data();
        var id=$("#frmeditartipo #id").val(data.jorem_id), 
        opcion=$("#frmeditartipo #opcion").val("editar");
        salida=$("#frmeditartipo #especialidad option[value='"+data.esp_id+"']").prop('selected', true),

        fal_d1=$("#frmeditartipo #Luness").prop('checked',false),
        fal_d2=$("#frmeditartipo #Martes").prop('checked',false),
        fal_d3=$("#frmeditartipo #Mierco").prop('checked',false),
        fal_d4=$("#frmeditartipo #Jueves").prop('checked',false),
        fal_d5=$("#frmeditartipo #Vierne").prop('checked',false),

        luness=$("#frmeditartipo #Luness",function(){ if((data.jorem_dia).indexOf('Lunes') >-1) { $("#frmeditartipo #Luness").prop('checked',true); }}),
        martes=$("#frmeditartipo #Martes",function(){ if((data.jorem_dia).indexOf('Martes') >-1) { $("#frmeditartipo #Martes").prop('checked',true); }}),
        mierco=$("#frmeditartipo #Mierco",function(){ if((data.jorem_dia).indexOf('Miercoles') >-1) { $("#frmeditartipo #Mierco").prop('checked',true); }}),
        jueves=$("#frmeditartipo #Jueves",function(){ if((data.jorem_dia).indexOf('Jueves') >-1) { $("#frmeditartipo #Jueves").prop('checked',true); }}),
        vierne=$("#frmeditartipo #Vierne",function(){ if((data.jorem_dia).indexOf('Viernes') >-1) { $("#frmeditartipo #Vierne").prop('checked',true); }}),
        nombre=$("#frmeditartipo #employee").val(data.empleado),

        hrentr=$("#frmeditartipo #hora_inicio option[value='"+data.jorem_horaentrada+"']").prop('selected', true),
        mnentr=$("#frmeditartipo #min_inicio option[value='"+data.jorem_minentrada+"']").prop('selected', true),
        hralmu=$("#frmeditartipo #hora_almuerzo option[value='"+data.jorem_horaalmuerzo+"']").prop('selected', true),
        mnalmu=$("#frmeditartipo #min_almuerzo option[value='"+data.jorem_minalmuerzo+"']").prop('selected', true),
        hrreto=$("#frmeditartipo #hora_retorno option[value='"+data.jorem_horaretorno+"']").prop('selected', true),
        mnreto=$("#frmeditartipo #min_retorno option[value='"+data.jorem_minretorno+"']").prop('selected', true),
        hrsali=$("#frmeditartipo #hora_salida option[value='"+data.jorem_horasalida+"']").prop('selected', true),
        mnsali=$("#frmeditartipo #min_salida option[value='"+data.jorem_minsalida+"']").prop('selected', true);
      });
    }
    var obtener_id_eliminar = function(tbody, table){
      $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var idusuario = $("#frmEliminarTipo #id").val( data.jorem_id );
      });
    }
    var obtener_id_cambiar = function(tbody, table){
      $(tbody).on("click", "button.estado", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var idusuario = $("#frmestadoTipo #id").val( data.jorem_id );
      });
    }

var idioma_espanol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
    </script> 
