<?php
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
            echo("Error description: " . mysqli_error($conexion));
                        mysqli_close($conexion);
    }else{
                mysqli_error($conexion);
                mysqli_close($conexion);
                return $res;
        }

 }


$woactivas=query("SELECT * FROM WORKORDERS WHERE ESTADO='ACTIVO' order by VENTANA_FIN asc");

echo "<table name='tablawoact' border='1' style='width:100%;text-align:center;'";

echo "<tr><th>NUM WO</th> <th>RESPONSABLE</th> <th>TELEFONO</th> <th>PASSWORDS</th>  <th>AFECTACION</th> <th>CORREO_INICIO</th> <th>VENTANA INICIO</th> <th>VENTANA FIN</th> <th>OBSERVACIONES </th><th>FINALIZAR</th> <th>ELIMINAR</th></tr>";

while($fila=mysqli_fetch_array($woactivas)){
                echo "<tr>";
                echo "<td>".$fila['WO']."</td><td>".$fila['RESPONSABLE']."</td><td>".$fila['TELEFONO']."</td><td>".$fila['PASSWORDS']."</td><td>".$fila['AFECTACION']."</td><td>".$fila['CORREO_INICIO']."</td><td>".$fila['VENTANA_INICIO']."</td><td>".$fila['VENTANA_FIN']."</td><td>".$fila['OBSERVACIONES']."</td>";

                echo "<td><img src='finalizarwo.png' style='width:15px' class='boton' onclick=\"conffin(".$fila['WO'].")\"></td>";
                echo "<td> <img src='cancelarwo.png' style='width:15px' class='boton' onclick=\"confdel(".$fila['WO'].")\"> </td>";
                echo "</tr>";
}

echo "</table>";
?>

