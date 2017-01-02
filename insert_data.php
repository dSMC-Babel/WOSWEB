<?php
        // Create connection
                function connectdb(){
			//Esta funcion devuelve una conexion con la base de datos.
                         $servername = "localhost";
                        $username = "root";
                        $password = "babelsi";
                        $dbname = "WOSWEB";

                        $conn=mysqli_connect($servername, $username, $password, $dbname);
                        return $conn;
                }
                function query($sql){
			//Funcion que ejecuta una consulta pasada como parametro o devuelve un error
                        $conexion=connectdb();

                        if (!mysqli_query($conexion,$sql)){
				$errnum=mysqli_errno($conexion);
                                echo("Error description: " .$errnum."-".mysqli_error($conexion));
				 mysqli_close($conexion);
				echo "<script>document.location.href='index.php?err=".$errnum."'</script>";
                        }else{
			
                	        mysqli_close($conexion);
				echo "<script>document.location.href='index.php'</script>";
			}
		}

                $wo=addslashes($_POST['WO']);
                $resp=addslashes($_POST['RESPONSABLE']);
                $tel=addslashes($_POST['TELEFONO']);
                if($_POST['PASSWORDS']==true){
                        $pass="Si";
                }else{
                        $pass="No";
                }
		 if($_POST['AFECTACION']==true){
                        $afectacion="Si";
                }else{
                        $afectacion="No";
                }

                if($_POST['CORREO_INICIO']==true){
                        $correo_inicio="Si";
                }else{
                        $correo_inicio="No";
                }

		$ventana_inicio=addslashes(str_replace('T',' ',$_POST['VENTANA_INICIO']));
		$ventana_fin=addslashes(str_replace('T',' ',$_POST['VENTANA_FIN']));
                //if($_POST['CORREO_FIN']==true){
                //        $correo_fin="Si";
                //}else{
                //        $correo_fin="No";
                //}

                $observaciones=addslashes($_POST['OBSERVACIONES']);

//              echo $wo."<br>";
//              echo $resp."<br>";
//              echo $tel."<br>";
//              echo $pass."<br>";
//              echo $afectacion."<br>";
//              echo $correo_inicio."<br>";
//              echo $correo_fin."<br>";
//              echo $observaciones."<br>";

        $sql = "INSERT INTO WORKORDERS (WO, RESPONSABLE, TELEFONO, PASSWORDS, AFECTACION, CORREO_INICIO,VENTANA_INICIO,VENTANA_FIN, OBSERVACIONES, ESTADO) VALUES (".$wo.", '".$resp."', '".$tel."', '".$pass."', '".$afectacion."', '".$correo_inicio."', '".$ventana_inicio."','".$ventana_fin."', '".$observaciones."','ACTIVO')";
//              echo $sql;
       		
//Ejecuto la funcion QUERY definida al principio
		query($sql);
	
?>
