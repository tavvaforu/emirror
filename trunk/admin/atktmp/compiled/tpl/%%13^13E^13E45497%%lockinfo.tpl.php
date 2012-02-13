<?php /* Smarty version 2.6.11, created on 2011-12-09 18:45:58
         compiled from ./atk/themes/default/templates/lockinfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'atktext', './atk/themes/default/templates/lockinfo.tpl', 2, false),array('modifier', 'strtotime', './atk/themes/default/templates/lockinfo.tpl', 4, false),array('modifier', 'atkFormatDate', './atk/themes/default/templates/lockinfo.tpl', 6, false),)), $this); ?>
<div style="background-color: #FEFCD1; padding: 2px; border: 1px solid #666; color: #000; font: 11px arial, helvetica">
<strong><?php echo smarty_function_atktext(array('0' => 'in_use_by'), $this);?>
:</strong><br/>
<?php $_from = $this->_tpl_vars['locks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lock']):
?>
  <?php $this->assign('stamp', ((is_array($_tmp=$this->_tpl_vars['lock']['lock_stamp'])) ? $this->_run_mod_handler('strtotime', true, $_tmp) : strtotime($_tmp))); ?>
  <?php ob_start();  echo smarty_function_atktext(array('0' => 'date_format_view'), $this);?>
 H:i<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('format', ob_get_contents());ob_end_clean(); ?>
  <?php ob_start();  echo ((is_array($_tmp=$this->_tpl_vars['stamp'])) ? $this->_run_mod_handler('atkFormatDate', true, $_tmp, $this->_tpl_vars['format']) : atkFormatDate($_tmp, $this->_tpl_vars['format']));  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('date', ob_get_contents());ob_end_clean(); ?>
  <?php echo smarty_function_atktext(array('0' => 'lock_info_line','user_id' => $this->_tpl_vars['lock']['user_id'],'user_ip' => $this->_tpl_vars['lock']['user_ip'],'lock_date' => $this->_tpl_vars['date']), $this);?>
<br/>
<?php endforeach; endif; unset($_from); ?>
</div>