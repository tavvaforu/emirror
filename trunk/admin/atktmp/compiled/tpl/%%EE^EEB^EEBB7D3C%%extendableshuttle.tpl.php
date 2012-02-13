<?php /* Smarty version 2.6.11, created on 2011-10-16 19:41:59
         compiled from ./atk/themes/default/templates/extendableshuttle.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'atktext', './atk/themes/default/templates/extendableshuttle.tpl', 17, false),array('modifier', 'atk_htmlentities', './atk/themes/default/templates/extendableshuttle.tpl', 21, false),)), $this); ?>
<table class="shuttleTable">
<tr>
  <td>
    <?php $_from = $this->_tpl_vars['ava_controls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['control']):
?>
      <?php echo $this->_tpl_vars['control']; ?>

    <?php endforeach; endif; unset($_from); ?>
  </td>
  <td>&nbsp;</td>
  <td>
    <?php $_from = $this->_tpl_vars['sel_controls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['control']):
?>
      <?php echo $this->_tpl_vars['control']; ?>

    <?php endforeach; endif; unset($_from); ?>
  </td>
</tr>
<tr>
  <td>
    <?php echo smarty_function_atktext(array('0' => 'available'), $this);?>
:<br/>
    <div id="<?php echo $this->_tpl_vars['htmlid']; ?>
_available">
      <select class="shuttle_select" id="<?php echo $this->_tpl_vars['leftname']; ?>
" name="<?php echo $this->_tpl_vars['leftname']; ?>
" multiple size="10" onDblClick="shuttle_move('<?php echo $this->_tpl_vars['leftname']; ?>
','<?php echo $this->_tpl_vars['rightname']; ?>
','add','<?php echo $this->_tpl_vars['htmlid']; ?>
[selected][][<?php echo $this->_tpl_vars['remotekey']; ?>
]');<?php echo $this->_tpl_vars['htmlid']; ?>
_onChange('selected');">
        <?php $_from = $this->_tpl_vars['available_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['option']):
?>
          <option value="<?php echo $this->_tpl_vars['key']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['option'])) ? $this->_run_mod_handler('atk_htmlentities', true, $_tmp) : atk_htmlentities($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['option'])) ? $this->_run_mod_handler('atk_htmlentities', true, $_tmp) : atk_htmlentities($_tmp)); ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
    </div>
  </td>
  <td valign="center" align="center">
    <input type="button" value="&gt;"     onClick="shuttle_move   ('<?php echo $this->_tpl_vars['leftname']; ?>
', '<?php echo $this->_tpl_vars['rightname']; ?>
', 'add', '<?php echo $this->_tpl_vars['name']; ?>
'); <?php echo $this->_tpl_vars['htmlid']; ?>
_onChange('selected');"><br/>
    <input type="button" value="&lt;"     onClick="shuttle_move   ('<?php echo $this->_tpl_vars['rightname']; ?>
', '<?php echo $this->_tpl_vars['leftname']; ?>
', 'del', '<?php echo $this->_tpl_vars['name']; ?>
'); <?php echo $this->_tpl_vars['htmlid']; ?>
_onChange('available');"><br/><br/>
    <input type="button" value="&gt;&gt;" onClick="shuttle_moveall('<?php echo $this->_tpl_vars['leftname']; ?>
', '<?php echo $this->_tpl_vars['rightname']; ?>
', 'add', '<?php echo $this->_tpl_vars['name']; ?>
'); <?php echo $this->_tpl_vars['htmlid']; ?>
_onChange('selected');"><br/>
    <input type="button" value="&lt;&lt;" onClick="shuttle_moveall('<?php echo $this->_tpl_vars['rightname']; ?>
', '<?php echo $this->_tpl_vars['leftname']; ?>
', 'del', '<?php echo $this->_tpl_vars['name']; ?>
'); <?php echo $this->_tpl_vars['htmlid']; ?>
_onChange('available');">
  </td>
  <td>
    <?php echo smarty_function_atktext(array('0' => 'selected'), $this);?>
:<br/>
    <div id="<?php echo $this->_tpl_vars['htmlid']; ?>
_selected">
      <select class="shuttle_select" id="<?php echo $this->_tpl_vars['rightname']; ?>
" name="<?php echo $this->_tpl_vars['rightname']; ?>
" multiple size="10" onDblClick="shuttle_move('<?php echo $this->_tpl_vars['rightname']; ?>
','<?php echo $this->_tpl_vars['leftname']; ?>
','del','<?php echo $this->_tpl_vars['htmlid']; ?>
[selected][][<?php echo $this->_tpl_vars['remotekey']; ?>
]');<?php echo $this->_tpl_vars['htmlid']; ?>
_onChange('available');">
        <?php $_from = $this->_tpl_vars['selected_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['option']):
?>
          <option value="<?php echo $this->_tpl_vars['key']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['option'])) ? $this->_run_mod_handler('atk_htmlentities', true, $_tmp) : atk_htmlentities($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['option'])) ? $this->_run_mod_handler('atk_htmlentities', true, $_tmp) : atk_htmlentities($_tmp)); ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
    </div>
  </td>
</tr>
</table>

<input type="hidden" id="<?php echo $this->_tpl_vars['name']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
" value=<?php echo $this->_tpl_vars['value']; ?>
 />
<input type="hidden" id="<?php echo $this->_tpl_vars['htmlid']; ?>
[section]" name="<?php echo $this->_tpl_vars['htmlid']; ?>
[section]" />