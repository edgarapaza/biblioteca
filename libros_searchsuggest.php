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

$response = array();

if (isset($_GET['searchFor']) && postvalue('searchFor') != '') {

	$searchFor = postvalue('searchFor');
	$searchField = GoodFieldName( postvalue('searchField') );
	
	if ( $searchField == '' || $searchField=="num_reg")
	{
		$field="num_reg";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="titulo")
	{
		$field="titulo";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="autores")
	{
		$field="autores";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="editorial")
	{
		$field="editorial";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="procedencia")
	{
		$field="procedencia";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="fec_publi")
	{
		$field="fec_publi";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="edicion")
	{
		$field="edicion";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="num_pag")
	{
		$field="num_pag";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="clasificacion")
	{
		$field="clasificacion";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="tipo")
	{
		$field="tipo";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	if ( $searchField == '' || $searchField=="observaciones")
	{
		$field="observaciones";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".str_replace("'","''",$searchFor)."%'" : " like '".str_replace("'","''",$searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhere,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);

			while ($row = db_fetch_numarray($rs)) {
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
			}
		}
		}
	db_close($conn);
}

sort($response);

if ($output = array_chunk(array_unique($response),10)) {
	foreach( $output[0] as $value ) {
		echo ($suggestAllContent) ? str_replace($searchFor,"<b>".$searchFor."</b>",substr($value,0,50))."\n" : substr($value,0,50)."\n";
	}
}
?>