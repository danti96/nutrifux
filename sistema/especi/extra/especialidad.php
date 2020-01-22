<div class="col-sm-offset-2 col-sm" style="background-color:white;padding: 10px;text-align: center;font-size: 15px;font-weight: bold">
<p id="mensaje"></p>
</div>
<br><br>
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="col-sm btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <strong>Tabla de Especialidad</strong>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body table-responsive">
        <table id="example" class="display table table-hover" width="100%">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Especialidad</th>
              <th>Detalle</th> 
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="col-sm btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <strong>Tabla de Especialidad Asignados</strong>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body table-responsive">
        <table id="example2" class="display table table-hover" width="100%">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Empleado</th>
              <th>Especialidad</th> 
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
              <h4 class="modal-title" id="modalEliminarLabel">Editar Especialidad</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="opcion" name="opcion" value="editar">
              <input type="hidden" id="id" name="id" value="">
              <div class="form-group">
              <label>Especialidad </label>
            <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="Nombre de la Especialidad" required>
              </div>
              <div class="form-group">
              <label>Detalle </label>
            <textarea class="form-control" name="detalle" id="detalle" placeholder="Detalle de la Especialidad"></textarea>
              </div>
            </div>
            <div class="modal-footer">              
              <button type="submit" id="editaR" class="btn btn-primary" data-dismiss="modal">Editar Especialidad</button>
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
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Especialidad</h4>
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
   <!-- Modal Eliminar -->
  <div>
    <form id="frmEliminarTiposs" action="" method="POST">
      <input type="hidden" id="id" name="id" value="">
      <input type="hidden" id="opcion" name="opcion" value="eliminardos">
      <!-- Modal -->
      <div class="modal fade" id="modalEliminarAsig" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Especialidad Asignada</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              ¿Está seguro de eliminar permanentemente la especialidad Asignada?<strong data-name=""></strong>
            </div>
            <div class="modal-footer">
              <button type="button" id="eliminar-usuariodos" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
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
  listar2();
  listar();
  editar();
  eliminar();
  eliminardos();
}); 

    var editar = function(){
      $("#editaR").on("click", function(){
        var id=$("#frmeditartipo #id").val(),
        especialidad=$("#frmeditartipo #especialidad").val(),
       detalle=$("#frmeditartipo #detalle").val(),
        opcion=$("#frmeditartipo #opcion").val();
          $.ajax({
            method:"POST",
            url: "extra/ERegistrar.php",
            data: {"id": id, "especialidad": especialidad, "detalle": detalle, "opcion": opcion}
          }).done( function( info ){
            var json_info = JSON.parse( info );
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
    var eliminardos = function(){
      $("#eliminar-usuariodos").on("click", function(){
        var id=$("#frmEliminarTiposs #id").val(),
        opcion=$("#frmEliminarTiposs #opcion").val();
          $.ajax({
            method:"POST",
            url: "extra/ERegistrar.php",
            data: {"id": id, "opcion": opcion}
          }).done( function( info ){
            var json_info = JSON.parse( info );
            mostrar_mensaje( json_info );
            limpiar_datos();
           $('#example2').DataTable().ajax.reload();
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
      }else if( informacion.respuesta == "OPCION_VACIA" ){
          texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
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
      $("#especialidad").val("");
      $("#detalle").val("");
      $("#id").val("");
    }


    var listar = function(){  
      var table = $("#example").DataTable({
        "destroy": true,
        "searching": true,
          "ajax": {
            "method":"POST",
            "url":"listae.php"
          },
          "columns": [
              { "className": 'text-center',"targets": 0,"data": "esp_id" },
              { "targets": 1,"data": "esp_nombre" },
              { "targets": 2,"data": "esp_detalle" },
              { "className":'text-center',"defaultContent":'<button type="button" class="editar btn btn-primary" data-toggle="modal" data-target="#modalEditar">Editar <span><i class="fas fa-pencil-alt"></i></span></button>'
              },
              { "className":'text-center',"defaultContent":'<button type="button" class="eliminar btn btn-danger" data-toggle="modal" data-target="#modalEliminar">Eliminar <span><i class="fas fa-ban"></i></span></button>'
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
    }

    var obtener_data_editar = function(tbody, table){
      $(tbody).on("click", "button.editar", function(){
        var data = table.row($(this).parents("tr")).data();
        var id=$("#frmeditartipo #id").val(data.esp_id), 
        nombre=$("#frmeditartipo #especialidad").val(data.esp_nombre),
       detalle=$("#frmeditartipo #detalle").val(data.esp_detalle),
        opcion=$("#frmeditartipo #opcion").val("editar");
      });
    }
    var obtener_id_eliminar = function(tbody, table){
      $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var idusuario = $("#frmEliminarTipo #id").val( data.esp_id );
      });
    }

    var editar = function(){
      $("#editaR").on("click", function(){
        var id=$("#frmeditartipo #id").val(),
        especialidad=$("#frmeditartipo #especialidad").val(),
       detalle=$("#frmeditartipo #detalle").val(),
        opcion=$("#frmeditartipo #opcion").val();
          $.ajax({
            method:"POST",
            url: "extra/ERegistrar.php",
            data: {"id": id, "especialidad": especialidad, "detalle": detalle, "opcion": opcion}
          }).done( function( info ){
            var json_info = JSON.parse( info );
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
    var listar2 = function(){  
      var table = $("#example2").DataTable({
        "destroy": true,
        "searching": true,
          "ajax": {
            "method":"POST",
            "url":"listae2.php"
          },
          "columns": [
              { "className": 'text-center',"targets": 0,"data": "idempes" },
              { "targets": 1,"data": "nombre" },
              { "targets": 2,"data": "especinom" },
              { "className":'text-center',"defaultContent":'<button type="button" class="eliminaremsp btn btn-danger" data-toggle="modal" data-target="#modalEliminarAsig">Eliminar <span><i class="fas fa-ban"></i></span></button>'
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
      obtener_id_eliminar_2("#example2 tbody", table);
    }

    var obtener_id_eliminar_2 = function(tbody, table){
      $(tbody).on("click", "button.eliminaremsp", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var idusuario = $("#frmEliminarTiposs #id").val( data.idempes );
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
