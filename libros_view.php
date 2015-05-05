<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/libros_variables.php");


//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$filename="";	
$message="";

//connect database
$conn = db_connect();

//	Before Process event
if(function_exists("BeforeProcessView"))
	BeforeProcessView($conn);


$keys=array();
$keys["num_reg"]=postvalue("editid1");

//	get current values and show edit controls

$strWhereClause = KeyWhere($keys);



$strSQL=gSQLWhere($strWhereClause);

$strSQLbak = $strSQL;
if(function_exists("BeforeQueryView"))
	BeforeQueryView($strSQL,$strWhereClause);
if($strSQLbak == $strSQL)
	$strSQL=gSQLWhere($strWhereClause);

LogInfo($strSQL);
$rs=db_query($strSQL,$conn);
$data=db_fetch_array($rs);


include('libs/Smarty.class.php');
$smarty = new Smarty();

	$smarty->assign("show_key1", htmlspecialchars(GetData($data,"num_reg", "")));

$keylink="";
$keylink.="&key1=".htmlspecialchars(rawurlencode($data["num_reg"]));

////////////////////////////////////////////
//	num_reg - 
	$value="";
		$value = ProcessLargeText(GetData($data,"num_reg", ""),"","",MODE_VIEW);
	$smarty->assign("show_num_reg",$value);
////////////////////////////////////////////
//	titulo - 
	$value="";
		$value = ProcessLargeText(GetData($data,"titulo", ""),"","",MODE_VIEW);
	$smarty->assign("show_titulo",$value);
////////////////////////////////////////////
//	autores - 
	$value="";
		$value = ProcessLargeText(GetData($data,"autores", ""),"","",MODE_VIEW);
	$smarty->assign("show_autores",$value);
////////////////////////////////////////////
//	editorial - 
	$value="";
		$value = ProcessLargeText(GetData($data,"editorial", ""),"","",MODE_VIEW);
	$smarty->assign("show_editorial",$value);
////////////////////////////////////////////
//	procedencia - 
	$value="";
		$value = ProcessLargeText(GetData($data,"procedencia", ""),"","",MODE_VIEW);
	$smarty->assign("show_procedencia",$value);
////////////////////////////////////////////
//	fec_publi - 
	$value="";
		$value = ProcessLargeText(GetData($data,"fec_publi", ""),"","",MODE_VIEW);
	$smarty->assign("show_fec_publi",$value);
////////////////////////////////////////////
//	edicion - 
	$value="";
		$value = ProcessLargeText(GetData($data,"edicion", ""),"","",MODE_VIEW);
	$smarty->assign("show_edicion",$value);
////////////////////////////////////////////
//	num_pag - 
	$value="";
		$value = ProcessLargeText(GetData($data,"num_pag", ""),"","",MODE_VIEW);
	$smarty->assign("show_num_pag",$value);
////////////////////////////////////////////
//	clasificacion - 
	$value="";
		$value = ProcessLargeText(GetData($data,"clasificacion", ""),"","",MODE_VIEW);
	$smarty->assign("show_clasificacion",$value);
////////////////////////////////////////////
//	tipo - 
	$value="";
		$value = ProcessLargeText(GetData($data,"tipo", ""),"","",MODE_VIEW);
	$smarty->assign("show_tipo",$value);
////////////////////////////////////////////
//	fec_ingreso - Short Date
	$value="";
		$value = ProcessLargeText(GetData($data,"fec_ingreso", "Short Date"),"","",MODE_VIEW);
	$smarty->assign("show_fec_ingreso",$value);
////////////////////////////////////////////
//	observaciones - 
	$value="";
		$value = ProcessLargeText(GetData($data,"observaciones", ""),"","",MODE_VIEW);
	$smarty->assign("show_observaciones",$value);

$templatefile = "libros_view.htm";
if(function_exists("BeforeShowView"))
	BeforeShowView($smarty,$templatefile,$data);

$smarty->display($templatefile);

?>