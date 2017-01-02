<html>
  <head>
    <title> WORKORDERS Web </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
    <script>
function confdel(wo){
// Funcion que muestra el aviso de confirmacion cuando se pulsa en eliminar una WO
swal({
  title: "Delete WO - Are you sure?",
  text: "You will not be able to recover this WORKORDER!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#001a33",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
},
function(){
 document.location.href='opcwo.php?o=del&wo='+wo;
  swal("Deleted!", "Your WORKORDER has been deleted.", "success");
});
}
function conffin(wo){
//  Funcion que muestra el aviso de confirmacion cuando se pulsa en finalizar una WO.
swal({
  title: "Are you sure?",
  text: "This WORKORDER is going to be finished",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#001a33",
  confirmButtonText: "Yes, finish it!",
  closeOnConfirm: false
},
function(){
 document.location.href='opcwo.php?o=fin&wo='+wo;
  swal("Deleted!", "Your WORKORDER has been finished.", "success");
});
}

function errorduplicado(){
//funcion que muestra el codigo de error cuando se intenta registrar una wo que ya existe.
        swal({
          title: "ERROR",
          text: "This WORKORDER already exists.",
          imageUrl: "cancelarwo.png"
        });
}
function errorcerrar(){
//funcion que muestra un error al cerrarlo porque hay workorders abiertas.
        swal({
          title: "ERROR",
          text: "There are 'ACTIVE' WORKORDERS with opened passwords.",
          imageUrl: "cancelarwo.png"
        });

}
function buscar(){
wo=document.getElementById('box-search').value;
$("#woinf").load("infwo.php?wo="+wo);

}
function compare_dates(fecha, fecha2)
   {

    var xMonth=fecha.substring(5,7);
    var xDay=fecha.substring(8,10);
    var xYear=fecha.substring(0,4);
        var xHour=fecha.substring(11,13);
        var xMin=fecha.substring(14,16);
    var yMonth=fecha2.substring(5, 7);
    var yDay=fecha2.substring(8, 10);
    var yYear=fecha2.substring(0,4);
        var yHour=fecha2.substring(11,13);
        var yMin=fecha2.substring(14,16);

     if (xYear> yYear)
     {
         return(true)
     }
     else
     {
       if (xYear == yYear)
       {
         if (xMonth> yMonth)
         {
             return(true)
         }
         else
         {
           if (xMonth == yMonth)
           {
             if (xDay> yDay)
               return(true);
             else
                           if (xDay == yDay)
                           {
                                if (xHour>yHour)
                                        {
                                                return true;
                                        }
                                        else
                                        {
                                                if (xHour == yHour)
                                                {
                                                        if (xMin > yMin)
                                                        {
                                                                return true;
                                                        }
                                                        else{
                                                                return false;
                                                        }
                                                }
                                                else
                                                {
                                                        return false;
                                                }
                                        }
                                }
                                else{
                                        return false;
                                }
                        }
           else
             return(false);
         }
       }
       else
         return(false);
     }
 }
function checkform(){
//Funcion que comprueba que los dataos del formulario son logicos antes de enviarlo.
        ventana_inicio=document.getElementById('VENTANA_INICIO').value;
        ventana_fin=document.getElementById('VENTANA_FIN').value;
        wo=document.getElementById('WO').value;
        resp=document.getElementById('RESPONSABLE').value;
        tel=document.getElementById('TELEFONO').value;
        if((ventana_inicio != "")&&(ventana_fin != "")&&(wo != "")&&(resp != "")&&(resp != "")&&(tel != ""))
        {
                if(compare_dates(ventana_fin,ventana_inicio))
                {
                        document.getElementById("formwo").submit();
                }
                else{
                        swal({
                          title: "ERROR",
                          text: "'Closing Date' is earlier than 'Start Date'",
                          imageUrl: "cancelarwo.png"
                        });

                }
        }
        else{
                swal({
                          title: "ERROR",
                          text: "Fields must not be empty",
                          imageUrl: "cancelarwo.png"
                    });

        }
}

function clickopenpass(){
//Funcion que abre la ventana de seleccionar maquinas
        window.open('php_passwords/formmachines.php','','resizable=no,width=450,height=500,left=300,top=100,toolbar=no,scrollbars=no');


}
function clickclosepass(){


        swal({
        title: "Are you sure?",
        text: "You will close all opened passwords.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#001a33",
        confirmButtonText: "Yes, close all passwords!",
        closeOnConfirm: false
        },
        function(){

                document.getElementById('formclose').submit();

        });


}
</script>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

<!-- Header -->
<header class="header">
  <div>  <h1>WORKORDER WEB</h1> </div>
</header>

<?php
if((isset($_GET['err']))&&($_GET['err']=='1062')){
echo "<script>errorduplicado()</script>";
}

if((isset($_GET['err']))&&($_GET['err']=='errclose1')){
echo "<script>errorcerrar()</script>";
}


?>

 <div class="main-box">

          <!-- Caja del formulario de registro de WO -->
          <div class='box-top1'>
          <h2>WO Register</h2><hr>
          <form name="formwo" id="formwo" method="post" action="insert_data.php">
                <table>
                    <tr><td>    <b>WO</b>            :</td><td><input type="number" id="WO" name="WO"></td></tr>
                    <tr><td>     <b>RESPONSABLE</b>   :</td><td><input type="Text" id="RESPONSABLE" name="RESPONSABLE"></td></tr>
                    <tr><td>    <b>TELEFONO</b>      :</td><td><input type="number" id="TELEFONO" name="TELEFONO"></td></tr>
                    <tr><td>    <b>PASSWORDS</b>     :</td><td><input type="checkbox" name="PASSWORDS"></td></tr>
                    <tr><td>    <b>AFECTACION</b>    :</td><td><input type="checkbox" name="AFECTACION"></td></tr>
                    <tr><td>    <b>CORREO_INICIO</b> :</td><td><input type="checkbox" name="CORREO_INICIO"></td></tr>
                    <tr><td>    <b>VENTANA_INICIO</b>    :</td><td><input type="datetime-local" id="VENTANA_INICIO" name="VENTANA_INICIO"></td></tr>
                    <tr><td>    <b>VENTANA_FIN</b>    :</td><td><input type="datetime-local" id="VENTANA_FIN" name="VENTANA_FIN"></td></tr>
                    <tr><td colspan="2">    <b>OBSERVACIONES</b> :<br/></td></tr><tr><td colspan="2"><textarea style='resize:none' name="OBSERVACIONES" cols="50" rows="10"></textarea><br>
                    <!-- Boton de Registrar WO -->
					<button class="button" style="vertical-align:middle" name="enviar" value="Registrar WO" onclick='checkform()'> <span>Registrar WO </span></button> 
					
                </table>

          </form>
          <!-- <form method="post" action="show_data.php">
          <input type="Submit" name"send" value="LISTADO WO">
          </form> -->
          </div>

          <!-- Caja central -->
          <div class='box-top2'>
                <div class='pass-opened' id='passopened' name='passopened'>

                </div>
		  <!-- Botones de Open Password y Close Password -->
                <div name='box-buttons' id='box-buttons' class='box-buttons'>
                        <button class="button_Open_Password" style="vertical-align:middle" name="enviar" value="Open passwords" onclick='clickopenpass()'> <span>Open Passwords </span></button> 
						<button class="button_Open_Password" style="vertical-align:middle" name="enviar" value="Close passwords" onclick='clickclosepass()'> <span>Close Passwords </span></button> 
						<form name='formclose' id='formclose' action='php_passwords/closepasswords.php' method='POST'>
                                <input type='hidden' name='confirmacion' id='confirmacion' value='yes'/>
                        </form>
                </div>
        </div>

          <!-- Caja de la busqueda de WO -->
          <div class='box-top3'>
                        <h2>WO Search</h2><hr>
                        <input id='box-search' name='box-search' type='text' placeholder="WO Identifier"/>
                        <button class="button_Search" style="vertical-align:middle" name="button-search" value="Search" onclick='buscar()'> <span>Search</span></button> 
						<!-- <input type='button' name='button-search' onclick='buscar()' value='Search'/> -->
                        <div class='woinformation' id='woinf' name='woinf'></div>
          </div>


          <div style='clear: both'></div> <!-- Se limpiea el float -->

          <!-- Caja WO Activas -->
          <div id="contenedorwoactivas" class="activewo-box">

            <h2>WO Activas</h2>
            <div id='woactivas'>
          </div>


    </div>
                <script>
                function refrescarTabla(){
                //Funcion que refresca la tabla.
                        $("#woactivas").load("woactivas.php");

                }
                function refrescarPassOpened(){
                        $("#passopened").load("php_passwords/viewpassopened.php");
                }
                $(document).ready(function(){
                                buscar();
                                refrescarPassOpened();
                                refrescarTabla();
                                // Cada 10 segundos se ejecutara la funcion refrescarTabla
                                var refreshId = setInterval(refrescarTabla, 60000);
                                var refreshOpenedPass = setInterval(refrescarPassOpened, 40000);
                });
                </script>
        </body>
</html>

