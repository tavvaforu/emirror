<?php

  /**
   * This file is part of the Achievo ATK distribution.
   * Detailed copyright and licensing information can be found
   * in the doc/COPYRIGHT and doc/LICENSE files which should be
   * included in the distribution.
   *
   * @package atk
   * @subpackage include
   *
   * @copyright (c)2000-2004 Ibuildings.nl BV
   * @license http://www.achievo.org/atk/licensing ATK Open Source License
   *
   * @version $Revision: $
   * $Id: debugging.inc 6771 2010-03-12 09:44:28Z peter $
   */
  if (atk_value_in_array($GLOBALS['config_smart_debug']))
  {
    $GLOBALS['config_debug'] = atkConfig::smartDebugLevel($GLOBALS['config_debug'], $GLOBALS['config_smart_debug']);
  }

  if ($GLOBALS['config_debug'] > 0)
  {
    ini_set('display_errors', 1);
  }

  // show server info in debug (useful in clustered environments)
  atkdebug('Server info: '.$_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].')');

?>