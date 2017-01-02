<html>
<body>

<span style='font-weight:bold;margin-top:10px;'>Passwords abiertas</span>
<hr/>
<ul>
<?php
//Pagina que muestra las passwords abiertas.
if(file_exists("ma_opened.txt")){
$file=fopen("ma_opened.txt","r");

while(!feof($file)) {
	$linea=fgets($file);
	if($linea!=""){
		echo "<li style='margin-left:20px;'>".$linea."</li>";
	}
}



fclose($file);
}
else{
echo "<span style='font-size:8pt;'>No hay passwords abiertas</span>";
}



?>
</ul>
</body></html>
