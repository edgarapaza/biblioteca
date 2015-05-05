<?php
 include("include/dbconnection.php");
$conn=db_connect();
?>

<!--VERIFICAR Y GUARDAR EN LA BASE DE DATOS-->
<?php
$num_reg=strtoupper(trim($_POST['num_reg']));
$titulo=strtoupper(trim($_POST['titulo']));
$autor=strtoupper(trim($_POST['autor']));
$editorial=strtoupper(trim($_POST['editorial']));
$procedencia=strtoupper(trim($_POST['procedencia']));

$dia1=strtoupper(trim($_POST['dia1']));
$mes1=strtoupper(trim($_POST['mes1']));
$year1=strtoupper(trim($_POST['year1']));
//unimos las fechas antes de guardar
$fec_publi=strtoupper(trim($dia1."-".$mes1."-".$year1));

$edicion=strtoupper(trim($_POST['edicion']));
$num_pag=strtoupper(trim($_POST['num_pag']));
$clasificacion=strtoupper(trim($_POST['clasificacion']));
$tipo=strtoupper(trim($_POST['tipo']));

$dia2=strtoupper(trim($_POST['dia2']));
$mes2=strtoupper(trim($_POST['mes2']));
$year2=strtoupper(trim($_POST['year2']));
//unimos las fechas antes de guardar
$f_ingreso=$dia2."-".$mes2."-".$year2;

$obs=strtoupper(trim($_POST['obs']));
$fing_sis = date("Y-m-d H:i:s");


if(isset($_POST['Submit'])) {
//Comprueba si el campo NOMBRE está vacio
   if($titulo==""){
    $error.=  "- Campo Vacio: TITULO (Por favor, rellena esta casilla).<br />";
    }
    //Comprueba si el campo APELLIDOS está vacio
    if($autor==""){
      $error.=  "- Campo Vacio: AUTOR(es) (Por favor, rellena esta casilla).<br />";}
    // Comprueba si fecha de publicacion  esta vacio
    /*if($year1==""){
    $error.=  "- Campo Vacio: FECHA DE PUBLICACION, INCLUYA POR LO MENOS EL A&Ntilde;O(Por favor, rellena esta casilla).<br />";
    }*/
    //Comprueba si el campo APELLIDOS está vacio
    if($tipo==""){
      $error.=  "- Campo Vacio: TIPO (Por favor, rellena esta casilla).<br />";}
    //Comprueba si el campo APELLIDOS está vacio
    if($year2==""){
      $error.=  "- Campo Vacio: FECHA DE INGRESO, INCLUYA POR LO MENOS EL A&Ntilde;O (Por favor, rellena esta casilla).<br />";}
    
    //Si existe errores los escribe, de otra manera no muestra nada 
    if ($error==""){
       unset ($error);
	// aqui se GUARDA  en la base de datos
$sql="INSERT INTO `biblioteca`.`libros` VALUES ('$num_reg', '$titulo', '$autor', '$editorial', '$procedencia', '$fec_publi', '$edicion','$num_pag','$clasificacion', '$tipo', '$f_ingreso', '$obs', '$fing_sis')";	


	$query=mysql_query($sql,$conn);
	
	echo "<script type='text/javascript' language='JavaScript'>alert('Dato Ingresado');</script>";
    }
    else 
       {echo "<span class=\"rojo\"> $error </span><br /><br />";
	echo "<a href='javascript:window.history.go(-1);'>volver</a>";
       }
	
}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
	<title>Ingreso de Biblioteca</title>
<style type="text/css">
<!--
.Estilo4 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo5 {color: #660000}
-->
  </style>
<style type="text/css">
 .rojo{
 color:red;
 font-size:12;
}
</style>
</head>
<body>

<table width="100%" border="0" align="center">
  <tr>
    <th scope="col">Biblioteca, Ingreso de Datos</th>
  </tr>
</table>
<form action="" method="POST" name="biblioteca">
  <table width="70%" border="0" align="center">
  <tbody>
    <tr>
   	     <?php
		 		
				$sql="select count(*) from libros";
				$result=mysql_query($sql);
                while($fila=mysql_fetch_array($result)){
                $total=$fila[0];
				$num = $total +1;
                }
			
       	  ?>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599" width="20%">Numero de Registro </td>
      <td bordercolor="#FFFFFF"><input name="num_reg" type="hidden" id="num_reg" value="<?php echo $num;?>">
        <?php echo $num;?></td>
    </tr>
	  
    <tr>
      <td width="177" bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Titulo del Libro </span>*</td>
      <td  bordercolor="#FFFFFF"><input name="titulo" type="text" id="titulo" size="70" maxlength="255" style="text-transform:uppercase;">    </tr><tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Autor(es) </span> * </td>
      <td bordercolor="#FFFFFF"><input name="autor" type="text" id="autor" size="70" maxlength="255"  style="text-transform:uppercase;">      </tr>
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Editorial  </span></td>
      <td bordercolor="#FFFFFF"><input name="editorial" type="text" id="editorial" size="20"  style="text-transform:uppercase;"></td>
      </tr>
   
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Lugar de Procedencia </span></td>
      <td bordercolor="#FFFFFF"><input name="procedencia" type="text" id="procedencia" size="20"  style="text-transform:uppercase;"></td>
      </tr>
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Fecha de Publicacion </span>*</td>
      <td bordercolor="#FFFFFF"><table width="94" border="0">
        <tr>
          <th scope="col">Dia</th>
          <th scope="col">Mes</th>
          <th scope="col">A&ntilde;o</th>
        </tr>
        <tr>
          <td><input name="dia1" type="text" id="dia1" size="2" maxlength="2"></td>
          <td><select name="mes1" id="mes1">
            <option value="" selected="selected">Elige Mes</option>
            <option value="Enero">Enero</option>
            <option value="Febrero">Febrero</option>
            <option value="Marzo">Marzo</option>
            <option value="Abril">Abril</option>
            <option value="Mayo">Mayo</option>
            <option value="Junio">Junio</option>
            <option value="Julio">Julio</option>
            <option value="Agosto">Agosto</option>
            <option value="Setiembre">Setiembre</option>
            <option value="Octubre">Octubre</option>
            <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>
          </select></td>
          <td><input name="year1" type="text" id="year1" size="4" maxlength="4"></td>
        </tr>
      </table>
        </td>
      </tr>
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Edicion</span></td>
      <td bordercolor="#FFFFFF"><input name="edicion" type="text" id="edicion" style="text-transform:uppercase;" size="20" maxlength="60"  style="text-transform:uppercase;"></td>
      </tr>
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Numero de Paginas </span></td>
      <td bordercolor="#FFFFFF"><input name="num_pag" type="text" id="num_pag" style="text-transform:uppercase;" size="6" maxlength="6"  style="text-transform:uppercase;"> Solo Numeros
    </td>
      </tr>
	  <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Clasificacion</span></td>
      <td bordercolor="#FFFFFF"><input name="clasificacion" type="text" id="clasificacion" style="text-transform:uppercase;"  style="text-transform:uppercase;"></td>
      </tr>
	  <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Tipo</span>*</td>
      <td bordercolor="#FFFFFF">
	  	<select name="tipo">
			<option value="Donado" selected="selected">Donado</option>
			<option value="Comprado">Comprado</option>
		</select>	  </td>
      </tr>
	  <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Fecha de Ingreso </span>*</td>
      <td bordercolor="#FFFFFF">	
	<!-- dia de Nacimeinto -->
	<table width="94" border="0">
      <tr>
        <th scope="col">Dia</th>
        <th scope="col">Mes</th>
        <th scope="col">A&ntilde;o</th>
      </tr>
      <tr>
        <td><input name="dia2" type="text" id="dia2" size="2" maxlength="2"></td>
        <td><select name="mes2" id="mes2">
            <option value="" selected="selected">Elige Mes</option>
            <option value="Enero">Enero</option>
            <option value="Febrero">Febrero</option>
            <option value="Marzo">Marzo</option>
            <option value="Abril">Abril</option>
            <option value="Mayo">Mayo</option>
            <option value="Junio">Junio</option>
            <option value="Julio">Julio</option>
            <option value="Agosto">Agosto</option>
            <option value="Setiembre">Setiembre</option>
            <option value="Octubre">Octubre</option>
            <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>
        </select></td>
        <td><input name="year2" type="text" id="year2" size="4" maxlength="4"></td>
      </tr>
    </table></td>
      </tr>
	  <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599"><span class="Estilo4">Observaciones</span></td>
      <td bordercolor="#FFFFFF"><input name="obs" type="text" id="obs" style="text-transform:uppercase;" size="70" maxlength="255"></td>
      </tr>
	  
    <tr>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599">
        <div align="center">
          <input type="reset" name="reset" value="Reset">
          </div></td>
      <td bordercolor="#FFFFFF" bgcolor="#DDB599">
        <div align="center">
          <input type="submit" name="Submit" value="Agregar a la Biblioteca">
          </div></td>
<td bordercolor="#FFFFFF" bgcolor="#DDB599">
        <div align="center">
          <input type="button" name="button" onclick="javascript:window.location.href='libros_list.php'" value="Ver Lista de Libros">
          </div></td>
      </tr>
  </tbody>
</table>
  <p class="Estilo5">* Los campos marcados son Obligatorios </p>
</form>
</div>
</body>
</html>
