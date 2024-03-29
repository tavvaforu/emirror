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
   * $Id: errorhandler.inc 6609 2010-01-02 19:46:26Z peter $
   */

  set_error_handler('atkErrorHandler');
  error_reporting(E_ALL);
  
  set_exception_handler('atkExceptionHandler');

?>