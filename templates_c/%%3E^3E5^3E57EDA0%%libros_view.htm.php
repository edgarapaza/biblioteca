<?php /* Smarty version 2.6.13, created on 2011-12-28 09:58:43
         compiled from libros_view.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'libros_view.htm', 5, false),array('function', 'doevent', 'libros_view.htm', 7, false),)), $this); ?>
<html>
<title>libros</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
<body bgcolor=white >
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<?php echo $this->_tpl_vars['message']; ?>

<?php echo smarty_function_doevent(array('name' => 'ViewOnLoad'), $this);?>



<TABLE CELLPADDING=0 CELLSPACING=0 align=center border=0><tr><td colspan=2>
<tr><td>
<b class="xtop"><b class="xb1b"></b><b class="xb2b"></b><b class="xb3b"></b><b class="xb4b"></b></b>
<div class="xboxcontentb">
<table cellpadding=0 class="main_table" cellspacing=0 border=0><tr><td>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td class=upeditmenu width=100% valign=middle align=center height=35>
libros, Ver registro [
num_reg: <?php echo $this->_tpl_vars['show_key1']; ?>

]

</td></tr>
</table>
</td></tr>
<tr><td width=100% height=1px bgcolor=white></td></tr>
<tr><td style="padding:10px">
<div class="xboxcontent">
<table cellpadding=4 cellspacing=0 border=0">

<tr>
    <td class=editshadeleft_b2 width=150 style="padding-left:15px;">num_reg</td>
    <td width=250 class=editshaderight_lb2 style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_num_reg']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">titulo</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_titulo']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">autores</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_autores']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">editorial</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_editorial']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">procedencia</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_procedencia']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">fec_publi</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_fec_publi']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">edicion</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_edicion']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">num_pag</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_num_pag']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">clasificacion</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_clasificacion']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">tipo</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_tipo']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">fec_ingreso</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_fec_ingreso']; ?>
&nbsp;
  </td></tr>
<tr>
    <td class=editshade_b width=150 style="padding-left:15px;">observaciones</td>
    <td width=250 class=editshade_lb style="padding-left:10px;">
    <?php echo $this->_tpl_vars['show_observaciones']; ?>
&nbsp;
  </td></tr>
<tr><td colspan=2 align=left class=downedit>
   <img src="images/icon_required.gif"> - Campo de requerimiento
   </td></tr>
 <tr><td colspan=2 align=center class=downedit>
<span class=buttonborder><input class=button type=button value="&nbsp;&nbsp;Volver a la lista&nbsp;&nbsp;" onclick="window.location.href='libros_list.php?a=return'"></span>
 </td></tr>

</table>
</div>
<b class="xbottom"><b class="xb4a"></b><b class="xb3a"></b><b class="xb2a"></b><b class="xb1a"></b></b>
</td></tr>
</table>
</div>
<b class="xbottom"><b class="xb4b3"></b><b class="xb3b3"></b><b class="xb2b3"></b><b class="xb1b3"></b></b>
 </td></tr></table><br>

<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


</body>
</html>