<div class="col-sm-offset-2 col-sm" style="background-color:white;padding: 10px;text-align: center;font-size: 15px;font-weight: bold">
<p id="mensaje"></p>
</div>
<br><br>
          <strong>Tabla de Usuarios</strong>

      <div class="card-body table-responsive">
        <table id="example" class="display table table-hover" width="100%">
          <thead class="thead-dark">
            <tr>
              <th>Id</th>
              <th>Nombre de Usuario</th>
              <th>Tipo de Usuario</th>
              <th>Estado</th>
              <th colspan="3"></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
  <!-- Modal Editar-->
  <div>
    <form id="frmeditartipo" action="" method="POST">
      <!-- Modal -->
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modalEliminarLabel">Editar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              <input type="hidden" id="opcion" name="opcion" value="editar">
              <input type="hidden" id="id" name="id" value="">
              <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de Usuario" required>
              </div>
              <div class="form-group">
                <label>Contraseña</label>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña" required>
              </div>
              <div class="form-group">
                <label>Tipo de Usuario</label>
              <select class="form-control" name="tpnombre" id="tpnombre" required>
                <option></option>
              <?php     require '../../../Conex/conexion.php'; $results = $mysqli->query("SELECT tp_id, tp_nombre FROM tipo_usuario"); while ($rows = $results->fetch_assoc()) {?>
              <option value="<?php echo $rows['tp_id'];?>"><?php echo $rows['tp_nombre']; ?></option>
              <?php } ?>
              </select>
              </div>
            </div>
            <div class="modal-footer">              
              <button type="submit" id="editaR" class="btn btn-primary" data-dismiss="modal">Editar Usuario</button>
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
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              ¿Está seguro de eliminar permanentemente el usuario?<strong data-name=""></strong>
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
              <h4 class="modal-title" id="modalEliminarLabel">Cambiar estado del Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              ¿Está seguro que desea cambiar el estado del usuario?<strong data-name=""></strong>
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
        $("#tpnombre").on('change', function () {            
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

  var editar = function(){
    $("#editaR").on("click", function(){
      var id=$("#frmeditartipo #id").val(),
      nombre=$("#frmeditartipo #nombre").val(),
        pass=$("#frmeditartipo #pass").val(),
     tpnombre=$("#frmeditartipo #tpnombre").val(),
      opcion=$("#frmeditartipo #opcion").val();
        $.ajax({
          method:"POST",
          url: "extra/ERegistrar.php",
          data: {"id": id, "nombre": nombre, "pass":pass, "tpnombre": tpnombre, "opcion": opcion}
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
    }else if( informacion.respuesta == "OPCION_VACIA" ){
        texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
        color = "#ddb11d";
    }

    $("#mensaje").html( texto ).css({"color": color});
    $("#mensaje").fadeOut(5000, function(){
        $(this).html("");
        $(this).fadeIn(2000);
    });     
  }
  var limpiar_datos = function(){
    $("#opcion").val("Registrar");
    $("#id").val("");
    $("#nombre").val("");
    $("#pass").val("");
    $("#tpnombre").val("");

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
          { "className": 'text-center',"targets": 0,"data": "idus" },
          { "targets": 1,"data": "usuario" },
          { "targets": 2,"data": "nombre" },
          { "targets": 3,"data": "estado" },
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
      var id=$("#frmeditartipo #id").val(data.idus), 
      nombre=$("#frmeditartipo #nombre").val(data.usuario),
     detalle=$("#frmeditartipo #tp_usuario").append(data.nombre),
      opcion=$("#frmeditartipo #opcion").val("editar");
    });
  }
  var obtener_id_eliminar = function(tbody, table){
    $(tbody).on("click", "button.eliminar", function(){
      var data = table.row( $(this).parents("tr") ).data();
      var idusuario = $("#frmEliminarTipo #id").val( data.idus );
    });
  }
  var obtener_id_cambiar = function(tbody, table){
    $(tbody).on("click", "button.estado", function(){
      var data = table.row( $(this).parents("tr") ).data();
      var idusuario = $("#frmestadoTipo #id").val( data.idus );
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
