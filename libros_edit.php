<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/libros_variables.php");


//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$filename="";	
$status="";
$message="";
$error_happened=false;
$readevalues=false;


$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
$inlineedit = (@$_REQUEST["editType"]=="inline") ? true : false;
$templatefile = ( $inlineedit ) ? "libros_inline_edit.htm" : "libros_edit.htm";

//connect database
$conn = db_connect();

//	Before Process event
if(function_exists("BeforeProcessEdit"))
	BeforeProcessEdit($conn);

$keys=array();
$keys["num_reg"]=postvalue("editid1");

//	prepare data for saving
if(@$_POST["a"]=="edited")
{
	$strWhereClause=KeyWhere($keys);
	$strSQL = "update ".AddTableWrappers($strOriginalTableName)." set ";
	$evalues=array();
	$efilename_values=array();
	$files_delete=array();
	$files_move=array();
//	processing num_reg - start
	if($inlineedit)
	{
	$value = postvalue("value_num_reg");
	$type=postvalue("type_num_reg");
	if (in_assoc_array("type_num_reg",$_POST) || in_assoc_array("value_num_reg",$_POST) || in_assoc_array("value_num_reg",$_FILES))	
	{
		$value=prepare_for_db("num_reg",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["num_reg"]=$value;
	}

//	update key value
	$keys["num_reg"]=$value;

//	processibng num_reg - end
	}
//	processing titulo - start
	if($inlineedit)
	{
	$value = postvalue("value_titulo");
	$type=postvalue("type_titulo");
	if (in_assoc_array("type_titulo",$_POST) || in_assoc_array("value_titulo",$_POST) || in_assoc_array("value_titulo",$_FILES))	
	{
		$value=prepare_for_db("titulo",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["titulo"]=$value;
	}


//	processibng titulo - end
	}
//	processing autores - start
	if($inlineedit)
	{
	$value = postvalue("value_autores");
	$type=postvalue("type_autores");
	if (in_assoc_array("type_autores",$_POST) || in_assoc_array("value_autores",$_POST) || in_assoc_array("value_autores",$_FILES))	
	{
		$value=prepare_for_db("autores",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["autores"]=$value;
	}


//	processibng autores - end
	}
//	processing editorial - start
	if($inlineedit)
	{
	$value = postvalue("value_editorial");
	$type=postvalue("type_editorial");
	if (in_assoc_array("type_editorial",$_POST) || in_assoc_array("value_editorial",$_POST) || in_assoc_array("value_editorial",$_FILES))	
	{
		$value=prepare_for_db("editorial",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["editorial"]=$value;
	}


//	processibng editorial - end
	}
//	processing procedencia - start
	if($inlineedit)
	{
	$value = postvalue("value_procedencia");
	$type=postvalue("type_procedencia");
	if (in_assoc_array("type_procedencia",$_POST) || in_assoc_array("value_procedencia",$_POST) || in_assoc_array("value_procedencia",$_FILES))	
	{
		$value=prepare_for_db("procedencia",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["procedencia"]=$value;
	}


//	processibng procedencia - end
	}
//	processing fec_publi - start
	if($inlineedit)
	{
	$value = postvalue("value_fec_publi");
	$type=postvalue("type_fec_publi");
	if (in_assoc_array("type_fec_publi",$_POST) || in_assoc_array("value_fec_publi",$_POST) || in_assoc_array("value_fec_publi",$_FILES))	
	{
		$value=prepare_for_db("fec_publi",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["fec_publi"]=$value;
	}


//	processibng fec_publi - end
	}
//	processing edicion - start
	if($inlineedit)
	{
	$value = postvalue("value_edicion");
	$type=postvalue("type_edicion");
	if (in_assoc_array("type_edicion",$_POST) || in_assoc_array("value_edicion",$_POST) || in_assoc_array("value_edicion",$_FILES))	
	{
		$value=prepare_for_db("edicion",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["edicion"]=$value;
	}


//	processibng edicion - end
	}
//	processing num_pag - start
	if($inlineedit)
	{
	$value = postvalue("value_num_pag");
	$type=postvalue("type_num_pag");
	if (in_assoc_array("type_num_pag",$_POST) || in_assoc_array("value_num_pag",$_POST) || in_assoc_array("value_num_pag",$_FILES))	
	{
		$value=prepare_for_db("num_pag",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["num_pag"]=$value;
	}


//	processibng num_pag - end
	}
//	processing clasificacion - start
	if($inlineedit)
	{
	$value = postvalue("value_clasificacion");
	$type=postvalue("type_clasificacion");
	if (in_assoc_array("type_clasificacion",$_POST) || in_assoc_array("value_clasificacion",$_POST) || in_assoc_array("value_clasificacion",$_FILES))	
	{
		$value=prepare_for_db("clasificacion",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["clasificacion"]=$value;
	}


//	processibng clasificacion - end
	}
//	processing tipo - start
	if($inlineedit)
	{
	$value = postvalue("value_tipo");
	$type=postvalue("type_tipo");
	if (in_assoc_array("type_tipo",$_POST) || in_assoc_array("value_tipo",$_POST) || in_assoc_array("value_tipo",$_FILES))	
	{
		$value=prepare_for_db("tipo",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["tipo"]=$value;
	}


//	processibng tipo - end
	}
//	processing fec_ingreso - start
	if($inlineedit)
	{
	$value = postvalue("value_fec_ingreso");
	$type=postvalue("type_fec_ingreso");
	if (in_assoc_array("type_fec_ingreso",$_POST) || in_assoc_array("value_fec_ingreso",$_POST) || in_assoc_array("value_fec_ingreso",$_FILES))	
	{
		$value=prepare_for_db("fec_ingreso",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["fec_ingreso"]=$value;
	}


//	processibng fec_ingreso - end
	}
//	processing observaciones - start
	if($inlineedit)
	{
	$value = postvalue("value_observaciones");
	$type=postvalue("type_observaciones");
	if (in_assoc_array("type_observaciones",$_POST) || in_assoc_array("value_observaciones",$_POST) || in_assoc_array("value_observaciones",$_FILES))	
	{
		$value=prepare_for_db("observaciones",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	
		$evalues["observaciones"]=$value;
	}


//	processibng observaciones - end
	}

	foreach($efilename_values as $ekey=>$value)
		$evalues[$ekey]=$value;
//	do event
	$retval=true;
	if(function_exists("BeforeEdit"))
		$retval=BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$message,$inlineedit);
	if($retval)
	{		
//	construct SQL string
		foreach($evalues as $ekey=>$value)
		{
			$strSQL.=AddFieldWrappers($ekey)."=".add_db_quotes($ekey,$value).", ";
		}
		if(substr($strSQL,-2)==", ")
			$strSQL=substr($strSQL,0,strlen($strSQL)-2);
		$strSQL.=" where ".$strWhereClause;
		set_error_handler("edit_error_handler");
		db_exec($strSQL,$conn);
		set_error_handler("error_handler");
		if(!$error_happened)
		{
//	delete & move files
			foreach ($files_delete as $file)
			{
				if(file_exists($file))
					@unlink($file);
			}
			foreach ($files_move as $file)
			{
				move_uploaded_file($file[0],$file[1]);
				if(strtoupper(substr(PHP_OS,0,3))!="WIN")
					@chmod($file[1],0777);
			}
			if ( $inlineedit ) 
			{
				$status="UPDATED";
				$message=""."Registro actualizado"."";
				$IsSaved = true;
			} 
			else 
				$message="<div class=message><<< "."Registro actualizado"." >>></div>";
//	after edit event
			if(function_exists("AfterEdit"))
				AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,$inlineedit);
		}
	}
	else
		$readevalues=true;
}

//	get current values and show edit controls

//$strSQL = $gstrSQL;

$strWhereClause=KeyWhere($keys);

$strSQL=gSQLWhere($strWhereClause);

$strSQLbak = $strSQL;
//	Before Query event
if(function_exists("BeforeQueryEdit"))
	BeforeQueryEdit($strSQL,$strWhereClause);

if($strSQLbak == $strSQL)
	$strSQL=gSQLWhere($strWhereClause);
LogInfo($strSQL);
$rs=db_query($strSQL,$conn);
$data=db_fetch_array($rs);

if($readevalues)
{
	$data["num_reg"]=$evalues["num_reg"];
	$data["titulo"]=$evalues["titulo"];
	$data["autores"]=$evalues["autores"];
	$data["editorial"]=$evalues["editorial"];
	$data["procedencia"]=$evalues["procedencia"];
	$data["fec_publi"]=$evalues["fec_publi"];
	$data["edicion"]=$evalues["edicion"];
	$data["num_pag"]=$evalues["num_pag"];
	$data["clasificacion"]=$evalues["clasificacion"];
	$data["tipo"]=$evalues["tipo"];
	$data["fec_ingreso"]=$evalues["fec_ingreso"];
	$data["observaciones"]=$evalues["observaciones"];
}

include('libs/Smarty.class.php');
$smarty = new Smarty();

if ( !$inlineedit ) {
	//	include files
	$includes="";

	//	validation stuff
	$bodyonload="";
	$onsubmit="";

	if($bodyonload)
	{
		$onsubmit="return validate();";
		$bodyonload="onload=\"".$bodyonload."\"";
	}

	if ($useAJAX) {
	$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
	$includes.="<script language=\"JavaScript\" src=\"include/ajaxsuggest.js\"></script>\r\n";
	}
	$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	$includes.="<script language=\"JavaScript\">\r\n".
	"var locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
	"var locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
	"var bLoading=false;\r\n".
	"var TEXT_PLEASE_SELECT='".addslashes("Por favor seleccione")."';\r\n";
	if ($useAJAX) {
	$includes.="var AUTOCOMPLETE_TABLE='libros_autocomplete.php';\r\n";
	$includes.="var SUGGEST_TABLE='libros_searchsuggest.php';\r\n";
	$includes.="var SUGGEST_LOOKUP_TABLE='libros_lookupsuggest.php';\r\n";
	}
	$includes.="</script>\r\n";
	if ($useAJAX)
		$includes.="<div id=\"search_suggest\"></div>\r\n";





	$smarty->assign("includes",$includes);
	$smarty->assign("bodyonload",$bodyonload);
	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".$onsubmit."\"";
	$smarty->assign("onsubmit",$onsubmit);
}

$smarty->assign("key1",htmlspecialchars($keys["num_reg"]));
$showKeys[] = rawurlencode($keys["num_reg"]);
	$smarty->assign("show_key1", htmlspecialchars(GetData($data,"num_reg", "")));

$smarty->assign("message",$message);

$readonlyfields=array();

$smarty->assign("value_num_reg",@$data["num_reg"]);
$smarty->assign("value_titulo",@$data["titulo"]);
$smarty->assign("value_autores",@$data["autores"]);
$smarty->assign("value_editorial",@$data["editorial"]);
$smarty->assign("value_procedencia",@$data["procedencia"]);
$smarty->assign("value_fec_publi",@$data["fec_publi"]);
$smarty->assign("value_edicion",@$data["edicion"]);
$smarty->assign("value_num_pag",@$data["num_pag"]);
$smarty->assign("value_clasificacion",@$data["clasificacion"]);
$smarty->assign("value_tipo",@$data["tipo"]);
$smarty->assign("value_fec_ingreso",@$data["fec_ingreso"]);
$smarty->assign("value_observaciones",@$data["observaciones"]);


$linkdata="";

if ($useAJAX) 
{
	$record_id= postvalue("recordID");

	if ( $inlineedit ) 
	{
		if(@$_REQUEST["browser"]=="ie")
			$smarty->assign("browserie",true);
		$smarty->assign("id",$record_id);

		$linkdata=str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$linkdata);


	} 
	else
	{
		$linkdata = "<script type=\"text/javascript\">\r\n".
		"$(document).ready(function(){ \r\n".
		$linkdata.
		"});</script>";
	}
	
} else {
}

$smarty->assign("linkdata",$linkdata);

if ($_REQUEST["a"]=="edited" && $inlineedit ) 
{
	if(!$data)
	{
		$data=$evalues;
		$HaveData=false;
	}
	//Preparation   view values

//	detail tables
	$masterquery="mastertable=libros";
	$masterquery.="&masterkey1=".rawurlencode($data["num_reg"]);
	$showDetailKeys["libros"]=$masterquery;

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode($data["num_reg"]));

	////////////////////////////////////////////
	//	num_reg - 
		$value="";
				$value = ProcessLargeText(GetData($data,"num_reg", ""),"","",MODE_LIST);
		$smarty->assign("show_num_reg",$value);
		$showValues[] = $value;
		$showFields[] = "num_reg";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	titulo - 
		$value="";
				$value = ProcessLargeText(GetData($data,"titulo", ""),"","",MODE_LIST);
		$smarty->assign("show_titulo",$value);
		$showValues[] = $value;
		$showFields[] = "titulo";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	autores - 
		$value="";
				$value = ProcessLargeText(GetData($data,"autores", ""),"","",MODE_LIST);
		$smarty->assign("show_autores",$value);
		$showValues[] = $value;
		$showFields[] = "autores";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	editorial - 
		$value="";
				$value = ProcessLargeText(GetData($data,"editorial", ""),"","",MODE_LIST);
		$smarty->assign("show_editorial",$value);
		$showValues[] = $value;
		$showFields[] = "editorial";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	procedencia - 
		$value="";
				$value = ProcessLargeText(GetData($data,"procedencia", ""),"","",MODE_LIST);
		$smarty->assign("show_procedencia",$value);
		$showValues[] = $value;
		$showFields[] = "procedencia";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	fec_publi - 
		$value="";
				$value = ProcessLargeText(GetData($data,"fec_publi", ""),"","",MODE_LIST);
		$smarty->assign("show_fec_publi",$value);
		$showValues[] = $value;
		$showFields[] = "fec_publi";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	edicion - 
		$value="";
				$value = ProcessLargeText(GetData($data,"edicion", ""),"","",MODE_LIST);
		$smarty->assign("show_edicion",$value);
		$showValues[] = $value;
		$showFields[] = "edicion";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	num_pag - 
		$value="";
				$value = ProcessLargeText(GetData($data,"num_pag", ""),"","",MODE_LIST);
		$smarty->assign("show_num_pag",$value);
		$showValues[] = $value;
		$showFields[] = "num_pag";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	clasificacion - 
		$value="";
				$value = ProcessLargeText(GetData($data,"clasificacion", ""),"","",MODE_LIST);
		$smarty->assign("show_clasificacion",$value);
		$showValues[] = $value;
		$showFields[] = "clasificacion";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	tipo - 
		$value="";
				$value = ProcessLargeText(GetData($data,"tipo", ""),"","",MODE_LIST);
		$smarty->assign("show_tipo",$value);
		$showValues[] = $value;
		$showFields[] = "tipo";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	fec_ingreso - Short Date
		$value="";
				$value = ProcessLargeText(GetData($data,"fec_ingreso", "Short Date"),"","",MODE_LIST);
		$smarty->assign("show_fec_ingreso",$value);
		$showValues[] = $value;
		$showFields[] = "fec_ingreso";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	observaciones - 
		$value="";
				$value = ProcessLargeText(GetData($data,"observaciones", ""),"","",MODE_LIST);
		$smarty->assign("show_observaciones",$value);
		$showValues[] = $value;
		$showFields[] = "observaciones";
				$showRawValues[] = "";
}

if ( $_REQUEST["a"]=="edited" && $inlineedit ) 
{
	echo "<textarea id=\"data\">";
	if($IsSaved)
	{
		if($HaveData)
			echo "saved";
		else
			echo "savnd";
		print_inline_array($showKeys);
		echo "\n";
		print_inline_array($showValues);
		echo "\n";
		print_inline_array($showFields);
		echo "\n";
		print_inline_array($showRawValues);
		echo "\n";
		print_inline_array($showDetailKeys,true);
		echo "\n";
		print_inline_array($showDetailKeys);
	}
	else
	{
		echo "error";
		echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),$message);
	}
	echo "</textarea>";
} 
else 
{
	if(function_exists("BeforeShowEdit"))
		BeforeShowEdit($smarty,$templatefile);
	$smarty->display($templatefile);
}

function edit_error_handler($errno, $errstr, $errfile, $errline)
{
	global $readevalues, $message, $status, $inlineedit, $error_happened;
	if ( $inlineedit ) 
		$message=""."El registro no ha sido editado".". ".$errstr;
	else  
		$message="<div class=message><<< "."El registro no ha sido editado"." >>><br><br>".$errstr."</div>";
	$readevalues=true;
	$error_happened=true;
}

?>