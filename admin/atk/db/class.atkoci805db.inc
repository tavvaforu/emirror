<?php

  /**
   * This file is part of the Achievo ATK distribution.
   * Detailed copyright and licensing information can be found
   * in the doc/COPYRIGHT and doc/LICENSE files which should be 
   * included in the distribution.
   *
   * @package atk
   * @subpackage db
   *
   * @copyright (c)2000-2004 Ibuildings.nl BV
   * @license http://www.achievo.org/atk/licensing ATK Open Source License
   *
   * @version $Revision: 2609 $
   * $Id: class.atkoci805db.inc 6354 2009-04-15 02:41:21Z mvdam $
   */

  /**   
   * @internal Include baseclass
   */
  require_once(atkconfig("atkroot")."atk/db/class.atkoci8db.inc");

  /**
   * Oracle 8.0.5 database driver.
   *
   * Handles database connectivity and database interaction
   * with the Oracle database server version 8.0.5. 
   * (This class might also work with 8.0.x versions prior
   * to 8.0.5)
   *
   * @internal This class does not differ from its baseclass atkoci8db, but
   *           exists because the query builder class part of the driver does
   *           differ from the 8i version.
   *
   * @author Ivo Jansch <ivo@achievo.org>
   * @package atk
   * @subpackage db
   */
  class atkOci805Db extends atkOci8Db
  {    
    var $m_type = "oci805";
    
    /**
     * Base constructor
     */
    function atkOci805Db()
    {
       return $this->atkOci8Db();
    }    

  }

?>