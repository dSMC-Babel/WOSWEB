<?php
if(!isset($_POST['confirmacion'])){die();}
if($_POST['confirmacion']!="yes"){die();}
// Si llego a esta pagina con la variable de POST de confirmacion podremos cerrarlas.

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
                mysqli_close($conexion);
                return $res;
        }

 }


//Realizo una consulta para comprobar si hay wos activas que tienen passwords
$woactivas=mysqli_fetch_array(query("select count(*) as total from WORKORDERS where ESTADO='ACTIVO' and PASSWORDS='Si'"));
$numwoactivas=$woactivas['total'];
echo $numwoactivas;
if($numwoactivas==0){
//Ejecuto remotamente el script de close_pass.sh y espero un segundo.
	$salida=shell_exec("ssh admin_ubuntu@172.10.8.13 '/home/admin_ubuntu/scripts/close_pass.sh'");
	sleep(1);

//Ahora elimino el fichero que meustra las passwords abiertas.
	unlink("ma_opened.txt");

//Por ultimo vuelvo al index
	echo "<script>document.location.href='../index.php'</script>";
}
else{
	echo "<script>document.location.href='../index.php?err=errclose1'</script>";


}

?>
