<?php
    require '../../../func/conexion.php'; 
    session_start(); //Iniciar una nueva sesión o reanudar la existente
    
    if(!isset($_SESSION["us_id"])){ //En caso de no existir la sesión redireccionamos
        header("Location: ../terapista.php");
    }
    $id = $_SESSION['us_id'];
    $sql = "SELECT us_id, us_usuario FROM usuario WHERE us_id = '$id'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $resul_ide = $mysqli->query("SELECT iden_id, iden_nombre FROM identificacion");
    $resul_car = $mysqli->query("SELECT car_id, car_nombre FROM cargo");

?>
<div class="col-sm-offset-2 col-sm" style="background-color:white;padding: 10px;text-align: center;font-size: 15px;font-weight: bold">
<p id="mensaje"></p>
</div>
<br><br>
      <div class="card-body table-responsive">
        <table id="example" class="display table table-hover" width="100%">
        <thead class="thead-dark">
          <tr>
            <th>Foto</th>
            <th>Documento</th>
            <th>Dni</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fec. Nac.</th>
            <th>Genero</th>
            <th>Estado Civil</th>
            <th>Cargo</th>
            <th>Direccion</th>
            <th>Telf. Casa</th>
            <th>Telf. Movil</th>
            <th>Email</th>
            <th>Estado</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody></tbody>

        </table>
      </div>

 <!-- Modal Editar-->
  <div>
    <form id="frmeditartipo" enctype="multipart/form-data" method="POST">
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
              <input type="hidden" id="idus" name="idus" value="<?php echo "".utf8_decode($row['us_id']);?>">
              <input type="hidden" id="id" name="id" value="">
              <div class="form-group">
                <div class="row">
                  <label class="col-sm">Tipo de documentacion </label>
                  <div class="col-sm">
                     <select class="form-control" name="identification" id="identification" onChange="mostrar(this.value);">
                        <option value="Nah"></option>
                      <?php  while ($row_ide = $resul_ide->fetch_assoc()) { ?>
                        <option value="<?php echo $row_ide['iden_id'];?>"><?php echo $row_ide['iden_nombre']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-6" id="txt_dni">
                    <input type="text" class=" form-control" placeholder="Identificacion" id="dni" name="dni" >
                  </div>
                </div>
              </div>    
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Apellido Paterno </label>
                  <div class="col-sm-10">
                    <input type="text" name="apellidopa" id="apellidopa" class="form-control" placeholder="Apellido Paterno" onkeypress="return soloLetras(event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Apellido Materno  </label>
                    <div class="col-sm-10">
                    <input type="text" name="apellidoma" id="apellidoma" class="form-control" placeholder="Apellido Materno" onkeypress="return soloLetras(event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Primer Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" name="nombre_one" id="nombre_one" class="form-control" placeholder="Primer Nombre" onkeypress="return soloLetras(event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2"> Segundo Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" name="nombre_two" id="nombre_two" class="form-control" placeholder="Segundo Nombre" onkeypress="return soloLetras(event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Fecha Nacimiento  </label>
                    <div class="col-sm-10">
                    <input type="date" name="fechana" id="fechana" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Genero  </label>
                  <div class="col-sm-10">
                    <select class="form-control" name="genero" id="genero">
                      <option></option>
                      <option value="Hombre">Hombre</option>
                      <option value="Mujer">Mujer</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Estado Civil  </label>
                  <div class="col-sm-10">
                    <select  class="form-control" name="estadocivil" id="estadocivil"required>
                      <option value=""></option>
                      <option value="Soltero/a">Soltero/a</option>
                      <option value="Casado/a">Casado/a</option>
                      <option value="Union Libre o Union de Hecho">Union Libre o Union de Hecho</option>
                      <option value="Divorsiado/a">Divorsiado/a</option>
                      <option value="Viudo/a">Viudo/a</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-2">Cargo </label>
                  <div class="col-sm-10">
                    <select class="form-control" name="cargo" id="cargo">
                      <option></option>
                    <?php while ($row1 = $resul_car->fetch_assoc()) {?>
                      <option value="<?php echo $row1['car_id'];?>"><?php echo $row1['car_nombre']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Direccion </label>
                    <div class="col-sm-10">
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Telefono Convencional </label>
                  <div class="col-sm-10">
                    <input type="text" name="tlfijo" id="tlfijo" class="form-control" placeholder="(04) 999 - 9999" onkeypress="return SoloNumeros(event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Telefono Movil </label>
                  <div class="col-sm-10">
                    <input type="text" name="tlfmovil" id="tlfmovil" class="form-control" placeholder="099 999 9999" onkeypress="return SoloNumeros(event)">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">E-Mail  </label>
                    <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com">
                  </div>
                </div>
              </div>   
              <div class="form-group">
                <div class="row">
                    <label class="col-sm-2">Foto <br> <strong style="color: red">Max 5Mb</strong></label>
                  <div class="col-sm-10">
                  <input type="file" name="file" id="file"  accept="image/jpeg"/>
                  <div class="col-sm" style="display: block;">
                      <div id="image_preview"><img id="previewing" src="" /></div>
                      <div id="message"></div>
                  </div>
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
              <h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              ¿Está seguro de eliminar permanentemente el tipo de usuario?<strong data-name=""></strong>
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
              <h4 class="modal-title" id="modalEliminarLabel">Cambiar estado del tipo Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">              
              ¿Está seguro que desea cambiar el estado del tipo de usuario?<strong data-name=""></strong>
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
$(document).ready(function(e) {
    // Function to preview image after validation
    $(function() {
        $("#file").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('#previewing').attr('src','noimage.png');
                    $("#message").html("<p id='error'>Por favor seleccionar una formato de imagen jpeg, jpg y png, Tipo de imagen permitido.</span>");
                    return false;
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        function imageIsLoaded(e) {
            $("#file").css("color","green");
            $("#file").css("font-size","14px");

            $('#image_preview').css("display", "block");
            $('#image_preview').css("text-align", "center");

            $('#previewing').attr('src', e.target.result);
            $('#previewing').attr('width', '300px');
            $('#previewing').attr('height', '200px');
            $('#previewing').css("border", "2px solid");

        };
  listar();
  editar();
  eliminar();
  cambiar();

}); 

    var editar = function(){
      $("#editaR").on("click", function(){
          var formData = new FormData($('#frmeditartipo')[0]);
          $.ajax({
            type:"POST",
            url: "extra/ERegistrar.php",
            data: formData,
            cache:false,
            processData:false,
            contentType:false,
          }).done( function( info ){
              console.log( info );
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
          $(this).fadeIn(3000);
      });     
    }
    var limpiar_datos = function(){
      $("#opcion").val("Registrar");
        $("#frmeditartipo #id").val();
        $("#frmeditartipo #apellidopa").val();
        $("#frmeditartipo #apellidoma").val();

        $("#frmeditartipo #nombre_one").val();
        $("#frmeditartipo #nombre_two").val();

        $("#frmeditartipo #fechana").val();
        $("#frmeditartipo #genero").val();
        $("#frmeditartipo #estadocivil").val();
        $("#frmeditartipo #cargo").val();

        $("#frmeditartipo #direccion").val();
        $("#frmeditartipo #tlfijo").val();
        $("#frmeditartipo #tlfmovil").val();
        $("#frmeditartipo #email").val();

        $("#frmeditartipo #image_preview").val();
        $("#frmeditartipo #identification").val();
        $("#frmeditartipo #dni").val();
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
              {"data": 'em_foto',
                "render": function (data, type, row, meta) {
                    return '<img src="data:image/jpeg; base64,' + data + '" width="100px" height="100px">';
                }
              },
              {"data": "documento" },
              {"data": "em_dni" },
              {"data": "nombre" },
              {"data": "apellido" },
              {"data": "em_fechanaci" },
              {"data": "em_genero" },
              {"data": "em_estadocivil" },

              {"data": "cargo" },
              {"data": "em_direccion" },
              {"data": "em_tlfcasa" },
              {"data": "em_tlfmovil" },
              {"data": "em_correo" },
              {"data": "estado" },
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
                    }, 
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
        var id=$("#frmeditartipo #id").val(data.em_id), 
        opcion=$("#frmeditartipo #opcion").val("editar"),

        apellidopa=$("#frmeditartipo #apellidopa").val(data.em_primerapellido),
        apellidoma=$("#frmeditartipo #apellidoma").val(data.em_segundoapellido),

        nombre_one=$("#frmeditartipo #nombre_one").val(data.em_primernombre),
        nombre_two=$("#frmeditartipo #nombre_two").val(data.em_segundonombre),

        fechana=$("#frmeditartipo #fechana").val(data.em_fechanaci),
        genero=$("#frmeditartipo #genero option[value='"+data.em_genero+"']").attr('selected', true),
        estadocivil=$("#frmeditartipo #estadocivil option[value='"+data.em_estadocivil+"']").attr('selected', true),
        cargo=$("#frmeditartipo #cargo option[value='"+data.car_id+"']").attr('selected', true),

        direccion=$("#frmeditartipo #direccion").val(data.em_direccion),
        tlffijo=$("#frmeditartipo #tlfijo").val(data.em_tlfcasa),
        tlfmovil=$("#frmeditartipo #tlfmovil").val(data.em_tlfmovil),
        email=$("#frmeditartipo #email").val(data.em_correo),

        foto=$("#frmeditartipo #image_preview").html('<img id="previewing" src="data:image/jpeg; base64,' + data.em_foto + '" width="100px" height="100px">'),
        inden=$("#frmeditartipo #identification option[value='"+data.iden_id+"']").attr('selected', true),
        dni=$("#frmeditartipo #dni").val(data.em_dni);
        asd=$("#frmeditartipo #file").val("");

      });
    }
    var obtener_id_eliminar = function(tbody, table){
      $(tbody).on("click", "button.eliminar", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var idusuario = $("#frmEliminarTipo #id").val( data.em_id );
      });
    }
    var obtener_id_cambiar = function(tbody, table){
      $(tbody).on("click", "button.estado", function(){
        var data = table.row( $(this).parents("tr") ).data();
        var idusuario = $("#frmestadoTipo #id").val( data.em_id );
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
