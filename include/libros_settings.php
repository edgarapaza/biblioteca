<?php

$tdata=array();
	 $tdata[".NumberOfChars"]=80; 
	$tdata[".ShortName"]="libros";
	$tdata[".OwnerID"]="";

	
//	num_reg
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "num_reg";
	        	$fdata["FullName"]= "`libros`.`num_reg`";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["num_reg"]=$fdata;
	
//	titulo
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "titulo";
	        	$fdata["FullName"]= "`libros`.`titulo`";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["titulo"]=$fdata;
	
//	autores
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "autores";
	        	$fdata["FullName"]= "`libros`.`autores`";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["autores"]=$fdata;
	
//	editorial
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "editorial";
	        	$fdata["FullName"]= "`libros`.`editorial`";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=100";
					$fdata["FieldPermissions"]=true;
		$tdata["editorial"]=$fdata;
	
//	procedencia
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "procedencia";
	        	$fdata["FullName"]= "`libros`.`procedencia`";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=100";
					$fdata["FieldPermissions"]=true;
		$tdata["procedencia"]=$fdata;
	
//	fec_publi
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "fec_publi";
	        	$fdata["FullName"]= "`libros`.`fec_publi`";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=30";
					$fdata["FieldPermissions"]=true;
		$tdata["fec_publi"]=$fdata;
	
//	edicion
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "edicion";
	        	$fdata["FullName"]= "`libros`.`edicion`";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=60";
					$fdata["FieldPermissions"]=true;
		$tdata["edicion"]=$fdata;
	
//	num_pag
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "num_pag";
	        	$fdata["FullName"]= "`libros`.`num_pag`";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
		$tdata["num_pag"]=$fdata;
	
//	clasificacion
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "clasificacion";
	        	$fdata["FullName"]= "`libros`.`clasificacion`";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
					$fdata["FieldPermissions"]=true;
		$tdata["clasificacion"]=$fdata;
	
//	tipo
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "tipo";
	        	$fdata["FullName"]= "`libros`.`tipo`";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=10";
					$fdata["FieldPermissions"]=true;
		$tdata["tipo"]=$fdata;
	
//	fec_ingreso
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "fec_ingreso";
	        	$fdata["FullName"]= "`libros`.`fec_ingreso`";
	 	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=24";
					$fdata["FieldPermissions"]=true;
		$tdata["tipo"]=$fdata;


//	observaciones
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		$fdata["GoodName"]= "observaciones";
	        	$fdata["FullName"]= "`libros`.`observaciones`";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=255";
					$fdata["FieldPermissions"]=true;
		$tdata["observaciones"]=$fdata;
$tables_data["libros"]=$tdata;
?>