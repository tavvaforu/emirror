<?php /* Smarty version 2.6.11, created on 2011-10-21 11:22:58
         compiled from ./atk/themes/basic/templates/list.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['formstart'] )):  echo $this->_tpl_vars['formstart'];  endif; ?>
<table border="0" cellspacing="0" cellpadding="2" width="100%">
  <?php if (( isset ( $this->_tpl_vars['header'] ) && ! empty ( $this->_tpl_vars['header'] ) )): ?>
  <tr>
    <td valign="top" align="left"><?php echo $this->_tpl_vars['header']; ?>
<br><br></td>
  </tr>
  <?php endif; ?>
  <?php if (( isset ( $this->_tpl_vars['index'] ) && ! empty ( $this->_tpl_vars['index'] ) )): ?>
  <tr>
    <td valign="top" align="left"><?php echo $this->_tpl_vars['index']; ?>
<br><br></td>
  </tr>
  <?php endif; ?>
  <?php if (( isset ( $this->_tpl_vars['navbar'] ) && ! empty ( $this->_tpl_vars['navbar'] ) )): ?>
  <tr>
    <td valign="top" align="left"><?php echo $this->_tpl_vars['navbar']; ?>
<br></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td valign="top" align="left"><?php echo $this->_tpl_vars['list']; ?>
<br></td>
  </tr>
  <?php if (( isset ( $this->_tpl_vars['navbar'] ) && ! empty ( $this->_tpl_vars['navbar'] ) )): ?>
  <tr>
    <td valign="top" align="left"><?php echo $this->_tpl_vars['navbar']; ?>
<br></td>
  </tr>
  <?php endif; ?>
  <?php if (( isset ( $this->_tpl_vars['footer'] ) && ! empty ( $this->_tpl_vars['footer'] ) )): ?>
  <tr>
    <td valign="top" align="left"><?php echo $this->_tpl_vars['footer']; ?>
<br></td>
  </tr>
  <?php endif; ?>
</table>
<?php if (isset ( $this->_tpl_vars['formstart'] )):  echo $this->_tpl_vars['formend'];  endif; ?>