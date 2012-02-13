<?php /* Smarty version 2.6.11, created on 2011-12-09 18:46:16
         compiled from ./atk/themes/default/templates/statusbar.tpl */ ?>
<?php if (count ( $this->_tpl_vars['stacktrace'] ) || $this->_tpl_vars['lockstatus'] != "" || $this->_tpl_vars['helplink'] != ""): ?>
<table border="0" width="100%">
  <tr>
     <?php if (count ( $this->_tpl_vars['stacktrace'] )): ?>
     <td align="left" class="stacktrace">
        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['stacktrace']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
           <?php if ($this->_sections['i']['last']): ?>
             <span class="stacktrace_end"><?php echo $this->_tpl_vars['stacktrace'][$this->_sections['i']['index']]['title']; ?>
</span>
           <?php else: ?>           
             <a href="<?php echo $this->_tpl_vars['stacktrace'][$this->_sections['i']['index']]['url']; ?>
" class="stacktrace"><?php echo $this->_tpl_vars['stacktrace'][$this->_sections['i']['index']]['title']; ?>
</a> &raquo;
           <?php endif; ?>
        <?php endfor; endif; ?>
     </td>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['lockstatus'] != ""): ?><td align="right" class="lockstatus"><?php echo $this->_tpl_vars['lockstatus']; ?>
</td><?php endif; ?>
     <?php if ($this->_tpl_vars['helplink'] != ""): ?><td align="right" class="helplink"><?php echo $this->_tpl_vars['helplink']; ?>
</td><?php endif; ?>
  </tr>
</table>
<?php endif; ?>