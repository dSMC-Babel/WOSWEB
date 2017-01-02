<html>


<head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../sweetalert-master/dist/sweetalert.css">

</head>
<script>
function abrirswal(){
        swal({
        title: "OK",
         text: "PASSWORD OPENED",
        type: "success",
        showCancelButton: true,
        confirmButtonColor: "#001a33",
        confirmButtonText: "OK, CLOSE WINDOW"

        },
        function(){
                window.close();
        });
}
</script>
<body>
<?php
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

$filescript = fopen("ma_script.txt", "a");
foreach ($maquinas as $m){
//recorro todas las maquinas

if(isset($_POST[$m])){
fwrite($filescript,$m.PHP_EOL);
}

}

fclose($filescript);



$file = fopen("ma_opened.txt", "a");
$filescript = fopen("ma_script.txt", "a");
foreach ($maquinas as $m){
//recorro todas las maquinas

if(isset($_POST[$m])){
fwrite($file,$m.PHP_EOL);
}

}
fclose($file);


sleep(1);
shell_exec("scp ma_script.txt admin_ubuntu@172.10.8.13:/home/admin_ubuntu/scripts/FILES_open_pass/ma_script.txt 2> salidaerror.txt");
sleep(2);
$salida=shell_exec("ssh admin_ubuntu@172.10.8.13 '/home/admin_ubuntu/scripts/open_pass.sh |grep -c \"OK\"'");

unlink("ma_script.txt");


if($salida==1){
	echo "<script>abrirswal(); </script>";
}






?>
