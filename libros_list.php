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
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{
	echo "<p>"."No tiene permiso para acceder a esta tabla"." <a href=\"login.php\">"."Regresar a la p�gina de conexi�n"."</a></p>";
	return;
}


include('libs/Smarty.class.php');
$smarty = new Smarty();



$conn=db_connect();


//	process reqest data, fill session variables

if(!count($_POST) && !count($_GET))
{
	$sess_unset = array();
	foreach($_SESSION as $key=>$value)
		if(substr($key,0,strlen($strTableName)+1)==$strTableName."_" &&
			strpos(substr($key,strlen($strTableName)+1),"_")===false)
			$sess_unset[] = $key;
	foreach($sess_unset as $key)
		unset($_SESSION[$key]);
}

//	Before Process event
if(function_exists("BeforeProcessList"))
	BeforeProcessList($conn);

if(@$_REQUEST["a"]=="showall")
	$_SESSION[$strTableName."_search"]=0;
else if(@$_REQUEST["a"]=="search")
{
	$_SESSION[$strTableName."_searchfield"]=postvalue("SearchField");
	$_SESSION[$strTableName."_searchoption"]=postvalue("SearchOption");
	$_SESSION[$strTableName."_searchfor"]=postvalue("SearchFor");
	if(postvalue("SearchFor")!="" || postvalue("SearchOption")=='Empty')
		$_SESSION[$strTableName."_search"]=1;
	else
		$_SESSION[$strTableName."_search"]=0;
	$_SESSION[$strTableName."_pagenumber"]=1;
}
else if(@$_REQUEST["a"]=="advsearch")
{
	$_SESSION[$strTableName."_asearchnot"]=array();
	$_SESSION[$strTableName."_asearchopt"]=array();
	$_SESSION[$strTableName."_asearchfor"]=array();
	$_SESSION[$strTableName."_asearchfor2"]=array();
	$tosearch=0;
	$asearchfield = postvalue("asearchfield");
	$_SESSION[$strTableName."_asearchtype"] = postvalue("type");
	if(!$_SESSION[$strTableName."_asearchtype"])
		$_SESSION[$strTableName."_asearchtype"]="and";
	foreach($asearchfield as $field)
	{
		$gfield=GoodFieldName($field);
		$asopt=postvalue("asearchopt_".$gfield);
		$value1=postvalue("value_".$gfield);
		$type=postvalue("type_".$gfield);
		$value2=postvalue("value1_".$gfield);
		$not=postvalue("not_".$gfield);
		if($value1 || $asopt=='Empty')
		{
			$tosearch=1;
			$_SESSION[$strTableName."_asearchopt"][$field]=$asopt;
			if(!is_array($value1))
				$_SESSION[$strTableName."_asearchfor"][$field]=$value1;
			else
				$_SESSION[$strTableName."_asearchfor"][$field]=combinevalues($value1);
			$_SESSION[$strTableName."_asearchfortype"][$field]=$type;
			if($value2)
				$_SESSION[$strTableName."_asearchfor2"][$field]=$value2;
			$_SESSION[$strTableName."_asearchnot"][$field]=($not=="on");
		}
	}
	if($tosearch)
		$_SESSION[$strTableName."_search"]=2;
	else
		$_SESSION[$strTableName."_search"]=0;
	$_SESSION[$strTableName."_pagenumber"]=1;
}

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
//	reset search and page number
	$_SESSION[$strTableName."_search"]=0;
	$_SESSION[$strTableName."_pagenumber"]=1;
}
else
	$mastertable=$_SESSION[$strTableName."_mastertable"];

$smarty->assign("mastertable",$mastertable);
$smarty->assign("mastertable_short",GetTableURL($mastertable));


if(@$_REQUEST["orderby"])
	$_SESSION[$strTableName."_orderby"]=@$_REQUEST["orderby"];

if(@$_REQUEST["pagesize"])
{
	$_SESSION[$strTableName."_pagesize"]=@$_REQUEST["pagesize"];
	$_SESSION[$strTableName."_pagenumber"]=1;
}

if(@$_REQUEST["goto"])
	$_SESSION[$strTableName."_pagenumber"]=@$_REQUEST["goto"];


//	process reqest data - end

$includes="";

if ($useAJAX) {
	$includes.="<script type=\"text/javascript\" src=\"include/jquery.js\"></script>\r\n";
	$includes.="<script type=\"text/javascript\" src=\"include/ajaxsuggest.js\"></script>\r\n";
//	validation stuff
	$editValidateTypes = array();
	$editValidateFields = array();
	$addValidateTypes = array();
	$addValidateFields = array();

	$includes.="<script type=\"text/javascript\" src=\"include/inlineedit.js\"></script>\r\n";
										$validatetype="IsNumeric";
					$validatetype.="IsRequired";
			$editValidateTypes[] = $validatetype;
			$editValidateFields[] = "num_reg";
			$editValidateTypes[] = "";
		$editValidateFields[] = "titulo";
			$editValidateTypes[] = "";
		$editValidateFields[] = "autores";
			$editValidateTypes[] = "";
		$editValidateFields[] = "editorial";
			$editValidateTypes[] = "";
		$editValidateFields[] = "procedencia";
			$editValidateTypes[] = "";
		$editValidateFields[] = "fec_publi";
			$editValidateTypes[] = "";
		$editValidateFields[] = "edicion";
										$validatetype="IsNumeric";
					$editValidateTypes[] = $validatetype;
			$editValidateFields[] = "num_pag";
			$editValidateTypes[] = $validatetype;
		$editValidateFields[] = "clasificacion";
			$editValidateTypes[] = "";
		$editValidateFields[] = "tipo";
						$validatetype="";
					$validatetype.="IsRequired";
			$editValidateTypes[] = $validatetype;
			$editValidateFields[] = "fec_ingreso";
			$editValidateTypes[] = "";
		$editValidateFields[] = "observaciones";
	
			$addValidateTypes[] = "";
		$addValidateFields[] = "titulo";
			$addValidateTypes[] = "";
		$addValidateFields[] = "autores";
			$addValidateTypes[] = "";
		$addValidateFields[] = "editorial";
			$addValidateTypes[] = "";
		$addValidateFields[] = "procedencia";
			$addValidateTypes[] = "";
		$addValidateFields[] = "fec_publi";
			$addValidateTypes[] = "";
		$addValidateFields[] = "edicion";
										$validatetype="IsNumeric";
					$addValidateTypes[] = "";
			$addValidateFields[] = "num_pag";
			$addValidateTypes[] = $validatetype;
		$addValidateFields[] = "clasificacion";
			$addValidateTypes[] = "";
		$addValidateFields[] = "tipo";
						$validatetype="";
					$validatetype.="IsRequired";
			$addValidateTypes[] = $validatetype;
			$addValidateFields[] = "fec_ingreso";
			$addValidateTypes[] = "";
		$addValidateFields[] = "observaciones";


		$includes.="<script type=\"text/javascript\">\r\n";
	$includes.="var TEXT_INLINE_FIELD_REQUIRED='".jsreplace("Campo requerido")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_ZIPCODE='".jsreplace("El campo debe ser un c�digo postal v�lido")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_EMAIL='".jsreplace("El campo debe ser una direcci�n de email v�lida")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_NUMBER='".jsreplace("El campo debe ser num�rico")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_CURRENCY='".jsreplace("El campo debe ser un n�mero v�lido de moneda")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_PHONE='".jsreplace("El campo debe ser un n�mero de tel�fono v�lido")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_PASSWORD1='".jsreplace("El campo no puede ser la contrase�a")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_PASSWORD2='".jsreplace("El campo puede contener 4 car�cteres como m�ximo")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_STATE='".jsreplace("El campo debe ser un estado v�lido")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_SSN='".jsreplace("El campo debe ser un n�mero de Seguridad  Social v�lido")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_DATE='".jsreplace("El campo debe ser una fecha v�lida")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_TIME='".jsreplace("El campo debe tener un formato de 24 horas")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_CC='".jsreplace("El campo debe ser un n�mero v�lido de targeta de credito")."';\r\n";
	$includes.="var TEXT_INLINE_FIELD_SSN='".jsreplace("El campo debe ser un n�mero de Seguridad  Social v�lido")."';\r\n";
	$includes.= "</script>\r\n";
		
			$types_separated = implode(",", $editValidateTypes);
		$fields_separated = implode(",", $editValidateFields);
		$includes.="<script type=\"text/javascript\">\r\n";
		$includes.= "var editValidateTypes = String('".$types_separated."').split(',');"."\r\n";
		$includes.= "var editValidateFields = String('".$fields_separated."').split(',');"."\r\n";
		$includes.= "</script>\r\n";
											
			$types_separated = implode(",", $addValidateTypes);
		$fields_separated = implode(",", $addValidateFields);
		$includes.="<script type=\"text/javascript\">\r\n";
		$includes.= "var addValidateTypes = String('".$types_separated."').split(',');"."\r\n";
		$includes.= "var addValidateFields = String('".$fields_separated."').split(',');"."\r\n";
		$includes.= "</script>\r\n";
												
		//	include datepicker files
	$includes.="<script type=\"text/javascript\" src=\"include/calendar.js\"></script>\r\n";

/*	


*/



}
$includes.="<script type=\"text/javascript\" src=\"include/jsfunctions.js\">".
"</script>\n".
"<script type=\"text/javascript\">".
"\nvar bSelected=false;".
"\nvar TEXT_FIRST = \""."Primero"."\";".
"\nvar TEXT_PREVIOUS = \""."Anterior"."\";".
"\nvar TEXT_NEXT = \""."Siguiente"."\";".
"\nvar TEXT_LAST = \""."�ltimo"."\";".
"\nvar TEXT_PLEASE_SELECT='".jsreplace("Por favor seleccione")."';".
"\nvar TEXT_SAVE='".jsreplace("Guardar")."';".
"\nvar TEXT_CANCEL='".jsreplace("Cancelar")."';".
"\nvar TEXT_INLINE_ERROR='".jsreplace("Se ha producido un error")."';".
"\nvar locale_dateformat = ".$locale_info["LOCALE_IDATE"].";".
"\nvar locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";".
"\nvar bLoading=false;\r\n";

if ($useAJAX) {
	$includes.="var AUTOCOMPLETE_TABLE='libros_autocomplete.php';\r\n";
	$includes.="var INLINE_EDIT_TABLE='libros_edit.php';\r\n";
	$includes.="var INLINE_ADD_TABLE='libros_add.php';\r\n";
	$includes.="var INLINE_VIEW_TABLE='libros_view.php';\r\n";
	$includes.="var SUGGEST_TABLE='libros_searchsuggest.php';\r\n";
	$includes.="var MASTER_PREVIEW_TABLE='libros_masterpreview.php';\r\n";
	$includes.="var SUGGEST_LOOKUP_TABLE='libros_lookupsuggest.php';";
}
$includes.="\n</script>\n";
if ($useAJAX) {
$includes.="<div id=\"search_suggest\"></div>";
$includes.="<div id=\"master_details\" onmouseover=\"RollDetailsLink.showPopup();\" onmouseout=\"RollDetailsLink.hidePopup();\"></div>";
$includes.="<div id=\"inline_error\"></div>";
}

$smarty->assign("includes",$includes);
$smarty->assign("useAJAX",$useAJAX);


//	process session variables
//	order by
$strOrderBy="";
$order_ind=-1;

$smarty->assign("order_dir_num_reg","a");
$smarty->assign("order_dir_titulo","a");
$smarty->assign("order_dir_autores","a");
$smarty->assign("order_dir_editorial","a");
$smarty->assign("order_dir_procedencia","a");
$smarty->assign("order_dir_fec_publi","a");
$smarty->assign("order_dir_edicion","a");
$smarty->assign("order_dir_num_pag","a");
$smarty->assign("order_dir_clasificacion","a");
$smarty->assign("order_dir_tipo","a");
$smarty->assign("order_dir_fec_ingreso","a");
$smarty->assign("order_dir_observaciones","a");

if(@$_SESSION[$strTableName."_orderby"])
{
	$order_field=substr($_SESSION[$strTableName."_orderby"],1);
	$order_dir=substr($_SESSION[$strTableName."_orderby"],0,1);
	$order_ind=GetFieldIndex($order_field);

	$smarty->assign("order_dir_num_reg","a");
	if($order_field=="num_reg")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_num_reg","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_num_reg","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_titulo","a");
	if($order_field=="titulo")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_titulo","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_titulo","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_autores","a");
	if($order_field=="autores")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_autores","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_autores","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_editorial","a");
	if($order_field=="editorial")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_editorial","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_editorial","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_procedencia","a");
	if($order_field=="procedencia")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_procedencia","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_procedencia","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_fec_publi","a");
	if($order_field=="fec_publi")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_fec_publi","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_fec_publi","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_edicion","a");
	if($order_field=="edicion")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_edicion","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_edicion","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_num_pag","a");
	if($order_field=="num_pag")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_num_pag","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_num_pag","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_clasificacion","a");
	if($order_field=="clasificacion")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_clasificacion","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_clasificacion","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_tipo","a");
	if($order_field=="tipo")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_tipo","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_tipo","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_fec_ingreso","a");
	if($order_field=="fec_ingreso")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_fec_ingreso","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_fec_ingreso","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_observaciones","a");
	if($order_field=="observaciones")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_observaciones","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_observaciones","<img src=\"images/".$img.".gif\" border=0>");
	}

	if($order_ind)
	{
		if($order_dir=="a")
			$strOrderBy="order by ".($order_ind)." asc";
		else 
			$strOrderBy="order by ".($order_ind)." desc";
	}
}
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;

//	page number
$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize=$gPageSize;

	$smarty->assign("rpp10_selected",($PageSize==10)?"selected":"");
	$smarty->assign("rpp20_selected",($PageSize==20)?"selected":"");
	$smarty->assign("rpp30_selected",($PageSize==30)?"selected":"");
	$smarty->assign("rpp50_selected",($PageSize==50)?"selected":"");
	$smarty->assign("rpp100_selected",($PageSize==100)?"selected":"");
	$smarty->assign("rpp500_selected",($PageSize==500)?"selected":"");

// delete record
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
		$keys["num_reg"]=urldecode(@$arr[0]);
		$selected_recs[]=$keys;
	}
}

$records_deleted=0;
foreach($selected_recs as $keys)
{
	$where = KeyWhere($keys);

	$strSQL="delete from ".AddTableWrappers($strOriginalTableName)." where ".$where;
	$retval=true;
	if(function_exists("AfterDelete") || function_exists("BeforeDelete"))
	{
		$deletedrs = db_query(gSQLWhere($where),$conn);
		$deleted_values = db_fetch_array($deletedrs);
	}
	if(function_exists("BeforeDelete"))
		$retval = BeforeDelete($where,$deleted_values);
	if($retval)
	{
		$records_deleted++;
				LogInfo($strSQL);
		db_exec($strSQL,$conn);
		if(function_exists("AfterDelete"))
			AfterDelete($where,$deleted_values);
	}
}

if(count($selected_recs))
{
	if(function_exists("AfterMassDelete"))
		AfterMassDelete($records_deleted);
}

//	make sql "select" string

//$strSQL = $gstrSQL;
$strWhereClause="";

//	add search params

if(@$_SESSION[$strTableName."_search"]==1)
//	 regular search
{  
	$strSearchFor=trim($_SESSION[$strTableName."_searchfor"]);
	$strSearchOption=trim($_SESSION[$strTableName."_searchoption"]);
	if(@$_SESSION[$strTableName."_searchfield"])
	{
		$strSearchField = $_SESSION[$strTableName."_searchfield"];
		if($where = StrWhere($strSearchField, $strSearchFor, $strSearchOption, ""))
			$strWhereClause = whereAdd($strWhereClause,$where);
//			$strSQL = AddWhere($strSQL,$where);
		else
			$strWhereClause = whereAdd($strWhereClause,"1=0");
//			$strSQL = AddWhere($strSQL,"1=0");
	}
	else
	{
		$strWhere = "1=0";
		if($where=StrWhere("num_reg", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("titulo", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("autores", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("editorial", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("procedencia", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("fec_publi", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("edicion", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("num_pag", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("clasificacion", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("tipo", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("fec_ingreso", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("observaciones", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		$strWhereClause = whereAdd($strWhereClause,$strWhere);
//		$strSQL = AddWhere($strSQL,$strWhere);
	}
}
else if(@$_SESSION[$strTableName."_search"]==2)
//	 advanced search
{
	$sWhere="";
	foreach(@$_SESSION[$strTableName."_asearchfor"] as $f => $sfor)
		{
			$strSearchFor=trim($sfor);
			$strSearchFor2="";
			$type=@$_SESSION[$strTableName."_asearchfortype"][$f];
			if(array_key_exists($f,@$_SESSION[$strTableName."_asearchfor2"]))
				$strSearchFor2=trim(@$_SESSION[$strTableName."_asearchfor2"][$f]);
			if($strSearchFor!="" || true)
			{
				if (!$sWhere) 
				{
					if($_SESSION[$strTableName."_asearchtype"]=="and")
						$sWhere="1=1";
					else
						$sWhere="1=0";
				}
				$strSearchOption=trim($_SESSION[$strTableName."_asearchopt"][$f]);
				if($where=StrWhereAdv($f, $strSearchFor, $strSearchOption, $strSearchFor2,$type))
				{
					if($_SESSION[$strTableName."_asearchnot"][$f])
						$where="not (".$where.")";
					if($_SESSION[$strTableName."_asearchtype"]=="and")
	   					$sWhere .= " and ".$where;
					else
	   					$sWhere .= " or ".$where;
				}
			}
		}
		$strWhereClause = whereAdd($strWhereClause,$sWhere);
//		$strSQL = AddWhere($strSQL,$sWhere);
	}




if($mastertable=="libros")
{
	$where ="";
		$where.= GetFullFieldName("num_reg")."=".make_db_value("num_reg",$_SESSION[$strTableName."_masterkey1"]);
	$strWhereClause = whereAdd($strWhereClause,$where);
//	$strSQL = AddWhere($strSQL,$where);
}

$strSQL = gSQLWhere($strWhereClause);

//	order by
$strSQL.=" ".trim($strOrderBy);

//	save SQL for use in "Export" and "Printer-friendly" pages

$_SESSION[$strTableName."_sql"] = $strSQL;
$_SESSION[$strTableName."_where"] = $strWhereClause;
$_SESSION[$strTableName."_order"] = $strOrderBy;

//	select and display records
if(CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	$strSQLbak = $strSQL;
	if(function_exists("BeforeQueryList"))
		BeforeQueryList($strSQL,$strWhereClause,$strOrderBy);
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

//	 Pagination:
	if(!$numrows)
	{
		$smarty->assign("rowsfound",false);
		$message="No se hallaron registros";
				$message = "<span name=\"notfound_message\">".$message."</span>";
		$smarty->assign("message",$message);
	}
	else
	{
		$smarty->assign("rowsfound",true);
		$smarty->assign("records_found",$numrows);
		$maxRecords = $numrows;
		$maxpages=ceil($maxRecords/$PageSize);
		if($mypage > $maxpages)
			$mypage = $maxpages;
		if($mypage<1) 
			$mypage=1;
		$maxrecs=$PageSize;
		$smarty->assign("page",$mypage);
		$smarty->assign("maxpages",$maxpages);

//	write pagination
$smarty->assign("pagination","<script language=\"JavaScript\">WritePagination(".$mypage.",".$maxpages.");
		function GotoPage(nPageNumber)
		{
			window.location='libros_list.php?goto='+nPageNumber;
		}
</script>");
		
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
	$smarty->assign("column1show",true);


//	fill $rowinfo array
	$rowinfo = array();
	$shade=false;
	$recno=1;
	$editlink="";
	$copylink="";

	while($data=db_fetch_array($rs))
	{
		if(function_exists("BeforeProcessRowList"))
		{
			if(!BeforeProcessRowList($data))
				continue;
		}
		break;
	}

	while($data && $recno<=$PageSize)
	{
		$row=array();
		if(!$shade)
		{
			$row["shadeclass"]='class="shade"';
			$row["shadeclassname"]="shade";
			$shade=true;
		}
		else
		{
			$row["shadeclass"]="";
			$row["shadeclassname"]="";
			$shade=false;
		}
		for($col=1;$data && $recno<=$PageSize && $col<=1;$col++)
		{


//	key fields
			$keyblock="";
			$row[$col."id1"]=htmlspecialchars($data["num_reg"]);
			$keyblock.= rawurlencode($data["num_reg"]);
			$row[$col."keyblock"]=htmlspecialchars($keyblock);
			$row[$col."recno"] = $recno;
//	detail tables
			$masterquery="mastertable=libros";
			$masterquery.="&masterkey1=".rawurlencode($data["num_reg"]);
			$row[$col."libros_masterkeys"]=$masterquery;
//	edit page link
			$editlink="";
			$editlink.="editid1=".htmlspecialchars(rawurlencode($data["num_reg"]));
			$row[$col."editlink"]=$editlink;

			$copylink="";
			$copylink.="copyid1=".htmlspecialchars(rawurlencode($data["num_reg"]));
			$row[$col."copylink"]=$copylink;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode($data["num_reg"]));


//	num_reg - 
			$value="";
				$value = ProcessLargeText(GetData($data,"num_reg", ""),"field=num%5Freg".$keylink,"",MODE_LIST);
			$row[$col."num_reg_value"]=$value;

//	titulo - 
			$value="";
				$value = ProcessLargeText(GetData($data,"titulo", ""),"field=titulo".$keylink,"",MODE_LIST);
			$row[$col."titulo_value"]=$value;

//	autores - 
			$value="";
				$value = ProcessLargeText(GetData($data,"autores", ""),"field=autores".$keylink,"",MODE_LIST);
			$row[$col."autores_value"]=$value;

//	editorial - 
			$value="";
				$value = ProcessLargeText(GetData($data,"editorial", ""),"field=editorial".$keylink,"",MODE_LIST);
			$row[$col."editorial_value"]=$value;

//	procedencia - 
			$value="";
				$value = ProcessLargeText(GetData($data,"procedencia", ""),"field=procedencia".$keylink,"",MODE_LIST);
			$row[$col."procedencia_value"]=$value;

//	fec_publi - 
			$value="";
				$value = ProcessLargeText(GetData($data,"fec_publi", ""),"field=fec%5Fpubli".$keylink,"",MODE_LIST);
			$row[$col."fec_publi_value"]=$value;

//	edicion - 
			$value="";
				$value = ProcessLargeText(GetData($data,"edicion", ""),"field=edicion".$keylink,"",MODE_LIST);
			$row[$col."edicion_value"]=$value;

//	num_pag - 
			$value="";
				$value = ProcessLargeText(GetData($data,"num_pag", ""),"field=num%5Fpag".$keylink,"",MODE_LIST);
			$row[$col."num_pag_value"]=$value;

//	clasificacion - 
			$value="";
				$value = ProcessLargeText(GetData($data,"clasificacion", ""),"field=clasificacion".$keylink,"",MODE_LIST);
			$row[$col."clasificacion_value"]=$value;

//	tipo - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tipo", ""),"field=tipo".$keylink,"",MODE_LIST);
			$row[$col."tipo_value"]=$value;

//	fec_ingreso - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"fec_ingreso", ""),"field=fec%5Fingreso".$keylink,"",MODE_LIST);
			$row[$col."fec_ingreso_value"]=$value;

//	observaciones - 
			$value="";
				$value = ProcessLargeText(GetData($data,"observaciones", ""),"field=observaciones".$keylink,"",MODE_LIST);
			$row[$col."observaciones_value"]=$value;
			$row[$col."show"]=true;
			if(function_exists("BeforeMoveNextList"))
				BeforeMoveNextList($data,$row,$col);
			$span="<span ";
			$span.="id=\"edit".$recno."_num_reg\" ";
					$span.=">";
			$row[$col."num_reg_value"] = $span.$row[$col."num_reg_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_titulo\" ";
					$span.=">";
			$row[$col."titulo_value"] = $span.$row[$col."titulo_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_autores\" ";
					$span.=">";
			$row[$col."autores_value"] = $span.$row[$col."autores_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_editorial\" ";
					$span.=">";
			$row[$col."editorial_value"] = $span.$row[$col."editorial_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_procedencia\" ";
					$span.=">";
			$row[$col."procedencia_value"] = $span.$row[$col."procedencia_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_fec_publi\" ";
					$span.=">";
			$row[$col."fec_publi_value"] = $span.$row[$col."fec_publi_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_edicion\" ";
					$span.=">";
			$row[$col."edicion_value"] = $span.$row[$col."edicion_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_num_pag\" ";
					$span.=">";
			$row[$col."num_pag_value"] = $span.$row[$col."num_pag_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_clasificacion\" ";
					$span.=">";
			$row[$col."clasificacion_value"] = $span.$row[$col."clasificacion_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_tipo\" ";
					$span.=">";
			$row[$col."tipo_value"] = $span.$row[$col."tipo_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_fec_ingreso\" ";
					$span.=">";
			$row[$col."fec_ingreso_value"] = $span.$row[$col."fec_ingreso_value"]."</span>";
			$span="<span ";
			$span.="id=\"edit".$recno."_observaciones\" ";
					$span.=">";
			$row[$col."observaciones_value"] = $span.$row[$col."observaciones_value"]."</span>";
				
			while($data=db_fetch_array($rs))
			{
				if(function_exists("BeforeProcessRowList"))
				{
					if(!BeforeProcessRowList($data))
						continue;
				}
				break;
			}
			$recno++;
			
		}
		$rowinfo[]=$row;
	}
	$smarty->assign("rowinfo",$rowinfo);

}


if(CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	if($_SESSION[$strTableName."_search"]==1)
	{
		$onload = "onLoad=\"if(document.getElementById('SearchFor')) document.getElementById('ctlSearchFor').focus();\"";
		$smarty->assign("onload",$onload);
//	fill in search variables
	//	field selection
		if(@$_SESSION[$strTableName."_searchfield"]=="num_reg")
			$smarty->assign("search_num_reg","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="titulo")
			$smarty->assign("search_titulo","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="autores")
			$smarty->assign("search_autores","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="editorial")
			$smarty->assign("search_editorial","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="procedencia")
			$smarty->assign("search_procedencia","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="fec_publi")
			$smarty->assign("search_fec_publi","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="edicion")
			$smarty->assign("search_edicion","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="num_pag")
			$smarty->assign("search_num_pag","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="clasificacion")
			$smarty->assign("search_clasificacion","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="tipo")
			$smarty->assign("search_tipo","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="fec_ingreso")
			$smarty->assign("search_fec_ingreso","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="observaciones")
			$smarty->assign("search_observaciones","selected");
	// search type selection
		if(@$_SESSION[$strTableName."_searchoption"]=="Contains")
			$smarty->assign("search_contains_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Equals")
			$smarty->assign("search_equals_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Starts with ...")
			$smarty->assign("search_startswith_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="More than ...")
			$smarty->assign("search_more_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Less than ...")
			$smarty->assign("search_less_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Equal or more than ...")
			$smarty->assign("search_equalormore_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Equal or less than ...")
			$smarty->assign("search_equalorless_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Empty")
			$smarty->assign("search_empty_option_selected","selected");		

		$smarty->assign("search_searchfor","value=\"".htmlspecialchars(@$_SESSION[$strTableName."_searchfor"])."\"");
	}
}

$smarty->assign("userid",htmlspecialchars($_SESSION["UserID"]));



$smarty->assign("displayheader","<script language=\"JavaScript\">DisplayHeader();</script>");




$linkdata="";

if ($useAJAX) {
	$linkdata .= "<script type=\"text/javascript\">\r\n";
	$linkdata .= "

function SetDate(fldName, recordID)
{
	if ( $('select#month'+fldName+'_'+recordID).get(0).value!='' && $('select#day'+fldName+'_'+recordID).get(0).value!='' && $('select#year'+fldName+'_'+recordID).get(0).value!='') {
		$('input#'+fldName+'_'+recordID).get(0).value = '' + 
			$('select#year'+fldName+'_'+recordID).get(0).value + '-' + 
			$('select#month'+fldName+'_'+recordID).get(0).value + '-' + 
			$('select#day'+fldName+'_'+recordID).get(0).value;
		if ( $('input#ts'+fldName+'_'+recordID)[0] )
			$('input#ts'+fldName+'_'+recordID).get(0).value = '' + 
				$('select#day'+fldName+'_'+recordID).get(0).value + '-' + 
				$('select#month'+fldName+'_'+recordID).get(0).value + '-' + 
				$('select#year'+fldName+'_'+recordID).get(0).value;
	} else {
		if ( $('input#ts'+fldName+'_'+recordID)[0] )
			$('input#ts'+fldName+'_'+recordID).get(0).value= '10-6-2007';
		if ( $('input#'+fldName+'_'+recordID)[0] )
			$('input#'+fldName+'_'+recordID).get(0).value= '';
	}
}


function update(fldName, recordID, newDate, showTime)
{
	var dt_datetime;
	var curdate = new Date();
	dt_datetime = newDate;
	
	if ( $('select#day'+fldName+'_'+recordID)[0] ) {
		$('input#'+fldName+'_'+recordID).get(0).value = dt_datetime.getFullYear() + '-' 
			+ (dt_datetime.getMonth()+1) + '-' + dt_datetime.getDate();
		$('select#day'+fldName+'_'+recordID).get(0).selectedIndex = dt_datetime.getDate();
		$('select#month'+fldName+'_'+recordID).get(0).selectedIndex = dt_datetime.getMonth() + 1;
		for ( i=0; i<$('select#year'+fldName+'_'+recordID).get(0).options.length; i++ ) {
			if ( $('select#year'+fldName+'_'+recordID).get(0).options[i].value == dt_datetime.getFullYear() ) { 
				$('select#year'+fldName+'_'+recordID).get(0).selectedIndex = i; 
				break; 
			} 
			$('input#ts'+fldName+'_'+recordID).get(0).value = dt_datetime.getDate() + '-' + 
				( dt_datetime.getMonth() + 1 ) + '-' + dt_datetime.getFullYear();
		}
	} else {
		$('input#'+fldName+'_'+ recordID).get(0).value = print_datetime(newDate,".$locale_info["LOCALE_IDATE"].",showTime);
		$('input#ts'+fldName+'_'+ recordID).get(0).value = print_datetime(newDate,-1,showTime);
	}
}";
	$linkdata.="\$(\".addarea\").each(function(i) { \$(this).hide();});\r\n";
	$linkdata.="var newrecord_id=".($recno+1).";\r\n";
	$linkdata.="var newrecord_tempid=0;\r\n";
	if(!$numrows)
	{
		$linkdata .= "$('[@name=record_controls]').hide();
			$('[@name=maintable]').hide();";
	}
	$linkdata .= "</script>\r\n";

$linkdata .= "<style>
#inline_error {
	font-family: Verdana, Arial, Helvetica, sans serif;
	font-size: 11px;
	position: absolute;
	background-color: white;
	border: 1px solid red;
	padding: 10px;
	background-repeat: no-repeat;
	display: none;
	}
</style>";
}

if ($useAJAX) {
$linkdata.="<script>
if(!$('[@disptype=control1]').length && $('[@disptype=controltable1]').length)
	$('[@disptype=controltable1]').hide();
</script>";
}
$smarty->assign("linkdata",$linkdata);

$strSQL=$_SESSION[$strTableName."_sql"];
$smarty->assign("guest",$_SESSION["AccessLevel"] == ACCESS_LEVEL_GUEST);

$templatefile = "libros_list.htm";
if(function_exists("BeforeShowList"))
	BeforeShowList($smarty,$templatefile);

$smarty->display($templatefile);

