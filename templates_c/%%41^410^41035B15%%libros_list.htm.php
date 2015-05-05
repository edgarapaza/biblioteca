<?php /* Smarty version 2.6.13, created on 2009-02-12 11:35:46
         compiled from libros_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'libros_list.htm', 13, false),array('function', 'doevent', 'libros_list.htm', 395, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>libros</TITLE>
<META http-equiv=Content-Type content="text/html; charset=windows-1252"><LINK 
href="include/style.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.5730.13" name=GENERATOR></HEAD>
<BODY topMargin=5 <?php echo $this->_tpl_vars['onload']; ?>
>
<div align="center"><?php echo $this->_tpl_vars['includes']; ?>
<img src="../images/baner_sup.png" alt="a" width="600" height="83"></div>
<FORM name=frmSearch action=libros_list.php method=get><input type="Hidden" name="a" value="search"><input type="Hidden" name="value" value="1"><input type="Hidden" name="SearchFor" value=""><input type="Hidden" name="SearchOption" value=""><input type="Hidden" name="SearchField" value=""></FORM>
<TABLE cellSpacing=0 cellPadding=0 width=1045 align=center border=0>
  <TBODY>
  <TR>
    <TD colSpan=2>
      <P align=center><?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>
</P></TD></TR>
  <TR>
    <TD colSpan=2><B class=xtop><B class=xb1b></B></B><B class=xtop><B 
      class=xb2b></B></B><B class=xtop><B class=xb3b></B></B><B class=xtop><B 
      class=xb4b></B></B>
      <DIV class=xboxcontentb>
      <TABLE class=main_table cellSpacing=0 cellPadding=0 width=1045 
      align=center border=0>
        <TBODY>
        <TR>
          <TD colSpan=2>
            <TABLE cellSpacing=0 cellPadding=5 width="100%" align=center 
            border=0>
              <TBODY>
              <TR>
                <TD class=uplistmenu style="BORDER-BOTTOM: white 1px solid" 
                align=middle><!-- login/logout -->Conectado como&nbsp;<B><?php echo $this->_tpl_vars['userid']; ?>
</B>&nbsp; <SPAN 
                  class=buttonborder><INPUT class=button onClick="javascript:window.location.href='login.php?a=logout'" type=button value=Desconectarse></SPAN> 
<!-- change password--><!-- Advanced search-->&nbsp;&nbsp;&nbsp;&nbsp; 
                  <SPAN class=buttonborder><INPUT class=button onClick="javascript:window.location.href='libros_search.php'" type=button value="B&uacute;squeda avanzada"></SPAN> 
<!-- export -->&nbsp;&nbsp;&nbsp;&nbsp; <SPAN 
                  class=buttonborder><INPUT class=button onClick="window.open('libros_export.php','wExport');return false;" type=button value="Exportar resultados"></SPAN> 
<!-- print -->&nbsp;&nbsp;&nbsp;&nbsp; <SPAN 
                  class=buttonborder><INPUT class=button onClick="window.open('libros_print.php','wPrint');return false;" type=button value="Impresora versi&oacute;n amigable"></SPAN> 
                </TD></TR></TBODY></TABLE></TD></TR>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=10 width="100%" border=0><!-- menu block -->
              <TBODY>
              <TR>
                <TD vAlign=top width=200>
                  <TABLE cellSpacing=0 cellPadding=0 width=200 border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=top align=middle width="100%"><B 
                        class=xtop><B class=xb1a></B><B class=xb2a></B><B 
                        class=xb3a></B><B class=xb4a></B></B>
                        <DIV class=xboxcontent><!----menu search---->
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                          <TBODY>
                          <TR>
                            <TD class=upsearchmenu align=middle width="100%" 
                            colSpan=2 height=23>libros</TD></TR>
                          <TR height=1>
                            <TD class=menuline width="100%" colSpan=2></TD></TR><!-- simple search --></TBODY></TABLE>
                        <TABLE cellSpacing=0 cellPadding=5 width="100%" 
border=0>
                          <TBODY>
                          <TR>
                            <TD class=menuline width="100%" colSpan=2 
                            height=1></TD></TR>
                          <TR>
                            <TD class=toplist align=middle colSpan=2>Buscar 
                              por:</TD></TR>
                          <TR>
                            <TD align=left colSpan=2><select id="ctlSearchField">
<option value="">Cualquier campo</option>
<option value="num_reg" <?php echo $this->_tpl_vars['search_num_reg']; ?>
>Num Registro</option>
<option value="titulo" <?php echo $this->_tpl_vars['search_titulo']; ?>
>Titulo</option>
<option value="autores" <?php echo $this->_tpl_vars['search_autores']; ?>
>Autor(es)</option>
<option value="editorial" <?php echo $this->_tpl_vars['search_editorial']; ?>
>Editorial</option>
<option value="procedencia" <?php echo $this->_tpl_vars['search_procedencia']; ?>
>Procedencia</option>
<option value="fec_publi" <?php echo $this->_tpl_vars['search_fec_publi']; ?>
>Fecha de Publicacion</option>
<option value="edicion" <?php echo $this->_tpl_vars['search_edicion']; ?>
>Edicion</option>
<option value="num_pag" <?php echo $this->_tpl_vars['search_num_pag']; ?>
>Num. Paginas</option>
<option value="clasificacion" <?php echo $this->_tpl_vars['search_clasificacion']; ?>
>Clasificacion</option>
<option value="tipo" <?php echo $this->_tpl_vars['search_tipo']; ?>
>Tipo</option>
<option value="fec_ingreso" <?php echo $this->_tpl_vars['search_fec_ingreso']; ?>
>Fecha de Ingreso</option>
<option value="observaciones" <?php echo $this->_tpl_vars['search_observaciones']; ?>
>Observaciones</option>
</select> 
                            </TD></TR>
                          <TR>
                            <TD align=left colSpan=2><select id="ctlSearchOption">
<option value="Contains" <?php echo $this->_tpl_vars['search_contains_option_selected']; ?>
>Contiene</option>
<option value="Equals" <?php echo $this->_tpl_vars['search_equals_option_selected']; ?>
>Equivale</option>
<option value="Starts with ..." <?php echo $this->_tpl_vars['search_startswith_option_selected']; ?>
>Empieza con</option>
<option value="More than ..." <?php echo $this->_tpl_vars['search_more_option_selected']; ?>
>M&acute;s que</option>
<option value="Less than ..." <?php echo $this->_tpl_vars['search_less_option_selected']; ?>
>Menos que</option>
<option value="Equal or more than ..." <?php echo $this->_tpl_vars['search_equalormore_option_selected']; ?>
>Igual o m�s</option>
<option value="Equal or less than ..." <?php echo $this->_tpl_vars['search_equalorless_option_selected']; ?>
>Igual o menos</option>
<option value="Empty" <?php echo $this->_tpl_vars['search_empty_option_selected']; ?>
>Vacio</option>
</select> 
                            </TD></TR>
                          <TR>
                            <TD align=left colSpan=2><INPUT id=ctlSearchFor 
                              name=ctlSearchFor <?php echo $this->_tpl_vars['search_searchfor']; ?>
 <?php if ($this->_tpl_vars['useAJAX']): ?> autocomplete="off" onkeydown="return listenEvent(event,this,'ordinary');" onkeyup="searchSuggest(event,this,'ordinary');" <?php else: ?> onkeydown="e=event; if(!e) e = window.event; if (e.keyCode != 13) return true; e.cancel = true; RunSearch(); return false;" <?php endif; ?>> 
                            </TD></TR>
                          <TR>
                            <TD align=middle colSpan=2><SPAN 
                              class=buttonborder><INPUT class=button onClick="javascript: RunSearch();" type=button value=Buscar></SPAN>&nbsp;&nbsp;<SPAN 
                              class=buttonborder><INPUT class=button onClick="javascript: document.forms.frmSearch.a.value = 'showall'; document.forms.frmSearch.submit();" type=button value="Mostrar todo"></SPAN> 
                            </TD></TR><!-- how many records found-->
                          <TR>
                            <TD class=menuline width="100%" colSpan=2 
                            height=1></TD></TR>
                          <TR>
                            <TD class=toplist align=middle colSpan=2>Detalles 
                              encontrados: <?php echo $this->_tpl_vars['records_found']; ?>
</TD></TR>
                          <TR>
                            <TD class=toplist align=middle colSpan=2>P&aacute;gina <?php echo $this->_tpl_vars['page']; ?>
/ <?php echo $this->_tpl_vars['maxpages']; ?>
</TD></TR><!--Records per page-->
                          <TR>
                            <TD class=menuline width="100%" colSpan=2 
                            height=1></TD></TR>
                          <TR>
                            <TD class=toplist align=middle>Resultados por 
                              p�gina:&nbsp;&nbsp;</TD></TR>
                          <TR>
                            <TD align=middle><select 
onChange="javascript: document.location='libros_list.php?pagesize='+this.options[this.selectedIndex].value;">
<option value="10" <?php echo $this->_tpl_vars['rpp10_selected']; ?>
>10</option>
<option value="20" <?php echo $this->_tpl_vars['rpp20_selected']; ?>
>20</option>
<option value="30" <?php echo $this->_tpl_vars['rpp30_selected']; ?>
>30</option>
<option value="50" <?php echo $this->_tpl_vars['rpp50_selected']; ?>
>50</option>
<option value="100" <?php echo $this->_tpl_vars['rpp100_selected']; ?>
>100</option>
<option value="500" <?php echo $this->_tpl_vars['rpp500_selected']; ?>
>500</option>
</select> 
                            </TD></TR></TBODY></TABLE></DIV><B class=xbottom><B 
                        class=xb4></B><B class=xb3></B><B class=xb2></B><B 
                        class=xb1></B></B></TD></TR></TBODY></TABLE></TD><!-- main block -->
                <TD vAlign=top align=middle width="80%"><?php if ($this->_tpl_vars['mastertable'] != ""): ?>
                  <P align=center><A class=toplinks href="<?php echo $this->_tpl_vars['mastertable_short']; ?>
_list.php?a=return"><B>Regresar a la 
                  tabla principal</B></A></P><?php endif; ?>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" align=center 
                  border=0 disptype="controltable1">
                    <TBODY>
                    <TR>
                      <TD align=middle width="100%"><B class=xtop><B 
                        class=xb1></B><B class=xb2></B><B class=xb3></B><B 
                        class=xb4></B></B>
                        <DIV class=xboxcontent>
                        <TABLE width="100%" align=center border=0>
                          <TBODY>
                          <TR>
                            <TD align=middle 
                              height=30><!-- Add new record --><SPAN 
                              class=buttonborder><INPUT class=button onClick="javascript:window.location.href='libros_add.php'" type=button value="A&ntilde;adir nuevo" disptype="control1"></SPAN> 
                             
                              <SPAN name="record_controls"><SPAN 
                              class=buttonborder name="edit_selected"><INPUT class=button onclick=javascript:void(0); type=button value="Editar los seleccionados" name=edit_selected disptype="control1"></SPAN> 
                              <SPAN class=buttonborder style="DISPLAY: none" 
                              name="saveall_edited"><INPUT class=button onclick=javascript:void(0); type=button value="Guardar todo" name=saveall_edited disptype="control1"></SPAN> 
                              <SPAN class=buttonborder style="DISPLAY: none" 
                              name="revertall_edited"><INPUT class=button onclick=javascript:void(0); type=button value=Cancelar name=revertall_edited disptype="control1"></SPAN> 
                              <SPAN class=buttonborder><INPUT class=button onClick="if (confirm('?Realmente quiere borrar estos archivos?')) frmAdmin.submit(); return false;" type=button value="Borrar articulos seleccionados" disptype="control1"></SPAN> 
                              <SPAN class=buttonborder><INPUT class=button onClick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined &amp;&amp; frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='libros_export.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='libros_list.php'; frmAdmin.target='_self';" type=button value="Exportar seleccionados" disptype="control1"></SPAN> 
                              <SPAN class=buttonborder><INPUT class=button onClick="var c=0; if(frmAdmin.elements['selection[]'].length==undefined &amp;&amp; frmAdmin.elements['selection[]'].checked) c=1; else for (i=0;i<frmAdmin.elements['selection[]'].length;++i) if (frmAdmin.elements['selection[]'][i].checked) c=1;  if(c==0) return true; frmAdmin.action='libros_print.php';frmAdmin.target='_blank';frmAdmin.submit(); frmAdmin.action='libros_list.php'; frmAdmin.target='_self';" type=button value="Imprimir seleccionados" disptype="control1"></SPAN> 
                              </SPAN><!-- language info --></TD></TR></TBODY></TABLE></DIV><B 
                        class=xbottom><B class=xb4></B><B class=xb3></B><B 
                        class=xb2></B><B 
                  class=xb1></B></B></TD></TR></TBODY></TABLE><BR>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD><!-- delete form -->
                        <FORM name=frmAdmin action=libros_list.php 
                        method=post><input type=hidden id="a" name="a" value="delete">
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" 
border=0>
                          <TBODY>
                          <TR>
                            <TD align=middle>
                              <DIV class=xboxcontent>
                              <TABLE class=data cellSpacing=0 cellPadding=3 
                              width="100%" border=0 name="maintable"><!-- table header -->
                                <TBODY>
                                <TR vAlign=top><!--<?php if ($this->_tpl_vars['column1show']): ?>-->
                                <TD class=headerlist_left_M>&nbsp;</TD>
                                <TD class=headerlist align=middle width=50><IMG 
                                src="include/img/icon_edit.gif" <?php echo '?>'; ?>
</TD>
                                <TD class=headerlist align=middle width=50><IMG 
                                src="include/img/icon_view.gif"></TD>
                                <TD class=headerlist align=middle 
                                width=50><INPUT 
                                onclick="var i; /*this.checked=!this.checked; */&#13;&#10;if ((typeof frmAdmin.elements['selection[]'].length)=='undefined')&#13;&#10;&#9;frmAdmin.elements['selection[]'].checked=this.checked;&#13;&#10;else&#13;&#10;for (i=0;i<frmAdmin.elements['selection[]'].length;++i) &#13;&#10;&#9;frmAdmin.elements['selection[]'][i].checked=this.checked;" 
                                type=checkbox> </TD>
                                <TD class=headerlist align=middle 
                                width=50>&nbsp;</TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_num_reg']; ?>
num%5Freg">Num.Registro</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_num_reg']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_titulo']; ?>
titulo">Titulo</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_titulo']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_autores']; ?>
autores">Autor(es)</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_autores']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_editorial']; ?>
editorial">Editorial</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_editorial']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_procedencia']; ?>
procedencia">Procedencia</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_procedencia']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_fec_publi']; ?>
fec%5Fpubli">Fecha Publicacion</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_fec_publi']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_edicion']; ?>
edicion">Edicion</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_edicion']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_num_pag']; ?>
num%5Fpag">Num. Paginas</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_num_pag']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_clasificacion']; ?>
clasificacion">Clasificaci&oacute;n</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_clasificacion']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_tipo']; ?>
tipo">tipo</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_tipo']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_fec_ingreso']; ?>
fec%5Fingreso">Fecha Ingreso</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_fec_ingreso']; ?>
</TD></TR></TBODY></TABLE></TD>
                                <TD class=headerlist_right_M align=middle>
                                <TABLE cellSpacing=0 cellPadding=0 align=center 
                                border=0>
                                <TBODY>
                                <TR>
                                <TD><A class=tablelinks 
                                href="libros_list.php?orderby=<?php echo $this->_tpl_vars['order_dir_observaciones']; ?>
observaciones">Observaciones</A> 
                                </TD>
                                <TD><?php echo $this->_tpl_vars['order_image_observaciones']; ?>
</TD></TR></TBODY></TABLE></TD><!--<?php endif; ?>--></TR><!-- inline add area -->
                                <TR class=addarea>
                                <TD>&nbsp;</TD>
                                <TD vAlign=middle align=middle><A 
                                class=tablelinks2 id=ieditlink_add 
                                href="libros_edit.php?">Editar</A> </TD>
                                <TD vAlign=middle align=middle><A 
                                class=tablelinks2 id=viewlink_add 
                                href="libros_view.php?">Ver</A> </TD>
                                <TD vAlign=middle align=middle><INPUT 
                                id=check_add type=checkbox value="" 
                                name=selection[]> </TD>
                                <TD vAlign=middle align=middle><A 
                                class=tablelinks2 id=master_libros_add 
                                href="libros_list.php?" <?php if ($this->_tpl_vars['useAJAX']): ?> onMouseOver="RollDetailsLink.showPopup(this,'libros_detailspreview.php'+this.href.substr(this.href.indexOf('?')));" onMouseOut="RollDetailsLink.hidePopup();" <?php endif; ?>>libros</A> 
                                </TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_num_reg></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_titulo></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_autores></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_editorial></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_procedencia></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_fec_publi></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_edicion></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_num_pag></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_clasificacion></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_tipo></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_fec_ingreso></SPAN></TD>
                                <TD vAlign=middle align=middle><SPAN 
                                id=add_observaciones></SPAN></TD></TR><!-- end inline add area --><!--<?php if ($this->_tpl_vars['rowsfound']): ?>--><!-- table data --><!--<?php $_from = $this->_tpl_vars['rowinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>-->
                                <TR 
                                onmouseover="this.className = 'rowselected';" 
                                onmouseout="this.className = '<?php echo $this->_tpl_vars['row']['shadeclassname']; ?>
';" 
                                vAlign=top <?php echo $this->_tpl_vars['row']['rowstyle']; ?>
 <?php echo $this->_tpl_vars['row']['shadeclass']; ?>
><!--<?php if ($this->_tpl_vars['column1show']): ?>-->
                                <TD class=tabledate align=left></TD>
                                <TD vAlign=middle align=middle><A 
                                class=tablelinks2 id=ieditlink<?php echo $this->_tpl_vars['row']['1recno']; ?>
 
                                onclick="return inlineEdit('<?php echo $this->_tpl_vars['row']['1recno']; ?>
','<?php echo $this->_tpl_vars['row']['1editlink']; ?>
');" 
                                href="libros_edit.php?<?php echo $this->_tpl_vars['row']['1editlink']; ?>
">Editar</A> 
                                </TD>
                                <TD vAlign=middle align=middle><A 
                                class=tablelinks2 id=viewlink<?php echo $this->_tpl_vars['row']['1recno']; ?>
 
                                href="libros_view.php?<?php echo $this->_tpl_vars['row']['1editlink']; ?>
">Ver</A> 
                                </TD>
                                <TD vAlign=middle align=middle><INPUT id=check<?php echo $this->_tpl_vars['row']['1recno']; ?>
 type=checkbox value="<?php echo $this->_tpl_vars['row']['1keyblock']; ?>
" name=selection[]> </TD>
                                <TD vAlign=middle align=middle><A 
                                class=tablelinks2 
                                href="libros_list.php?<?php echo $this->_tpl_vars['row']['1libros_masterkeys']; ?>
" 
                                <?php if ($this->_tpl_vars['useAJAX']): ?> onMouseOver="RollDetailsLink.showPopup(this,'libros_detailspreview.php'+this.href.substr(this.href.indexOf('?')));" onMouseOut="RollDetailsLink.hidePopup();" <?php endif; ?>>libros</A> </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1num_reg_style']; ?>
><?php echo $this->_tpl_vars['row']['1num_reg_value']; ?>
 </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1titulo_style']; ?>
><?php echo $this->_tpl_vars['row']['1titulo_value']; ?>
 </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1autores_style']; ?>
><?php echo $this->_tpl_vars['row']['1autores_value']; ?>
 </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1editorial_style']; ?>
><?php echo $this->_tpl_vars['row']['1editorial_value']; ?>
 
                                </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1procedencia_style']; ?>
><?php echo $this->_tpl_vars['row']['1procedencia_value']; ?>
 
                                </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1fec_publi_style']; ?>
><?php echo $this->_tpl_vars['row']['1fec_publi_value']; ?>
 
                                </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1edicion_style']; ?>
><?php echo $this->_tpl_vars['row']['1edicion_value']; ?>
 </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1num_pag_style']; ?>
><?php echo $this->_tpl_vars['row']['1num_pag_value']; ?>
 </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1clasificacion_style']; ?>
><?php echo $this->_tpl_vars['row']['1clasificacion_value']; ?>
 
                                </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1tipo_style']; ?>
><?php echo $this->_tpl_vars['row']['1tipo_value']; ?>
 </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1fec_ingreso_style']; ?>
><?php echo $this->_tpl_vars['row']['1fec_ingreso_value']; ?>
 
                                </TD>
                                <TD vAlign=middle align=middle <?php echo $this->_tpl_vars['row']['1observaciones_style']; ?>
><?php echo $this->_tpl_vars['row']['1observaciones_value']; ?>
 
                                </TD><!--<?php endif; ?> - column show--><!--<?php endforeach; endif; unset($_from); ?>--></TR><!--//////////////////////////////--><!--<?php endif; ?> - rowsfound-->
                                <TR class=blackshade3 height=5><!--<?php if ($this->_tpl_vars['column1show']): ?>-->
                                <TD class=headerlistdown2_left align=left></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD></TD>
                                <TD class=headerlistdown2_right></TD><!--<?php endif; ?> - column show--></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></FORM>
                        <P align=center><B><?php echo $this->_tpl_vars['message']; ?>
</B></P><?php echo $this->_tpl_vars['pagination']; ?>
 
                      </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><?php echo smarty_function_doevent(array('name' => 'ListOnLoad'), $this);?>
 
      </DIV><B class=xbottom><B class=xb4b3></B><B class=xb3b3></B><B 
      class=xb2b3></B><B class=xb1b3></B></B></TD></TR></TBODY></TABLE><?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>
 <?php echo $this->_tpl_vars['linkdata']; ?>
</BODY></HTML>