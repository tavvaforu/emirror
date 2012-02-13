<?php /* Smarty version 2.6.11, created on 2011-12-15 15:39:21
         compiled from ./atk/themes/default/templates/tabbededitform.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'atktext', './atk/themes/default/templates/tabbededitform.tpl', 7, false),)), $this); ?>
<table id="<?php echo $this->_tpl_vars['panename']; ?>
_editform" border="0">
  <?php if (( count ( $this->_tpl_vars['errors'] ) > 0 )): ?>
    <tr>
      <td colspan="2" class="error">
        <?php echo $this->_tpl_vars['errortitle']; ?>

        <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
          <br><?php echo $this->_tpl_vars['error']['label']; ?>
: <?php echo $this->_tpl_vars['error']['message']; ?>
 <?php if (isset ( $this->_tpl_vars['error']['tablink'] )): ?> (<?php echo smarty_function_atktext(array('0' => 'error_tab'), $this);?>
 <?php echo $this->_tpl_vars['error']['tablink']; ?>
)<?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
    <tr<?php if ($this->_tpl_vars['field']['rowid'] != ""): ?> id="<?php echo $this->_tpl_vars['field']['rowid']; ?>
"<?php endif;  if (! $this->_tpl_vars['field']['initial_on_tab']): ?> style="display: none"<?php endif; ?> class="<?php echo $this->_tpl_vars['field']['class']; ?>
">
      <?php if (isset ( $this->_tpl_vars['field']['line'] ) && $this->_tpl_vars['field']['line'] != ""): ?>
        <td colspan="2" valign="top" nowrap><?php echo $this->_tpl_vars['field']['line']; ?>
</td>
      <?php else: ?>
      <?php if ($this->_tpl_vars['field']['label'] !== 'AF_NO_LABEL'): ?><td valign="top" class="<?php if (isset ( $this->_tpl_vars['field']['error'] )): ?>errorlabel<?php else: ?>fieldlabel<?php endif; ?>"><?php if ($this->_tpl_vars['field']['label'] != ""):  echo $this->_tpl_vars['field']['label']; ?>
:  <?php if (isset ( $this->_tpl_vars['field']['obligatory'] )):  echo $this->_tpl_vars['field']['obligatory'];  endif;  endif; ?></td><?php endif; ?>
        <td valign="top" id="<?php echo $this->_tpl_vars['field']['id']; ?>
" <?php if ($this->_tpl_vars['field']['label'] === 'AF_NO_LABEL'): ?>colspan="2"<?php endif; ?> class="field"><?php echo $this->_tpl_vars['field']['full']; ?>
</td>
      <?php endif; ?>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>