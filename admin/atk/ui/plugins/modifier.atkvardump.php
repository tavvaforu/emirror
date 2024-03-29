<?php

  /**
   * This file is part of the Achievo ATK distribution.
   * Detailed copyright and licensing information can be found
   * in the doc/COPYRIGHT and doc/LICENSE files which should be
   * included in the distribution.
   *
   * @package atk
   * @subpackage ui
   *
   * @copyright (c)2007 Ibuildings.nl
   * @license http://www.achievo.org/atk/licensing ATK Open Source License
   *
   * @version $Revision: 5230 $
   * $Id: modifier.atkvardump.php 6354 2009-04-15 02:41:21Z mvdam $
   */

  /**
   * Dump variable to debug output
   *
   * Usage: {$sometplvar|atkvardump:label}
   * @author Boy Baukema <boy@ibuildings.nl>
   *
   * @param mixed $data
   * @param String $name Label for the dump
   * @return String
   */
  function smarty_modifier_atkvardump($data,$name='')
  {
    atk_var_dump($data,$name);
    return $data;
  }

?>