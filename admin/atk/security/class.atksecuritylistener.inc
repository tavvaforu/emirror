<?php

  /**
   * This file is part of the Achievo ATK distribution.
   * Detailed copyright and licensing information can be found
   * in the doc/COPYRIGHT and doc/LICENSE files which should be
   * included in the distribution.
   *
   * @package atk
   * @subpackage security
   *
   * @copyright (c)2007 Ibuildings.nl BV
   * @license http://www.achievo.org/atk/licensing ATK Open Source License
   *
   * @version $Revision: 5798 $
   * $Id: class.atksecuritylistener.inc 6354 2009-04-15 02:41:21Z mvdam $
   */

  /**
   * ATK security listener.
   *
   * An instance of the ATK security listener can be registered as listener for the
   * ATK security manager. It will then be notified of successful logins and logouts.
   *
   * The following events are supported:
   *
   * preLogin:   This event is thrown just before the user get's authenticated.
   * postLogin:  This event is thrown just after the user is successfully authenticated.
   * preLogout:  This event is thrown just before the user get's logged out the system.
   * postLogout: This event is thrown just after the user is logged out the system.
   *
   * @author Peter C. Verhage <peter@ibuildings.nl>
   * @package atk
   * @subpackage security
   */
  class atkSecurityListener
  {
    /**
     * Handle event. In the default implementation, if a method exists with the same
     * name as the event this method will be called.
     *
     * @param string $event    event name
     * @param string $username user name
     */
    function handleEvent($event, $username)
    {
      if (method_exists($this, $event))
        $this->$event($username);
    }
  }
?>