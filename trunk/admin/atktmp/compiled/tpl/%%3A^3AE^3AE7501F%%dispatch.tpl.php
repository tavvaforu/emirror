<?php /* Smarty version 2.6.11, created on 2011-12-03 17:05:46
         compiled from ./atk/themes/achievo_modern/templates/dispatch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'atkthemeimg', './atk/themes/achievo_modern/templates/dispatch.tpl', 2, false),)), $this); ?>
<div class="box-dispatch">
<div class="box-dispatch-title"><span class="tableHeaderTitle"><?php echo $this->_tpl_vars['title']; ?>
<span style="visibility: hidden" id="atkbusy"><img src="<?php echo smarty_function_atkthemeimg(array('0' => "spinner.gif"), $this);?>
" /></span></span><img src="<?php echo smarty_function_atkthemeimg(array('0' => "tabRight.gif"), $this);?>
" alt="tabend"></div>
<div class="box-dispatch-content"><?php echo $this->_tpl_vars['content']; ?>
</div>
</div>