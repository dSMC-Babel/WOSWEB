<?php
//opcwo.php
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

           if (!mysqli_query($conexion,$sql)){
                   echo("Error description: " . mysqli_error($conexion));
           }
           mysqli_error($conexion);
           mysqli_close($conexion);
}
$wo=addslashes($_GET['wo']);
if($_GET['o']=='del'){
	//Funcion que elimina una WO y vuelve a la pagina principal
	query("delete from WORKORDERS where WO=".$wo);
	echo "<script>history.go(-1)</script>";
}
if($_GET['o']=='fin'){
	//funcion que finaliza una WO.
	query("update WORKORDERS set ESTADO='FINALIZADO' where WO=".$wo);
	echo "<script>history.go(-1)</script>";
}

?>
