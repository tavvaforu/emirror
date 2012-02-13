<?php /* Smarty version 2.6.11, created on 2011-12-03 15:03:59
         compiled from ./atk/themes/achievo_modern/templates/top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'atkconfig', './atk/themes/achievo_modern/templates/top.tpl', 1, false),array('function', 'atktext', './atk/themes/achievo_modern/templates/top.tpl', 6, false),)), $this); ?>
<?php echo smarty_function_atkconfig(array('var' => 'theme_logo','smartyvar' => 'theme_logo'), $this);?>

<div id="top">
  <img src="<?php echo $this->_tpl_vars['theme_logo']; ?>
" alt="Logo Achievo" />
  <div id="topLinks">
    <span id="top-center"><?php $_from = $this->_tpl_vars['centerpiece_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
 echo $this->_tpl_vars['link']; ?>
&nbsp;&nbsp;|&nbsp;&nbsp;<?php endforeach; endif; unset($_from); ?></span>
    <span id="top-logout"><a href="index.php?atklogout=1" target="<?php echo $this->_tpl_vars['logouttarget']; ?>
"><?php echo smarty_function_atktext(array('0' => 'logout'), $this);?>
</a></span>
    <?php if ($this->_tpl_vars['searchpiece']): ?>
    &nbsp;&nbsp;|&nbsp;&nbsp;<?php echo smarty_function_atktext(array('0' => 'search'), $this);?>
&nbsp;
    <span id="top-search"><?php echo $this->_tpl_vars['searchpiece']; ?>
</span>
    <?php endif; ?>
  </div>
  <div id="loginBox">
  <?php echo smarty_function_atktext(array('0' => 'logged_in_as'), $this);?>
: <?php echo $this->_tpl_vars['user']; ?>

  </div>
</div>