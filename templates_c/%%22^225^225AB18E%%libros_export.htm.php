<?php /* Smarty version 2.6.13, created on 2009-02-04 08:51:03
         compiled from libros_export.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'libros_export.htm', 4, false),array('function', 'doevent', 'libros_export.htm', 5, false),)), $this); ?>
<html>
<link REL="stylesheet" href="include/style.css" type="text/css">
<body onLoad="javascript:if (document.frmexport.btnSubmit != null) document.frmexport.btnSubmit.focus();">
<?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>

<?php echo smarty_function_doevent(array('name' => 'ExportOnLoad'), $this);?>

	<form action="libros_export.php" method=get id=frmexport name=frmexport>
<TABLE width=500px CELLPADDING=0 CELLSPACING=0 align=center border=0>
<tr><td>
<b class="xtop"><b class="xb1b"></b><b class="xb2b"></b><b class="xb3b"></b><b class="xb4b"></b></b>
<div class="xboxcontentb">

	<table border=0 CELLPADDING=3 CELLSPACING=0 width=500px class="main_table">
	<tr>
		<?php if ($this->_tpl_vars['options'] != ""): ?><td align=center class=upeditmenu>Rango de datos</td><?php endif; ?>
		<td align=center class=upeditmenu>Formato mostrado</td>
	</tr>
	<tr><td width=100% height=1px colspan=2 bgcolor=white></td></tr>
	<tr><td colspan=2 style="padding:7px">
	    <div class=xboxcontent>
	    <table cellpadding=0 cellspacing=0 border=0 width=100%>
	        <tr valign=top>
	        <?php if ($this->_tpl_vars['options'] != ""): ?>
	        <td width=50% class=export_left>
		        <INPUT TYPE="Radio" NAME="records" VALUE="all" CHECKED> Todos los registros<br>
		        <INPUT TYPE="Radio" NAME="records" VALUE="page"> Sólo página actual<br>
	        </td>
	        <?php endif; ?>
	        <td width=50% class=export_right>
		        <INPUT TYPE="Radio" NAME="type" VALUE="excel" CHECKED> <img src="images/excel.gif"> Excel
		        <br><INPUT TYPE="Radio" NAME="type" VALUE="word"> <img src="images/word.gif"> Word
		        <br><INPUT TYPE="Radio" NAME="type" VALUE="csv"> <img src="images/csv.gif"> Valores separados por coma
		        <br><INPUT TYPE="Radio" NAME="type" VALUE="xml"> <img src="images/xml.gif"> XML
		        <br><INPUT TYPE="Radio" NAME="type" VALUE="pdf"> <img src="images/pdf.gif"> PDF
	        </td>
	        </tr>
	        <tr><td class=menuline colspan=2></td></tr>
	        <tr height=30 valign=middle>
	        <td colspan=2 align=center class=downedit>
	            <input type=submit name=btnSubmit  value="&nbsp;&nbsp;Exportar&nbsp;&nbsp;" class=button>
	        </td></tr>
	    </table>
	    </div>
        <b class="xbottom"><b class="xb4a"></b><b class="xb3a"></b><b class="xb2a"></b><b class="xb1a"></b></b>
   </td></tr>
   </table>
</div>
<b class="xbottom"><b class="xb4b4"></b><b class="xb3b4"></b><b class="xb2b4"></b><b class="xb1b4"></b></b>
</td></tr>
</table>	
	</form>
<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>

</body>
</html>