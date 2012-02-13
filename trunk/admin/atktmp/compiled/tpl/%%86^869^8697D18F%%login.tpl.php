<?php /* Smarty version 2.6.11, created on 2011-12-01 12:08:53
         compiled from ./atk/themes/achievo_modern/templates/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'atkthemeimg', './atk/themes/achievo_modern/templates/login.tpl', 7, false),array('function', 'atktext', './atk/themes/achievo_modern/templates/login.tpl', 15, false),)), $this); ?>
<?php echo '
<style type="text/css">
body
{
'; ?>

	padding: 24px;
	background: #fff url(<?php echo smarty_function_atkthemeimg(array('0' => "bodyPattern.gif"), $this);?>
) repeat left top;
<?php echo '
}
</style>
'; ?>


<div id='loginform' style="background: #EBEBEB url(<?php echo smarty_function_atkthemeimg(array('0' => "logoGrijs.png"), $this);?>
) no-repeat 40px 20px;">
<form action="<?php echo $this->_tpl_vars['formurl']; ?>
" method="post">
  <div id="loginform-title"><?php echo smarty_function_atktext(array('0' => 'login_form'), $this);?>
</div>
  <div id="loginform-content">
  <?php if (isset ( $this->_tpl_vars['auth_max_loginattempts_exceeded'] )): ?>
    <?php echo $this->_tpl_vars['auth_max_loginattempts_exceeded']; ?>

  <?php else: ?>
    <?php echo $this->_tpl_vars['atksessionformvars']; ?>

    <?php if (isset ( $this->_tpl_vars['auth_mismatch'] )):  echo $this->_tpl_vars['auth_mismatch']; ?>
<br><?php endif; ?>
    <?php if (isset ( $this->_tpl_vars['auth_account_locked'] )):  echo $this->_tpl_vars['auth_account_locked']; ?>
<br><?php endif; ?>
    <table cellpadding="0" cellspacing="0" border="0"><tr>
    <td class="loginformLabel"><?php echo smarty_function_atktext(array('0' => 'username'), $this);?>
:</td><td class="loginformField"><?php echo $this->_tpl_vars['userfield']; ?>
</td>
    </tr><tr>
    <td class="loginformLabel"><?php echo smarty_function_atktext(array('0' => 'password'), $this);?>
:</td><td class="loginformField"><input class="loginform" type="password" size="15" name="auth_pw" value=""></td>
    </tr><tr>
    <td class="loginformLabel"></td><td>
    <input name="login" class="button" type="submit" value="<?php echo smarty_function_atktext(array('0' => 'login'), $this);?>
">
    <?php if ($this->_tpl_vars['auth_enablepasswordmailer']): ?><input name="login" class="button" type="submit" value="<?php echo smarty_function_atktext(array('0' => 'password_forgotten'), $this);?>
"><?php endif; ?>
    </td>
    </tr></table>
  <?php endif; ?>
  </div>
</form>
</div>