 <table id="example" class="display table table-hover" width="100%">
    <thead class="thead-dark">
      <tr>
        <th>Empleado</th>
        <th>Entrada</th>
        <th>Almuerzo</th>
        <th>Retorno</th>
        <th>Salida</th>
        <th>Opcion</th>
      </tr>
    </thead>
<?php 
include '../../../func/conexion.php';
$results_busc=$mysqli->query("SELECT CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado, jorem.jorem_horaentrada, jorem.jorem_horaalmuerzo, jorem.jorem_horaretorno, jorem.jorem_horasalida FROM jornada_empleado jorem INNER JOIN empleado em ON em.em_id=jorem.jorem_id");
$temp="";

if (isset($_POST["busqueda"])) {
  switch ($_POST["busqueda"]) {
    case 'Matutino':
     $sql="SELECT em.em_id, CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado, jorem.jorem_horaentrada, jorem.jorem_horaalmuerzo, jorem.jorem_horaretorno, jorem.jorem_horasalida FROM jornada_empleado jorem INNER JOIN empleado em ON em.em_id=jorem.jorem_id WHERE jorem.jorem_horaentrada BETWEEN 08 and 12";
      break;
    case 'Vespertino':
     $sql="SELECT em.em_id,CONCAT(em.em_primernombre,' ',em.em_segundonombre,' ',em.em_primerapellido,' ',em.em_segundoapellido)empleado, jorem.jorem_horaentrada, jorem.jorem_horaalmuerzo, jorem.jorem_horaretorno, jorem.jorem_horasalida FROM jornada_empleado jorem INNER JOIN empleado em ON em.em_id=jorem.jorem_id WHERE jorem.jorem_horaentrada BETWEEN 12 and 18";
      break;
  }
    $results_busc = $mysqli->query($sql);
    if ($results_busc->num_rows > 0) {

      $temp = "<tbody>";
            while ($res_bus = $results_busc->fetch_assoc()) {
      $temp.= "<tr>";
      $temp.= "<td>".$res_bus['empleado']."</td>";
      $temp.= "<td>".$res_bus['jorem_horaentrada']."</td>";
      $temp.= "<td>".$res_bus['jorem_horaalmuerzo']."</td>";
      $temp.= "<td>".$res_bus['jorem_horaretorno']."</td>";
      $temp.= "<td>".$res_bus['jorem_horasalida']."</td>";
      $temp.= "<td><button type='button' class='btn btn-primary' id='pasar' name='pasar' onclick='mostrarespeci();' ><- Pasar</button></td>";
      $temp.= "</tr>";
            }
      $temp.= "</tbody>";
      $temp.= "</table>";
    } else {
      $temp.= "No se encontraron coincidencias con sus criterios de b&uacute;squeda";
    }
}
echo $temp;

?>
<script>
 
function mostrarespeci(){
    $("#example tr").on('button#pasar').click(function(){
         var toma1="",toma2="",toma3="",toma4="";
        toma1 += $(this).find("td:eq(0)").html();
        toma2 += $(this).find("td:eq(1)").html();
        $("#terapista").val(toma1);
        $("#id").val(toma2);
     });
};
</script> 