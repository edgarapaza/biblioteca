<?php /* Smarty version 2.6.13, created on 2009-02-04 11:04:04
         compiled from libros_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'libros_add.htm', 8, false),array('function', 'doevent', 'libros_add.htm', 12, false),array('function', 'build_edit_control', 'libros_add.htm', 50, false),)), $this); ?>
<html>
<head><title>libros</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
<?php echo $this->_tpl_vars['includes']; ?>

</head>

<body bgcolor=white <?php echo $this->_tpl_vars['bodyonload']; ?>
>
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<form name="editform" encType="multipart/form-data" method="post" action="libros_add.php" <?php echo $this->_tpl_vars['onsubmit']; ?>
>


<?php echo smarty_function_doevent(array('name' => 'AddOnLoad'), $this);?>


<TABLE CELLPADDING=0 CELLSPACING=0 align=center border=0>
<tr><td>
<b class="xtop"><b class="xb1b"></b><b class="xb2b"></b><b class="xb3b"></b><b class="xb4b"></b></b>
<div class="xboxcontentb">
<table cellpadding=0 class="main_table" cellspacing=0 border=0>
<tr><td>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr>
  <td class=upeditmenu width=100% valign=middle align=center height=35>Libros, Añadir nuevo registro
</td>
</tr>
</table>
</td></tr>
<tr><td width=100% height=1px bgcolor=white></td></tr>

<?php if ($this->_tpl_vars['message'] != ""): ?>
<tr><td width=100% align=center style="padding:10px">
<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td>
<b class="xtop"><b class="xb1u"></b><b class="xb2u"></b><b class="xb3u"></b><b class="xb4u"></b></b>
<div class="xboxcontentb">
<table cellpadding=5 cellspacing=0 border=0 width=100% align=center>
<tr><td colspan=2 align=center class=downedit2><?php echo $this->_tpl_vars['message']; ?>
</td></tr>
</table>
</div>
<b class="xbottom"><b class="xb4u"></b><b class="xb3u"></b><b class="xb2u"></b><b class="xb1u"></b></b>
</td></tr></table>
</td></tr>
<?php endif; ?>

<tr><td style="padding:10px">
<div class="xboxcontent">
<table cellpadding=4 cellspacing=0 border=0>

  <tr>
    <td class=editshadeleft_b2 width=150 style="padding-left:15px;">Titulo del Libro</td>
    <td width=250 class=editshaderight_lb2 style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'titulo','mode' => 'add','value' => $this->_tpl_vars['value_titulo']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Autor(es)</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'autores','mode' => 'add','value' => $this->_tpl_vars['value_autores']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Editorial</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'editorial','mode' => 'add','value' => $this->_tpl_vars['value_editorial']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Lugar de Procedencia</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'procedencia','mode' => 'add','value' => $this->_tpl_vars['value_procedencia']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Fecha de Publicación</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'fec_publi','mode' => 'add','value' => $this->_tpl_vars['value_fec_publi']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Edicion</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'edicion','mode' => 'add','value' => $this->_tpl_vars['value_edicion']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Numero de Paginas</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'num_pag','mode' => 'add','value' => $this->_tpl_vars['value_num_pag']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Clasificacion(Area que Corresponde)</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'clasificacion','mode' => 'add','value' => $this->_tpl_vars['value_clasificacion']), $this);?>

    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Tipo</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
	    <?php echo smarty_function_build_edit_control(array('field' => 'tipo','mode' => 'add','value' => $this->_tpl_vars['value_tipo']), $this);?>
 Donado,Comprado
    </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Fecha de Ingreso</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'fec_ingreso','mode' => 'add','value' => $this->_tpl_vars['value_fec_ingreso']), $this);?>

      &nbsp;<img src="images/icon_required.gif">
  </td></tr>
  <tr>
    <td class=editshade_b width=150 style="padding-left:15px;">Observaciones</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo smarty_function_build_edit_control(array('field' => 'observaciones','mode' => 'add','value' => $this->_tpl_vars['value_observaciones']), $this);?>

    </td></tr>
<tr><td colspan=2 align=left class=downedit>
   <img src="images/icon_required.gif"> - Campo de requerimiento
   </td></tr>
 <tr><td colspan=2 align=center class=downedit>
 <span class=buttonborder><input class=button type=submit value="&nbsp;&nbsp;Guardar&nbsp;&nbsp;"  name=submit1></span>
<span class=buttonborder><input class=button type=reset value="&nbsp;&nbsp;Reiniciar&nbsp;&nbsp;"></span>
 <span class=buttonborder><input class=button type=button value="&nbsp;&nbsp;Volver a la lista&nbsp;&nbsp;" onClick="window.location.href='libros_list.php?a=return'"></span>
   <input type=hidden name="a" value="added">
 </td></tr>
</form>
 
</table>
</div>
<b class="xbottom"><b class="xb4a"></b><b class="xb3a"></b><b class="xb2a"></b><b class="xb1a"></b></b>
</td></tr>
</table>
</div>
<b class="xbottom"><b class="xb4b3"></b><b class="xb3b3"></b><b class="xb2b3"></b><b class="xb1b3"></b></b>
 </td></tr></table><br>
<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


<?php echo $this->_tpl_vars['linkdata']; ?>

<script>SetToFirstControl();</script>
</body>
</html>
