<?php /* Smarty version 2.6.13, created on 2012-01-06 07:47:38
         compiled from libros_search.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'libros_search.htm', 8, false),array('function', 'doevent', 'libros_search.htm', 15, false),array('function', 'build_edit_control', 'libros_search.htm', 74, false),)), $this); ?>
<html>
<head>
<title>libros: Búsqueda avanzada de página</title>
</head>
<link REL="stylesheet" href="include/style.css" type="text/css">
<?php echo $this->_tpl_vars['includes']; ?>

<body bgcolor=white <?php echo $this->_tpl_vars['onload']; ?>
>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<!-- search form -->
<form method="POST" 
action="libros_list.php" 
name="editform" <?php if ($this->_tpl_vars['noAJAX']): ?> onkeydown="OnKeyDown(event);" <?php endif; ?> >
	<input type="hidden" id="a" name="a" value="advsearch">

<?php echo smarty_function_doevent(array('name' => 'SearchOnLoad'), $this);?>

	
<table CELLPADDING=0 CELLSPACING=0 align='center' width='750'>	
<tr><td>
<b class="xtop"><b class="xb1b"></b><b class="xb2b"></b><b class="xb3b"></b><b class="xb4b"></b></b>
<div class="xboxcontentb">
	
<table CELLPADDING=0 CELLSPACING=0 align='center' width='750'">
<tr valign=center>
<td colspan=5>

<table width=100% CELLSPACING=0 CELLPADDING=0 class="main_table"><tr>
<td width=200 class=tableheader>libros</td>
<td align=center class=tableheader>
Búsqueda avanzada</td>
<td width=200 class=tableheader>&nbsp;</td>
</tr></table>

</td></tr>

<tr><td width=100% height=1px bgcolor=white colspan=5></td></tr>

<tr><td colspan=5 align=center valign=middle>

<table width=100% cellpadding=7><tr><td align=center>

<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
<span class=fieldname>Buscar por: </span>
<input type="radio" name="type" value="and" <?php echo $this->_tpl_vars['all_checked']; ?>
>Todas las condiciones
&nbsp;&nbsp;&nbsp;
<input type="radio" name="type" value="or" <?php echo $this->_tpl_vars['any_checked']; ?>
>Ninguna condición
</div>
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>

</td></tr></table>
</td></tr>
<tr><td>
<table cellpadding=7 class="main_table">
<tr><td>
<div class="xboxcontent">
<table cellpadding=7 cellspacing=0 border=0>
<tr valign=center>
<td align=center valign=middle class="headerlist_left">&nbsp;</td>
<td width=30 align=center valign=middle class=headerlist2>NOT</td>
<td align=center valign=middle class="headerlist">&nbsp; </td>
<td align=center valign=middle class="headerlist">&nbsp; </td>
<td align=center valign=middle class="headerlist_right">&nbsp; </td></tr>

		
<tr>
	<td class=editshade_b style="padding-left:15px;">num_reg
	<input type="Hidden" name="asearchfield[]" value="num_reg"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_num_reg" <?php echo $this->_tpl_vars['not_num_reg']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_num_reg']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'num_reg','value' => $this->_tpl_vars['value_num_reg'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_num_reg">
	<?php echo smarty_function_build_edit_control(array('field' => 'num_reg','second' => true,'value' => $this->_tpl_vars['value1_num_reg'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">titulo
	<input type="Hidden" name="asearchfield[]" value="titulo"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_titulo" <?php echo $this->_tpl_vars['not_titulo']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_titulo']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'titulo','value' => $this->_tpl_vars['value_titulo'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_titulo">
	<?php echo smarty_function_build_edit_control(array('field' => 'titulo','second' => true,'value' => $this->_tpl_vars['value1_titulo'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">autores
	<input type="Hidden" name="asearchfield[]" value="autores"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_autores" <?php echo $this->_tpl_vars['not_autores']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_autores']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'autores','value' => $this->_tpl_vars['value_autores'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_autores">
	<?php echo smarty_function_build_edit_control(array('field' => 'autores','second' => true,'value' => $this->_tpl_vars['value1_autores'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">editorial
	<input type="Hidden" name="asearchfield[]" value="editorial"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_editorial" <?php echo $this->_tpl_vars['not_editorial']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_editorial']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'editorial','value' => $this->_tpl_vars['value_editorial'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_editorial">
	<?php echo smarty_function_build_edit_control(array('field' => 'editorial','second' => true,'value' => $this->_tpl_vars['value1_editorial'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">procedencia
	<input type="Hidden" name="asearchfield[]" value="procedencia"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_procedencia" <?php echo $this->_tpl_vars['not_procedencia']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_procedencia']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'procedencia','value' => $this->_tpl_vars['value_procedencia'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_procedencia">
	<?php echo smarty_function_build_edit_control(array('field' => 'procedencia','second' => true,'value' => $this->_tpl_vars['value1_procedencia'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">fec_publi
	<input type="Hidden" name="asearchfield[]" value="fec_publi"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_fec_publi" <?php echo $this->_tpl_vars['not_fec_publi']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_fec_publi']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'fec_publi','value' => $this->_tpl_vars['value_fec_publi'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_fec_publi">
	<?php echo smarty_function_build_edit_control(array('field' => 'fec_publi','second' => true,'value' => $this->_tpl_vars['value1_fec_publi'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">edicion
	<input type="Hidden" name="asearchfield[]" value="edicion"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_edicion" <?php echo $this->_tpl_vars['not_edicion']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_edicion']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'edicion','value' => $this->_tpl_vars['value_edicion'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_edicion">
	<?php echo smarty_function_build_edit_control(array('field' => 'edicion','second' => true,'value' => $this->_tpl_vars['value1_edicion'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">num_pag
	<input type="Hidden" name="asearchfield[]" value="num_pag"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_num_pag" <?php echo $this->_tpl_vars['not_num_pag']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_num_pag']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'num_pag','value' => $this->_tpl_vars['value_num_pag'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_num_pag">
	<?php echo smarty_function_build_edit_control(array('field' => 'num_pag','second' => true,'value' => $this->_tpl_vars['value1_num_pag'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">clasificacion
	<input type="Hidden" name="asearchfield[]" value="clasificacion"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_clasificacion" <?php echo $this->_tpl_vars['not_clasificacion']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_clasificacion']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'clasificacion','value' => $this->_tpl_vars['value_clasificacion'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_clasificacion">
	<?php echo smarty_function_build_edit_control(array('field' => 'clasificacion','second' => true,'value' => $this->_tpl_vars['value1_clasificacion'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">tipo
	<input type="Hidden" name="asearchfield[]" value="tipo"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_tipo" <?php echo $this->_tpl_vars['not_tipo']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_tipo']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'tipo','value' => $this->_tpl_vars['value_tipo'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_tipo">
	<?php echo smarty_function_build_edit_control(array('field' => 'tipo','second' => true,'value' => $this->_tpl_vars['value1_tipo'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">fec_ingreso
	<input type="Hidden" name="asearchfield[]" value="fec_ingreso"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_fec_ingreso" <?php echo $this->_tpl_vars['not_fec_ingreso']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_fec_ingreso']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'fec_ingreso','value' => $this->_tpl_vars['value_fec_ingreso'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_fec_ingreso">
	<?php echo smarty_function_build_edit_control(array('field' => 'fec_ingreso','second' => true,'value' => $this->_tpl_vars['value1_fec_ingreso'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>
		
<tr>
	<td class=editshade_b style="padding-left:15px;">observaciones
	<input type="Hidden" name="asearchfield[]" value="observaciones"></td>
	<td align=center class=editshade_lb style="padding-left:10px;"><input type=CheckBox name="not_observaciones" <?php echo $this->_tpl_vars['not_observaciones']; ?>
></td>
	
	<td class=editshade_lb style="padding-left:10px;">
	<?php echo $this->_tpl_vars['searchtype_observaciones']; ?>

	</td>
	
	<td width=270 class=editshade_lb style="padding-left:10px;"><?php echo smarty_function_build_edit_control(array('field' => 'observaciones','value' => $this->_tpl_vars['value_observaciones'],'mode' => 'search'), $this);?>
</td>

	<td width=270 class=editshade_lb style="padding-left:10px;"><span id="second_observaciones">
	<?php echo smarty_function_build_edit_control(array('field' => 'observaciones','second' => true,'value' => $this->_tpl_vars['value1_observaciones'],'mode' => 'search'), $this);?>

	</span></td>
	
	
</tr>

<tr><td colspan=5 align=center class=downedit>
<input type=button class=button name="SearchButton" value="&nbsp;&nbsp;Buscar&nbsp;&nbsp;"
onClick="javascript:document.forms.editform.submit();">
<input class=button type=button value="&nbsp;&nbsp;Reiniciar&nbsp;&nbsp;" onclick="return ResetControls();">
<input type=button class=button value="&nbsp;&nbsp;Volver a la lista&nbsp;&nbsp;" onClick="javascript: document.forms.editform.a.value='return'; document.forms.editform.submit();">
</td></tr>
</table>
</div>
<b class="xbottom"><b class="xb4a"></b><b class="xb3a"></b><b class="xb2a"></b><b class="xb1a"></b></b>
</td></tr></table>
</td></tr></table>
</div>
<b class="xbottom"><b class="xb4b4"></b><b class="xb3b4"></b><b class="xb2b4"></b><b class="xb1b4"></b></b>
</td></tr>
</table>
</form>
<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>

<?php echo $this->_tpl_vars['linkdata']; ?>


</body>
</html>