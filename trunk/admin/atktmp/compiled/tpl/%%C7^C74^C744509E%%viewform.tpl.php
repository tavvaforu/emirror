<?php /* Smarty version 2.6.11, created on 2011-11-21 17:13:53
         compiled from ./atk/themes/default/templates/viewform.tpl */ ?>
<table width="100%">
  <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
    <tr<?php if ($this->_tpl_vars['field']['rowid'] != ""): ?> id="<?php echo $this->_tpl_vars['field']['rowid']; ?>
"<?php endif;  if (! $this->_tpl_vars['field']['initial_on_tab']): ?> style="display: none"<?php endif; ?> class="<?php echo $this->_tpl_vars['field']['class']; ?>
">
      <?php if (isset ( $this->_tpl_vars['field']['line'] )): ?>
        <td colspan="2" valign="top" class="field"><?php echo $this->_tpl_vars['field']['line']; ?>
</td>
      <?php else: ?>
        <?php if ($this->_tpl_vars['field']['label'] !== 'AF_NO_LABEL'): ?><td valign="top" class="fieldlabel"><?php if ($this->_tpl_vars['field']['label'] != ""):  echo $this->_tpl_vars['field']['label']; ?>
: <?php endif; ?></td><?php endif; ?>
        <td valign="top" class="field" <?php if ($this->_tpl_vars['field']['label'] === 'AF_NO_LABEL'): ?>colspan="2"<?php endif; ?>><?php echo $this->_tpl_vars['field']['full']; ?>
</td>
      <?php endif; ?>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>