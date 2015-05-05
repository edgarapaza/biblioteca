<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
session_cache_limiter("none");
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

$conn=db_connect();
//	Before Process event
if(function_exists("BeforeProcessExport"))
	BeforeProcessExport($conn);

$strWhereClause="";

$options = "1";
if (@$_REQUEST["a"]!="") 
{
	$options = "";
	
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


	$strSQL = gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
	
	$_SESSION[$strTableName."_SelectedSQL"] = $strSQL;
	$_SESSION[$strTableName."_SelectedWhere"] = $sWhere;
}

if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
{
	$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
	$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strSQL=gSQLWhere($strWhereClause);
}


$mypage=1;
if(@$_REQUEST["type"])
{
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);

	$strSQLbak = $strSQL;
	if(function_exists("BeforeQueryExport"))
		BeforeQueryExport($strSQL,$strWhereClause,$strOrderBy);
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

	$nPageSize=0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage=(integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize=(integer)@$_SESSION[$strTableName."_pagesize"];
		if($numrows<=($mypage-1)*$nPageSize)
			$mypage=ceil($numrows/$nPageSize);
		if(!$nPageSize)
			$nPageSize=$gPageSize;
		if(!$mypage)
			$mypage=1;

		$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
	}
	$rs=db_query($strSQL,$conn);

	if(!ini_get("safe_mode"))
		set_time_limit(300);
	
	if(@$_REQUEST["type"]=="excel")
		ExportToExcel();
	else if(@$_REQUEST["type"]=="word")
		ExportToWord();
	else if(@$_REQUEST["type"]=="xml")
		ExportToXML();
	else if(@$_REQUEST["type"]=="csv")
		ExportToCSV();
	else if(@$_REQUEST["type"]=="pdf")
		ExportToPDF();

	db_close($conn);
	return;
}

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include('libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->assign("options",$options);
$smarty->display("libros_export.htm");


function ExportToExcel()
{
	global $cCharset;
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=libros.xls");

	echo "<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord()
{
	global $cCharset;
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=libros.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML()
{
	global $nPageSize,$rs,$strTableName,$conn;
	header("Content-type: text/xml");
	header("Content-Disposition: attachment;Filename=libros.xml");
	if(!($row=db_fetch_array($rs)))
		return;
	global $cCharset;
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i=0;
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		echo "<row>\r\n";
		$field=htmlspecialchars(XMLNameEncode("num_reg"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"num_reg",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("titulo"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"titulo",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("autores"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"autores",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("editorial"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"editorial",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("procedencia"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"procedencia",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("fec_publi"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"fec_publi",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("edicion"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"edicion",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("num_pag"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"num_pag",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("clasificacion"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"clasificacion",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("tipo"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"tipo",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("fec_ingreso"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"fec_ingreso",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("observaciones"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"observaciones",""));
		echo "</".$field.">\r\n";
		echo "</row>\r\n";
		$i++;
		$row=db_fetch_array($rs);
	}
	echo "</table>\r\n";
}

function ExportToCSV()
{
	global $rs,$nPageSize,$strTableName,$conn;
	header("Content-type: application/csv");
	header("Content-Disposition: attachment;Filename=libros.csv");

	if(!($row=db_fetch_array($rs)))
		return;

	$totals=array();

	
// write header
	$outstr="";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"num_reg\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"titulo\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"autores\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"editorial\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"procedencia\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"fec_publi\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"edicion\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"num_pag\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"clasificacion\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tipo\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"fec_ingreso\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"observaciones\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		$outstr="";
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"num_reg",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"titulo",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"autores",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"editorial",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"procedencia",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"fec_publi",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"edicion",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"num_pag",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"clasificacion",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"tipo",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Short Date";
		$outstr.='"'.htmlspecialchars(GetData($row,"fec_ingreso",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"observaciones",$format)).'"';
		echo $outstr;
		echo "\r\n";
		$iNumberOfRows++;
		$row=db_fetch_array($rs);
	}

//	display totals
	$first=true;

}


function WriteTableData()
{
	global $rs,$nPageSize,$strTableName,$conn;
	if(!($row=db_fetch_array($rs)))
		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
		echo '<td style="width: 100" x:str>'.PrepareForExcel("num_reg").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("titulo").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("autores").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("editorial").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("procedencia").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("fec_publi").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("edicion").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("num_pag").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("clasificacion").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("tipo").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("fec_ingreso").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("observaciones").'</td>';
	}
	else
	{
		echo "<td>num_reg</td>";
		echo "<td>titulo</td>";
		echo "<td>autores</td>";
		echo "<td>editorial</td>";
		echo "<td>procedencia</td>";
		echo "<td>fec_publi</td>";
		echo "<td>edicion</td>";
		echo "<td>num_pag</td>";
		echo "<td>clasificacion</td>";
		echo "<td>tipo</td>";
		echo "<td>fec_ingreso</td>";
		echo "<td>observaciones</td>";
	}
	echo "</tr>";

	$totals=array();
// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		echo "<tr>";
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"num_reg",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"titulo",$format));
		else
			echo htmlspecialchars(GetData($row,"titulo",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"autores",$format));
		else
			echo htmlspecialchars(GetData($row,"autores",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"editorial",$format));
		else
			echo htmlspecialchars(GetData($row,"editorial",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"procedencia",$format));
		else
			echo htmlspecialchars(GetData($row,"procedencia",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"fec_publi",$format));
		else
			echo htmlspecialchars(GetData($row,"fec_publi",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"edicion",$format));
		else
			echo htmlspecialchars(GetData($row,"edicion",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"num_pag",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"clasificacion",$format));
		else
			echo htmlspecialchars(GetData($row,"clasificacion",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"tipo",$format));
		else
			echo htmlspecialchars(GetData($row,"tipo",$format));
	echo '</td>';
	echo '<td>';

		$format="Short Date";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"fec_ingreso",$format));
		else
			echo htmlspecialchars(GetData($row,"fec_ingreso",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"observaciones",$format));
		else
			echo htmlspecialchars(GetData($row,"observaciones",$format));
	echo '</td>';
		echo "</tr>";
		$iNumberOfRows++;
		$row=db_fetch_array($rs);
	}

}

function XMLNameEncode($strValue)
{	
	$search=array(" ","#","'","/","\\","(",")",",","[","]","+","\"","-","_","|","}","{","=");
	return str_replace($search,"",$strValue);
}

function PrepareForExcel($str)
{
	$ret = htmlspecialchars($str);
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}




function ExportToPDF()
{
	global $nPageSize,$rs,$strTableName,$conn;
		global $colwidth,$leftmargin;
	if(!($row=db_fetch_array($rs)))
		return;


	include("libs/fpdf.php");

	class PDF extends FPDF
	{
	//Current column
		var $col=0;
	//Ordinate of column start
		var $y0;
		var $maxheight;

	function AcceptPageBreak()
	{
		global $colwidth,$leftmargin;
		if($this->y0+$this->rowheight>$this->PageBreakTrigger)
			return true;
		$x=$leftmargin;
		if($this->maxheight<$this->PageBreakTrigger-$this->y0)
			$this->maxheight=$this->PageBreakTrigger-$this->y0;
		$this->Rect($x,$this->y0,$colwidth["num_reg"],$this->maxheight);
		$x+=$colwidth["num_reg"];
		$this->Rect($x,$this->y0,$colwidth["titulo"],$this->maxheight);
		$x+=$colwidth["titulo"];
		$this->Rect($x,$this->y0,$colwidth["autores"],$this->maxheight);
		$x+=$colwidth["autores"];
		$this->Rect($x,$this->y0,$colwidth["editorial"],$this->maxheight);
		$x+=$colwidth["editorial"];
		$this->Rect($x,$this->y0,$colwidth["procedencia"],$this->maxheight);
		$x+=$colwidth["procedencia"];
		$this->Rect($x,$this->y0,$colwidth["fec_publi"],$this->maxheight);
		$x+=$colwidth["fec_publi"];
		$this->Rect($x,$this->y0,$colwidth["edicion"],$this->maxheight);
		$x+=$colwidth["edicion"];
		$this->Rect($x,$this->y0,$colwidth["num_pag"],$this->maxheight);
		$x+=$colwidth["num_pag"];
		$this->Rect($x,$this->y0,$colwidth["clasificacion"],$this->maxheight);
		$x+=$colwidth["clasificacion"];
		$this->Rect($x,$this->y0,$colwidth["tipo"],$this->maxheight);
		$x+=$colwidth["tipo"];
		$this->Rect($x,$this->y0,$colwidth["fec_ingreso"],$this->maxheight);
		$x+=$colwidth["fec_ingreso"];
		$this->Rect($x,$this->y0,$colwidth["observaciones"],$this->maxheight);
		$x+=$colwidth["observaciones"];
		$this->maxheight = $this->rowheight;
//	draw frame	
		return true;
	}

	function Header()
	{
		global $colwidth,$leftmargin;
	    //Page header
		$this->SetFillColor(192);
		$this->SetX($leftmargin);
		$this->Cell($colwidth["num_reg"],$this->rowheight,"num_reg",1,0,'C',1);
		$this->Cell($colwidth["titulo"],$this->rowheight,"titulo",1,0,'C',1);
		$this->Cell($colwidth["autores"],$this->rowheight,"autores",1,0,'C',1);
		$this->Cell($colwidth["editorial"],$this->rowheight,"editorial",1,0,'C',1);
		$this->Cell($colwidth["procedencia"],$this->rowheight,"procedencia",1,0,'C',1);
		$this->Cell($colwidth["fec_publi"],$this->rowheight,"fec_publi",1,0,'C',1);
		$this->Cell($colwidth["edicion"],$this->rowheight,"edicion",1,0,'C',1);
		$this->Cell($colwidth["num_pag"],$this->rowheight,"num_pag",1,0,'C',1);
		$this->Cell($colwidth["clasificacion"],$this->rowheight,"clasificacion",1,0,'C',1);
		$this->Cell($colwidth["tipo"],$this->rowheight,"tipo",1,0,'C',1);
		$this->Cell($colwidth["fec_ingreso"],$this->rowheight,"fec_ingreso",1,0,'C',1);
		$this->Cell($colwidth["observaciones"],$this->rowheight,"observaciones",1,0,'C',1);
		$this->Ln($this->rowheight);
		$this->y0=$this->GetY();
	}

	}

	$pdf=new PDF();

	$leftmargin=5;
	$pagewidth=200;
	$pageheight=290;
	$rowheight=5;


	$defwidth=$pagewidth/12;
	$colwidth=array();
    $colwidth["num_reg"]=$defwidth;
    $colwidth["titulo"]=$defwidth;
    $colwidth["autores"]=$defwidth;
    $colwidth["editorial"]=$defwidth;
    $colwidth["procedencia"]=$defwidth;
    $colwidth["fec_publi"]=$defwidth;
    $colwidth["edicion"]=$defwidth;
    $colwidth["num_pag"]=$defwidth;
    $colwidth["clasificacion"]=$defwidth;
    $colwidth["tipo"]=$defwidth;
    $colwidth["fec_ingreso"]=$defwidth;
    $colwidth["observaciones"]=$defwidth;
	
	$pdf->AddFont('CourierNewPSMT','','courcp1252.php');
	$pdf->rowheight=$rowheight;
	
	$pdf->SetFont('CourierNewPSMT','',8);
	$pdf->AddPage();
	

	$i=0;
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		$pdf->maxheight=$rowheight;
		$x=$leftmargin;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["num_reg"],$rowheight,GetData($row,"num_reg",""));
		$x+=$colwidth["num_reg"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["titulo"],$rowheight,GetData($row,"titulo",""));
		$x+=$colwidth["titulo"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["autores"],$rowheight,GetData($row,"autores",""));
		$x+=$colwidth["autores"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["editorial"],$rowheight,GetData($row,"editorial",""));
		$x+=$colwidth["editorial"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["procedencia"],$rowheight,GetData($row,"procedencia",""));
		$x+=$colwidth["procedencia"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["fec_publi"],$rowheight,GetData($row,"fec_publi",""));
		$x+=$colwidth["fec_publi"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["edicion"],$rowheight,GetData($row,"edicion",""));
		$x+=$colwidth["edicion"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["num_pag"],$rowheight,GetData($row,"num_pag",""));
		$x+=$colwidth["num_pag"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["clasificacion"],$rowheight,GetData($row,"clasificacion",""));
		$x+=$colwidth["clasificacion"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["tipo"],$rowheight,GetData($row,"tipo",""));
		$x+=$colwidth["tipo"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["fec_ingreso"],$rowheight,GetData($row,"fec_ingreso","Short Date"));
		$x+=$colwidth["fec_ingreso"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["observaciones"],$rowheight,GetData($row,"observaciones",""));
		$x+=$colwidth["observaciones"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
//	draw fames
		$x=$leftmargin;
		$pdf->Rect($x,$pdf->y0,$colwidth["num_reg"],$pdf->maxheight);
		$x+=$colwidth["num_reg"];
		$pdf->Rect($x,$pdf->y0,$colwidth["titulo"],$pdf->maxheight);
		$x+=$colwidth["titulo"];
		$pdf->Rect($x,$pdf->y0,$colwidth["autores"],$pdf->maxheight);
		$x+=$colwidth["autores"];
		$pdf->Rect($x,$pdf->y0,$colwidth["editorial"],$pdf->maxheight);
		$x+=$colwidth["editorial"];
		$pdf->Rect($x,$pdf->y0,$colwidth["procedencia"],$pdf->maxheight);
		$x+=$colwidth["procedencia"];
		$pdf->Rect($x,$pdf->y0,$colwidth["fec_publi"],$pdf->maxheight);
		$x+=$colwidth["fec_publi"];
		$pdf->Rect($x,$pdf->y0,$colwidth["edicion"],$pdf->maxheight);
		$x+=$colwidth["edicion"];
		$pdf->Rect($x,$pdf->y0,$colwidth["num_pag"],$pdf->maxheight);
		$x+=$colwidth["num_pag"];
		$pdf->Rect($x,$pdf->y0,$colwidth["clasificacion"],$pdf->maxheight);
		$x+=$colwidth["clasificacion"];
		$pdf->Rect($x,$pdf->y0,$colwidth["tipo"],$pdf->maxheight);
		$x+=$colwidth["tipo"];
		$pdf->Rect($x,$pdf->y0,$colwidth["fec_ingreso"],$pdf->maxheight);
		$x+=$colwidth["fec_ingreso"];
		$pdf->Rect($x,$pdf->y0,$colwidth["observaciones"],$pdf->maxheight);
		$x+=$colwidth["observaciones"];
		$pdf->y0+=$pdf->maxheight;
		$i++;
		$row=db_fetch_array($rs);
	}
	$pdf->Output();
}

?>