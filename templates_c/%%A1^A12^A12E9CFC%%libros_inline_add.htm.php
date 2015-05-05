<?php /* Smarty version 2.6.13, created on 2009-02-11 12:20:14
         compiled from libros_inline_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'build_edit_control', 'libros_inline_add.htm', 5, false),)), $this); ?>
<edit_controls>
	<jscode><?php echo $this->_tpl_vars['linkdata']; ?>
</jscode>
	<control 
	field="titulo">
		<?php echo smarty_function_build_edit_control(array('field' => 'titulo','value' => $this->_tpl_vars['value_titulo'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="autores">
		<?php echo smarty_function_build_edit_control(array('field' => 'autores','value' => $this->_tpl_vars['value_autores'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="editorial">
		<?php echo smarty_function_build_edit_control(array('field' => 'editorial','value' => $this->_tpl_vars['value_editorial'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="procedencia">
		<?php echo smarty_function_build_edit_control(array('field' => 'procedencia','value' => $this->_tpl_vars['value_procedencia'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="fec_publi">
		<?php echo smarty_function_build_edit_control(array('field' => 'fec_publi','value' => $this->_tpl_vars['value_fec_publi'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="edicion">
		<?php echo smarty_function_build_edit_control(array('field' => 'edicion','value' => $this->_tpl_vars['value_edicion'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="num_pag">
		<?php echo smarty_function_build_edit_control(array('field' => 'num_pag','value' => $this->_tpl_vars['value_num_pag'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="clasificacion">
		<?php echo smarty_function_build_edit_control(array('field' => 'clasificacion','value' => $this->_tpl_vars['value_clasificacion'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="tipo">
		<?php echo smarty_function_build_edit_control(array('field' => 'tipo','value' => $this->_tpl_vars['value_tipo'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<control 
	field="fec_ingreso">
	    <nobr>
	<?php echo smarty_function_build_edit_control(array('field' => 'fec_ingreso','value' => $this->_tpl_vars['value_fec_ingreso'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

	    <font color="red">*</font>
	</nobr>
	</control>
	<control 
	field="observaciones">
		<?php echo smarty_function_build_edit_control(array('field' => 'observaciones','value' => $this->_tpl_vars['value_observaciones'],'mode' => 'inline_add','id' => $this->_tpl_vars['id']), $this);?>

		</control>
	<message status="<?php echo $this->_tpl_vars['status']; ?>
"><?php echo $this->_tpl_vars['message']; ?>
</message>
</edit_controls>