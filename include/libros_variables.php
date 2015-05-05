<?php

$strTableName="libros";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="libros";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="select *";
$gsqlFrom="From `libros`";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "select `num_reg`,   `titulo`,   `autores`,   `editorial`,   `procedencia`,   `fec_publi`,   `edicion`,   `num_pag`,   `clasificacion`,   `tipo`,   `fec_ingreso`,   `observaciones`  From `libros`";
$gstrSQL = gSQLWhere("");

include("include/libros_settings.php");
include("include/libros_events.php");
?>