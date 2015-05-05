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

//connect database
$conn = db_connect();

include('libs/Smarty.class.php');
$smarty = new Smarty();

//	Before Process event
if(function_exists("BeforeProcessSearch"))
	BeforeProcessSearch($conn);


$includes=
"<STYLE>
	.vis1	{ visibility:\"visible\" }
	.vis2	{ visibility:\"hidden\" }
</STYLE>
<script language=\"JavaScript\" src=\"include/calendar.js\"></script>
<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
if ($useAJAX) {
$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>
<script language=\"JavaScript\" src=\"include/ajaxsuggest.js\"></script>\r\n";
}
$includes.="<script language=\"JavaScript\" type=\"text/javascript\">\r\n".
"var locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
"var locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
"var bLoading=false;\r\n".
"var TEXT_PLEASE_SELECT='".addslashes("Por favor seleccione")."';\r\n";
if ($useAJAX) {
$includes.="var SUGGEST_TABLE = \"libros_searchsuggest.php\";\r\n".
"var SUGGEST_LOOKUP_TABLE='libros_lookupsuggest.php';\r\n".
"var AUTOCOMPLETE_TABLE=\"libros_autocomplete.php\";\r\n";
}
$includes.="var detect = navigator.userAgent.toLowerCase();

function checkIt(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}


function ShowHideControls()
{
	document.getElementById('second_num_reg').style.display =  
		document.forms.editform.elements['asearchopt_num_reg'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_titulo').style.display =  
		document.forms.editform.elements['asearchopt_titulo'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_autores').style.display =  
		document.forms.editform.elements['asearchopt_autores'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_editorial').style.display =  
		document.forms.editform.elements['asearchopt_editorial'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_procedencia').style.display =  
		document.forms.editform.elements['asearchopt_procedencia'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_fec_publi').style.display =  
		document.forms.editform.elements['asearchopt_fec_publi'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_edicion').style.display =  
		document.forms.editform.elements['asearchopt_edicion'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_num_pag').style.display =  
		document.forms.editform.elements['asearchopt_num_pag'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_clasificacion').style.display =  
		document.forms.editform.elements['asearchopt_clasificacion'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_tipo').style.display =  
		document.forms.editform.elements['asearchopt_tipo'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_fec_ingreso').style.display =  
		document.forms.editform.elements['asearchopt_fec_ingreso'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_observaciones').style.display =  
		document.forms.editform.elements['asearchopt_observaciones'].value==\"Between\" ? '' : 'none'; 
	return false;
}
function ResetControls()
{
	var i;
	e = document.forms[0].elements; 
	for (i=0;i<e.length;i++) 
	{
		if (e[i].name!='type' && e[i].className!='button' && e[i].type!='hidden')
		{
			if(e[i].type=='select-one')
				e[i].selectedIndex=0;
			else if(e[i].type=='select-multiple')
			{
				var j;
				for(j=0;j<e[i].options.length;j++)
					e[i].options[j].selected=false;
			}
			else if(e[i].type=='checkbox' || e[i].type=='radio')
				e[i].checked=false;
			else 
				e[i].value = ''; 
		}
		else if(e[i].name.substr(0,6)=='value_' && e[i].type=='hidden')
			e[i].value = ''; 
	}
	ShowHideControls();	
	return false;
}";

if ($useAJAX) {
$includes.="
$(document).ready(function() {
	document.forms.editform.value_num_reg.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_num_reg,'advanced')};
	document.forms.editform.value1_num_reg.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_num_reg,'advanced1')};
	document.forms.editform.value_num_reg.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_num_reg,'advanced')};
	document.forms.editform.value1_num_reg.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_num_reg,'advanced1')};
	document.forms.editform.value_titulo.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_titulo,'advanced')};
	document.forms.editform.value1_titulo.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_titulo,'advanced1')};
	document.forms.editform.value_titulo.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_titulo,'advanced')};
	document.forms.editform.value1_titulo.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_titulo,'advanced1')};
	document.forms.editform.value_autores.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_autores,'advanced')};
	document.forms.editform.value1_autores.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_autores,'advanced1')};
	document.forms.editform.value_autores.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_autores,'advanced')};
	document.forms.editform.value1_autores.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_autores,'advanced1')};
	document.forms.editform.value_editorial.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_editorial,'advanced')};
	document.forms.editform.value1_editorial.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_editorial,'advanced1')};
	document.forms.editform.value_editorial.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_editorial,'advanced')};
	document.forms.editform.value1_editorial.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_editorial,'advanced1')};
	document.forms.editform.value_procedencia.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_procedencia,'advanced')};
	document.forms.editform.value1_procedencia.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_procedencia,'advanced1')};
	document.forms.editform.value_procedencia.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_procedencia,'advanced')};
	document.forms.editform.value1_procedencia.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_procedencia,'advanced1')};
	document.forms.editform.value_fec_publi.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_fec_publi,'advanced')};
	document.forms.editform.value1_fec_publi.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_fec_publi,'advanced1')};
	document.forms.editform.value_fec_publi.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_fec_publi,'advanced')};
	document.forms.editform.value1_fec_publi.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_fec_publi,'advanced1')};
	document.forms.editform.value_edicion.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_edicion,'advanced')};
	document.forms.editform.value1_edicion.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_edicion,'advanced1')};
	document.forms.editform.value_edicion.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_edicion,'advanced')};
	document.forms.editform.value1_edicion.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_edicion,'advanced1')};
	document.forms.editform.value_num_pag.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_num_pag,'advanced')};
	document.forms.editform.value1_num_pag.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_num_pag,'advanced1')};
	document.forms.editform.value_num_pag.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_num_pag,'advanced')};
	document.forms.editform.value1_num_pag.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_num_pag,'advanced1')};
	document.forms.editform.value_clasificacion.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_clasificacion,'advanced')};
	document.forms.editform.value1_clasificacion.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_clasificacion,'advanced1')};
	document.forms.editform.value_clasificacion.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_clasificacion,'advanced')};
	document.forms.editform.value1_clasificacion.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_clasificacion,'advanced1')};
	document.forms.editform.value_tipo.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_tipo,'advanced')};
	document.forms.editform.value1_tipo.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_tipo,'advanced1')};
	document.forms.editform.value_tipo.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_tipo,'advanced')};
	document.forms.editform.value1_tipo.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_tipo,'advanced1')};
	document.forms.editform.value_observaciones.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_observaciones,'advanced')};
	document.forms.editform.value1_observaciones.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_observaciones,'advanced1')};
	document.forms.editform.value_observaciones.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_observaciones,'advanced')};
	document.forms.editform.value1_observaciones.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_observaciones,'advanced1')};
});
</script>
<div id=\"search_suggest\"></div>
";
} else {
$includes.="
function OnKeyDown(e)
{ if(!e) e = window.event; 
if (e.keyCode == 13){ e.cancel = true; document.forms[0].submit();} }

</script>";
}

$smarty->assign("includes",$includes);
$smarty->assign("noAJAX",!$useAJAX);

$onload="onLoad=\"javascript: ShowHideControls();\"";
$smarty->assign("onload",$onload);

if(@$_SESSION[$strTableName."_asearchtype"]=="or")
{
	$smarty->assign("any_checked"," checked");
	$smarty->assign("all_checked","");
}
else
{
	$smarty->assign("any_checked","");
	$smarty->assign("all_checked"," checked");
}

$editformats=array();

// num_reg 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["num_reg"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["num_reg"];
	$smarty->assign("value_num_reg",@$_SESSION[$strTableName."_asearchfor"]["num_reg"]);
	$smarty->assign("value1_num_reg",@$_SESSION[$strTableName."_asearchfor2"]["num_reg"]);
}	
if($not)
	$smarty->assign("not_num_reg"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_num_reg\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_num_reg",$searchtype);
//	edit format
$editformats["num_reg"]="Text field";
// titulo 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["titulo"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["titulo"];
	$smarty->assign("value_titulo",@$_SESSION[$strTableName."_asearchfor"]["titulo"]);
	$smarty->assign("value1_titulo",@$_SESSION[$strTableName."_asearchfor2"]["titulo"]);
}	
if($not)
	$smarty->assign("not_titulo"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_titulo\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_titulo",$searchtype);
//	edit format
$editformats["titulo"]="Text field";
// autores 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["autores"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["autores"];
	$smarty->assign("value_autores",@$_SESSION[$strTableName."_asearchfor"]["autores"]);
	$smarty->assign("value1_autores",@$_SESSION[$strTableName."_asearchfor2"]["autores"]);
}	
if($not)
	$smarty->assign("not_autores"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_autores\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_autores",$searchtype);
//	edit format
$editformats["autores"]="Text field";
// editorial 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["editorial"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["editorial"];
	$smarty->assign("value_editorial",@$_SESSION[$strTableName."_asearchfor"]["editorial"]);
	$smarty->assign("value1_editorial",@$_SESSION[$strTableName."_asearchfor2"]["editorial"]);
}	
if($not)
	$smarty->assign("not_editorial"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_editorial\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_editorial",$searchtype);
//	edit format
$editformats["editorial"]="Text field";
// procedencia 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["procedencia"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["procedencia"];
	$smarty->assign("value_procedencia",@$_SESSION[$strTableName."_asearchfor"]["procedencia"]);
	$smarty->assign("value1_procedencia",@$_SESSION[$strTableName."_asearchfor2"]["procedencia"]);
}	
if($not)
	$smarty->assign("not_procedencia"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_procedencia\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_procedencia",$searchtype);
//	edit format
$editformats["procedencia"]="Text field";
// fec_publi 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["fec_publi"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["fec_publi"];
	$smarty->assign("value_fec_publi",@$_SESSION[$strTableName."_asearchfor"]["fec_publi"]);
	$smarty->assign("value1_fec_publi",@$_SESSION[$strTableName."_asearchfor2"]["fec_publi"]);
}	
if($not)
	$smarty->assign("not_fec_publi"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_fec_publi\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_fec_publi",$searchtype);
//	edit format
$editformats["fec_publi"]="Text field";
// edicion 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["edicion"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["edicion"];
	$smarty->assign("value_edicion",@$_SESSION[$strTableName."_asearchfor"]["edicion"]);
	$smarty->assign("value1_edicion",@$_SESSION[$strTableName."_asearchfor2"]["edicion"]);
}	
if($not)
	$smarty->assign("not_edicion"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_edicion\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_edicion",$searchtype);
//	edit format
$editformats["edicion"]="Text field";
// num_pag 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["num_pag"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["num_pag"];
	$smarty->assign("value_num_pag",@$_SESSION[$strTableName."_asearchfor"]["num_pag"]);
	$smarty->assign("value1_num_pag",@$_SESSION[$strTableName."_asearchfor2"]["num_pag"]);
}	
if($not)
	$smarty->assign("not_num_pag"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_num_pag\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_num_pag",$searchtype);
//	edit format
$editformats["num_pag"]="Text field";
// clasificacion 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["clasificacion"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["clasificacion"];
	$smarty->assign("value_clasificacion",@$_SESSION[$strTableName."_asearchfor"]["clasificacion"]);
	$smarty->assign("value1_clasificacion",@$_SESSION[$strTableName."_asearchfor2"]["clasificacion"]);
}	
if($not)
	$smarty->assign("not_clasificacion"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_clasificacion\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_clasificacion",$searchtype);
//	edit format
$editformats["clasificacion"]="Text field";
// tipo 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["tipo"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["tipo"];
	$smarty->assign("value_tipo",@$_SESSION[$strTableName."_asearchfor"]["tipo"]);
	$smarty->assign("value1_tipo",@$_SESSION[$strTableName."_asearchfor2"]["tipo"]);
}	
if($not)
	$smarty->assign("not_tipo"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_tipo\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_tipo",$searchtype);
//	edit format
$editformats["tipo"]="Text field";
// fec_ingreso 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["fec_ingreso"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["fec_ingreso"];
	$smarty->assign("value_fec_ingreso",@$_SESSION[$strTableName."_asearchfor"]["fec_ingreso"]);
	$smarty->assign("value1_fec_ingreso",@$_SESSION[$strTableName."_asearchfor2"]["fec_ingreso"]);
}	
if($not)
	$smarty->assign("not_fec_ingreso"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_fec_ingreso\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_fec_ingreso",$searchtype);
//	edit format
$editformats["fec_ingreso"]="Date";
// observaciones 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["observaciones"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["observaciones"];
	$smarty->assign("value_observaciones",@$_SESSION[$strTableName."_asearchfor"]["observaciones"]);
	$smarty->assign("value1_observaciones",@$_SESSION[$strTableName."_asearchfor2"]["observaciones"]);
}	
if($not)
	$smarty->assign("not_observaciones"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contiene"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equivale"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Empieza con"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."Más que"."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Menos que"."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Igual o más"."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Igual o menos"."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Entre"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Vacio"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_observaciones\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_observaciones",$searchtype);
//	edit format
$editformats["observaciones"]="Text field";

$linkdata="";

$linkdata .= "<script type=\"text/javascript\">\r\n";

if ($useAJAX) {
}
else
{
}
$linkdata.="</script>\r\n";

$smarty->assign("linkdata",$linkdata);

$templatefile = "libros_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($smarty,$templatefile);

$smarty->display($templatefile);

?>