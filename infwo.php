<?php
if(!isset($_GET['wo'])){die();}

$wo=addslashes($_GET['wo']);

function connectdb(){
         $servername = "localhost";
        $username = "root";
        $password = "babelsi";
        $dbname = "WOSWEB";

        $conn=mysqli_connect($servername, $username, $password, $dbname);
        return $conn;
                }
function query($sql){
    $conexion=connectdb();

    if (!$res=mysqli_query($conexion,$sql)){
            //echo("Error description: " . mysqli_error($conexion));
                        mysqli_close($conexion);
    }else{
                mysqli_error($conexion);
                mysqli_close($conexion);
                return $res;
        }

}


//Convierto en array el resultado de la consulta
$cuantos=mysqli_fetch_array(query("select count(*) as total from WORKORDERS where wo=".$wo));
$woquery=query("select * from WORKORDERS where wo=".$wo);

$worow=mysqli_fetch_array($woquery);

echo "<table name='tablewo'>";
echo "<tr><td style='font-weight:bold'>WO</td><td> ".$worow['WO']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Responsable</td><td> ".$worow['RESPONSABLE']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Telefono</td><td> ".$worow['TELEFONO']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Ventana Inicio</td><td> ".$worow['VENTANA_INICIO']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Ventana Fin</td><td> ".$worow['VENTANA_FIN']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Afectación</td><td> ".$worow['AFECTACION']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Password</td><td> ".$worow['PASSWORDS']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Correo inicio</td><td> ".$worow['CORREO_INICIO']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Estado</td><td> ".$worow['ESTADO']." </td></tr>";
echo "<tr><td style='font-weight:bold'>Observaciones</td><td> ".$worow['OBSERVACIONES']." </td></tr>";
echo "</table>";

if(($cuantos['total']==0)&&($_GET['wo']!="")){
	echo "<span style='color:red'>No se ha encontrado la wo</span>";

}





?>
