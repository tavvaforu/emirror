<?php /* Smarty version 2.6.11, created on 2011-10-20 19:42:47
         compiled from ./atk/themes/default/templates/datagrid.tpl */ ?>
<table border="0" cellspacing="0" cellpadding="2">
<?php if (! empty ( $this->_tpl_vars['top'] )): ?>
<tr>
  <td align="left" valign="top" colspan="2">
    <?php echo $this->_tpl_vars['top']; ?>

  </td>
</tr>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['index'] ) || ! empty ( $this->_tpl_vars['editcontrol'] )): ?>
  <tr>
    <td align="left" valign="top">
      <?php if (! empty ( $this->_tpl_vars['editcontrol'] )):  echo $this->_tpl_vars['editcontrol'];  endif; ?> <?php if (! empty ( $this->_tpl_vars['index'] )):  echo $this->_tpl_vars['index'];  endif; ?>
    </td>
  </tr>
<?php elseif (! empty ( $this->_tpl_vars['paginator'] ) || ! empty ( $this->_tpl_vars['limit'] )): ?>
  <tr>
    <td align="left" valign="middle">
      <?php if (! empty ( $this->_tpl_vars['editcontrol'] )):  echo $this->_tpl_vars['editcontrol'];  endif; ?> <?php if (! empty ( $this->_tpl_vars['paginator'] )):  echo $this->_tpl_vars['paginator'];  endif; ?>
    </td>
    <td align="right" valign="middle">
      <?php if (! empty ( $this->_tpl_vars['limit'] )):  echo $this->_tpl_vars['limit'];  endif; ?>
    </td>
  </tr>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['list'] )): ?>
<tr>
  <td align="left" valign="top" colspan="2">
    <?php echo $this->_tpl_vars['list']; ?>

  </td>
</tr>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['norecordsfound'] )): ?>
  <tr>
    <td align="left" valign="top">
      <i><?php echo $this->_tpl_vars['norecordsfound']; ?>
</i>
    </td>
  </tr>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['paginator'] ) || ! empty ( $this->_tpl_vars['summary'] )): ?>
  <tr>
    <td align="left" valign="middle">
      <?php if (! empty ( $this->_tpl_vars['paginator'] )):  echo $this->_tpl_vars['paginator'];  endif; ?>
    </td>
    <td align="right" valign="middle">
      <?php if (! empty ( $this->_tpl_vars['summary'] )):  echo $this->_tpl_vars['summary'];  endif; ?>
    </td>
  </tr>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['bottom'] )): ?>
<tr>
  <td align="left" valign="top" colspan="2">
    <?php echo $this->_tpl_vars['bottom']; ?>

  </td>
</tr>
<?php endif; ?>
</table>