<html>

<head>
<title>Abrir passwords</title>
</head>
<script src="../sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">
<script>
function checkform(){
//Script que comprueb las maquinas seleccionadas y manda un mensaje de confirmacion.
var maquinas = ["portalweb1",
"portalweb2",
"portalapi1",
"portalapi2",
"portalrv1",
"portalrv2",
"corecond1",
"corework1",
"corework2",
"corework3",
"coreserv1",
"coreserv2",
"coreserv3",
"corerec1",
"corerec2",
"corerec3",
"corerec4",
"corerec5",
"coremc1",
"coremc2"];
cadena="";
for(i=0;i<maquinas.length;i++){
if((document.getElementById(maquinas[i]).checked == true)&&(document.getElementById(maquinas[i]).disabled == false)){

	cadena=cadena+maquinas[i]+",";

}

}
cadena=cadena.substring(0,cadena.length-1);
	swal({
  	title: "Are you sure?",
  	text: "You will open this machines. ("+cadena+")",
  	type: "warning",
  	showCancelButton: true,
  	confirmButtonColor: "#DD6B55",
  	confirmButtonText: "Yes, open it those machines!",
  	closeOnConfirm: false
	},
	function(){
 		document.getElementById('formmachines').submit();	
  		
	});
}
function sendform(){
	alert('enviado');
}
</script>
<body>
<?php


//Declaro el array de maquinas
$maquinas=array(
"portalweb1",
"portalweb2",
"portalapi1",
"portalapi2",
"portalrv1",
"portalrv2",
"corecond1",
"corework1",
"corework2",
"corework3",
"coreserv1",
"coreserv2",
"coreserv3",
"corerec1",
"corerec2",
"corerec3",
"corerec4",
"corerec5",
"coremc1",
"coremc2");
echo "<h2>Machines</h2>";
echo "<hr/>";
echo "<form name='formmachines' id='formmachines' action='abrirpass.php' method='POST'>";

if(!file_exists('ma_opened.txt')){
//Si no existe el fichero temporal que indica que hay passowrds abiertas
	foreach ($maquinas as $m){

		echo "<input type='checkbox' name='".$m."' id='".$m."'/> ".$m."<br/>";
	}
}
else{
//Si existe el fichero compruebo maquina a maquina si se encuentra en dicho fichero.
	foreach ($maquinas as $m){
		$salida=shell_exec('cat ma_opened.txt|grep -c '.$m);
		if($salida!=0){
			echo "<input type='checkbox' checked='checked' id='".$m."' disabled '/> <span style='color:grey;font-weight:bold;'>".$m."</span><br/>";
		}
		else{
	                echo "<input type='checkbox' name='".$m."' id='".$m."'/> <span style='font-weight:bold;'>".$m."</span><br/>";
        	}
	}

}
echo "<input type='button' value='Open selected machines password' onclick='checkform()'>";
echo "</form>";












?>

</body>
</html>
