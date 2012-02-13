<?php /* Smarty version 2.6.11, created on 2011-12-15 15:39:21
         compiled from ./atk/themes/default/templates/panetabs.tpl */ ?>
<div id="<?php echo $this->_tpl_vars['paneName']; ?>
" class="tabbedPane">
  <table border="0" cellpadding="0" cellspacing="0" align="left" valign="top">
    <tr>
      <td width="100%" align="left">
        <br />
  	    <table border="0" cellpadding="0" cellspacing="0" class="tabsTabs">
          <tr>                              
            <?php $_from = $this->_tpl_vars['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tabName'] => $this->_tpl_vars['tab']):
?>
              <td class="<?php echo $this->_tpl_vars['tabName']; ?>
 tabbedPaneTab <?php if ($this->_tpl_vars['tab']['selected']): ?>activetab<?php else: ?>passivetab<?php endif; ?>" valign="middle" align="left" nowrap="nowrap">	
                <a href="javascript:void(0)" onclick="ATK.TabbedPane.showTab('<?php echo $this->_tpl_vars['paneName']; ?>
', '<?php echo $this->_tpl_vars['tabName']; ?>
'); return false;"><?php echo $this->_tpl_vars['tab']['title']; ?>
</a>
              </td>          
              <td>&nbsp;</td>
            <?php endforeach; endif; unset($_from); ?>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="5" width="100%" class="tabsContent">
          <tr>
            <td>
              <?php echo $this->_tpl_vars['content']; ?>

            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>