<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/libros_variables.php");

if(!@$_SESSION["UserID"])
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Export"))
{
	echo "<p>"."No tiene permiso para acceder a esta tabla"."<a href=\"login.php\">"."Regresar a la página de conexión"."</a></p>";
	return;
}


include('libs/Smarty.class.php');
$smarty = new Smarty();

$conn=db_connect();

//	Before Process event
if(function_exists("BeforeProcessPrint"))
	BeforeProcessPrint($conn);

$strWhereClause="";

if (@$_REQUEST["a"]!="") 
{
	
	$sWhere = "1=0";	
	
//	process selection
	$selected_recs=array();
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["num_reg"]=refine($_REQUEST["mdelete1"][$ind-1]);
			$selected_recs[]=$keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=split("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys=array();
			$keys["num_reg"]=urldecode($arr[0]);
			$selected_recs[]=$keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}
//	$strSQL = AddWhere($gstrSQL,$sWhere);
	$strSQL = gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strSQL = gSQLWhere($strWhereClause);
}



$strOrderBy=$_SESSION[$strTableName."_order"];
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;
$strSQL.=" ".trim($strOrderBy);

$strSQLbak = $strSQL;
if(function_exists("BeforeQueryPrint"))
	BeforeQueryPrint($strSQL,$strWhereClause,$strOrderBy);

//	Rebuild SQL if needed
if($strSQL!=$strSQLbak)
{
//	changed $strSQL - old style	
	$numrows=GetRowCount($strSQL);
}
else
{
	$strSQL = gSQLWhere($strWhereClause);
	$strSQL.=" ".trim($strOrderBy);
	$numrows=gSQLRowCount($strWhereClause);
}
LogInfo($strSQL);
	
$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize=$gPageSize;

$recno=1;
	
if($numrows)
{
	$maxRecords = $numrows;
	$maxpages=ceil($maxRecords/$PageSize);
	if($mypage > $maxpages)
		$mypage = $maxpages;
	if($mypage<1) 
		$mypage=1;
	$maxrecs=$PageSize;
	$strSQL.=" limit ".(($mypage-1)*$PageSize).",".$PageSize;
}
$rs=db_query($strSQL,$conn);

//	hide colunm headers if needed
$recordsonpage=$numrows-($mypage-1)*$PageSize;
if($recordsonpage>$PageSize)
	$recordsonpage=$PageSize;
	if($recordsonpage>=1)
		$smarty->assign("column1show",true);
	else
		$smarty->assign("column1show",false);



//	fill $rowinfo array
	$rowinfo = array();

	$data=db_fetch_array($rs);

	while($data && $recno<=$PageSize)
	{
		$row=array();
		for($col=1;$data && $recno<=$PageSize && $col<=1;$col++)
		{

			$recno++;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode($data["num_reg"]));


//	num_reg - 
			$value="";
				$value = ProcessLargeText(GetData($data,"num_reg", ""),"field=num%5Freg".$keylink,"",MODE_PRINT);
			$row[$col."num_reg_value"]=$value;

//	titulo - 
			$value="";
				$value = ProcessLargeText(GetData($data,"titulo", ""),"field=titulo".$keylink,"",MODE_PRINT);
			$row[$col."titulo_value"]=$value;

//	autores - 
			$value="";
				$value = ProcessLargeText(GetData($data,"autores", ""),"field=autores".$keylink,"",MODE_PRINT);
			$row[$col."autores_value"]=$value;

//	editorial - 
			$value="";
				$value = ProcessLargeText(GetData($data,"editorial", ""),"field=editorial".$keylink,"",MODE_PRINT);
			$row[$col."editorial_value"]=$value;

//	procedencia - 
			$value="";
				$value = ProcessLargeText(GetData($data,"procedencia", ""),"field=procedencia".$keylink,"",MODE_PRINT);
			$row[$col."procedencia_value"]=$value;

//	fec_publi - 
			$value="";
				$value = ProcessLargeText(GetData($data,"fec_publi", ""),"field=fec%5Fpubli".$keylink,"",MODE_PRINT);
			$row[$col."fec_publi_value"]=$value;

//	edicion - 
			$value="";
				$value = ProcessLargeText(GetData($data,"edicion", ""),"field=edicion".$keylink,"",MODE_PRINT);
			$row[$col."edicion_value"]=$value;

//	num_pag - 
			$value="";
				$value = ProcessLargeText(GetData($data,"num_pag", ""),"field=num%5Fpag".$keylink,"",MODE_PRINT);
			$row[$col."num_pag_value"]=$value;

//	clasificacion - 
			$value="";
				$value = ProcessLargeText(GetData($data,"clasificacion", ""),"field=clasificacion".$keylink,"",MODE_PRINT);
			$row[$col."clasificacion_value"]=$value;

//	tipo - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tipo", ""),"field=tipo".$keylink,"",MODE_PRINT);
			$row[$col."tipo_value"]=$value;

//	fec_ingreso - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"fec_ingreso", "Short Date"),"field=fec%5Fingreso".$keylink,"",MODE_PRINT);
			$row[$col."fec_ingreso_value"]=$value;

//	observaciones - 
			$value="";
				$value = ProcessLargeText(GetData($data,"observaciones", ""),"field=observaciones".$keylink,"",MODE_PRINT);
			$row[$col."observaciones_value"]=$value;
			$row[$col."show"]=true;
			$data=db_fetch_array($rs);
		}
		$rowinfo[]=$row;
	}
	$smarty->assign("rowinfo",$rowinfo);


	

$strSQL=$_SESSION[$strTableName."_sql"];

$templatefile = "libros_print.htm";
if(function_exists("BeforeShowPrint"))
	BeforeShowPrint($smarty,$templatefile);

$smarty->display($templatefile);

