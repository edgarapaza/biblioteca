<?php /* Smarty version 2.6.13, created on 2010-12-21 09:27:35
         compiled from login.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'include_if_exists', 'login.htm', 8, false),array('function', 'doevent', 'login.htm', 9, false),)), $this); ?>
<html>
<head>
<title>Conectar</title>
<link REL="stylesheet" href="include/style.css" type="text/css">
</head>

<body onLoad="javascript:document.forms[0].username.focus();"  text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#0066cc">
<div style="height:25%"><?php echo smarty_function_include_if_exists(array('file' => "include/header.php"), $this);?>
</div>
<?php echo smarty_function_doevent(array('name' => 'LoginOnLoad'), $this);?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" height="50%">
  <tr>
    <td valign="center" align="middle"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td  valign="top" align="right"> 
                  <table width="520" height="162" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="445"><img src="../images/Biblioteca fondo.png" width="351" height="145"></td>
                    </tr>
                  </table>
                  <form method="POST" action="login.php" id=form1 name=form1>
                  <table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr><td>
                  <b class="xtop"><b class="xb1b"></b><b class="xb2b"></b><b class="xb3b"></b><b class="xb4b"></b></b>
                  <div class="xboxcontentb" align=center>
                  <table width="300" border="0" cellspacing="0" cellpadding="6" align="center" class="main_table">
                    <tr> 
                      <td align=middle class=upeditmenu>
							 <b><font size=+1>Conectar</font></b></td>
                    </tr>
                    <tr><td heigyt=1px bgcolor=white width=100%></td></tr>
                    <tr> 
                      <td valign="top">
                       <table width="300" border=0 align="center" cellspacing=7><tr><td>
                        <b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
                        <div class="xboxcontent" align=center>
                        <table width="300" border=0 align="center" cellspacing=0 cellpadding=2>
                          <tbody>
								  <tr height=10><td colspan=2>&nbsp;</td></tr>
                          <tr> 
                            <td align=right width="50%" class=loginshade> 
                              <div align="left">Nombre de usuario:</div>
                            </td>
                            <td width="50%"> 
                              <input name=username <?php echo $this->_tpl_vars['value_username']; ?>
>
                            </td>
                          </tr>
                          <tr> 
                            <td align=right width="50%" class=loginshade> 
                              <div align="left">Contraseņa:</div>
                            </td>
                            <td width="50%"> 
                              <input type=password name=password <?php echo $this->_tpl_vars['value_password']; ?>

							  onkeydown="e=event; if(!e) e = window.event; if (e.keyCode != 13) return; e.cancel = true; e.cancelBubble=true; document.forms[0].submit(); return false;" >
                            </td>
                          </tr>
                          <tr> 
                            <td align=right width="50%" class=loginshade> 
                              <div align="left">Recordar contraseņa:</div>
                            </td>
                            <td width="50%"> 
                              <input type=checkbox name=remember_password value="1" <?php echo $this->_tpl_vars['checked']; ?>
>
                            </td>
                          </tr>
                          <tr><td class="linedownD1" height=1px width=100% colspan=2></td></tr>
                          <tr class=downedit><td height=10 colspan=2></td></tr>
                          <tr class=downedit> 
                            <td colspan=2 align=middle>
								<input type=hidden name=btnSubmit value="Login">
								<span class=buttonborder><input type=button name=btnSubmit onClick="document.forms.form1.submit();return false;" value="&nbsp;&nbsp;Presentar&nbsp;&nbsp;" class=buttonM></span>
                            </td>
                          </tr>
							  <tr  class=downedit> 
                            <td colspan=2 align=middle>
		                            </td>
                          </tr>
						  
                         
								   <tr class=downedit>
								   <td align=center colspan=2>
										<font color=red><?php echo $this->_tpl_vars['message']; ?>
</font>&nbsp;
									</td></tr>
									
                          </tbody> 
                        </table>
                        </DIV>
                        <b class="xbottom"><b class="xb4a"></b><b class="xb3a"></b><b class="xb2a"></b><b class="xb1a"></b></b>
                        </td></tr></table>
                      </td>
                    </tr>
                  </table>
                  </div>
                  <b class="xbottom"><b class="xb4b4"></b><b class="xb3b4"></b><b class="xb2b4"></b><b class="xb1b4"></b></b>
                  </td></tr></table>
                  </form>
                <p>&nbsp;</p></td>
              </tr>
            </table>
            
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?php echo smarty_function_include_if_exists(array('file' => "include/footer.php"), $this);?>


</body>
</html>