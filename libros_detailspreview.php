<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/libros_variables.php");

if(!@$_SESSION["UserID"])
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}

$conn=db_connect(); 
$recordsCounter = 0;

//	process masterkey value
$mastertable=postvalue("mastertable");
if($mastertable!="")
{
	$_SESSION[$strTableName."_mastertable"]=$mastertable;
//	copy keys to session
	$i=1;
	while(isset($_REQUEST["masterkey".$i]))
	{
		$_SESSION[$strTableName."_masterkey".$i]=$_REQUEST["masterkey".$i];
		$i++;
	}
	if(isset($_SESSION[$strTableName."_masterkey".$i]))
		unset($_SESSION[$strTableName."_masterkey".$i]);
}
else
	$mastertable=$_SESSION[$strTableName."_mastertable"];

//$strSQL = $gstrSQL;

if($mastertable=="libros")
{
	$where ="";
		$where.= GetFullFieldName("num_reg")."=".make_db_value("num_reg",$_SESSION[$strTableName."_masterkey1"]);
}


$str = SecuritySQL("Search");
if(strlen($str))
	$where.=" and ".$str;
$strSQL = gSQLWhere($where);
//$strSQL = AddWhere($strSQL,$where);

$strSQL.=" ".$gstrOrderBy;

$rowcount=gSQLRowCount($where);


if ( $rowcount ) {
	$rs=db_query($strSQL,$conn);
	echo "Detalles encontrados".": <strong>".$rowcount."</strong>";
			echo ( $rowcount > 10 ) ? ". Displaying first: <strong>10</strong>.<br /><br />" : "<br /><br />";
	echo "<table cellpadding=1 cellspacing=1 border=0 align=left class=\"detailtable\"><tr>";
	echo "<td><strong>num_reg</strong></td>";
	echo "<td><strong>titulo</strong></td>";
	echo "<td><strong>autores</strong></td>";
	echo "<td><strong>editorial</strong></td>";
	echo "<td><strong>procedencia</strong></td>";
	echo "<td><strong>fec_publi</strong></td>";
	echo "<td><strong>edicion</strong></td>";
	echo "<td><strong>num_pag</strong></td>";
	echo "<td><strong>clasificacion</strong></td>";
	echo "<td><strong>tipo</strong></td>";
	echo "<td><strong>fec_ingreso</strong></td>";
	echo "<td><strong>observaciones</strong></td>";
	echo "</tr>";
	while ($data = db_fetch_array($rs)) {
		$recordsCounter++;
					if ( $recordsCounter > 10 ) { break; }
		echo "<tr>";
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode($data["num_reg"]));

	//	num_reg - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"num_reg", ""),"field=num%5Freg".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	titulo - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"titulo", ""),"field=titulo".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	autores - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"autores", ""),"field=autores".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	editorial - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"editorial", ""),"field=editorial".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	procedencia - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"procedencia", ""),"field=procedencia".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	fec_publi - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"fec_publi", ""),"field=fec%5Fpubli".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	edicion - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"edicion", ""),"field=edicion".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	num_pag - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"num_pag", ""),"field=num%5Fpag".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	clasificacion - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"clasificacion", ""),"field=clasificacion".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	tipo - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"tipo", ""),"field=tipo".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	fec_ingreso - Short Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"fec_ingreso", "Short Date"),"field=fec%5Fingreso".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	observaciones - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"observaciones", ""),"field=observaciones".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Detalles encontrados".": <strong>".$rowcount."</strong>";
}

echo "counterSeparator".postvalue("counter");
?>
