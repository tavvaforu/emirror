<?php
  /**
   * This file is part of the Achievo ATK distribution.
   * Detailed copyright and licensing information can be found
   * in the doc/COPYRIGHT and doc/LICENSE files which should be
   * included in the distribution.
   *
   * @package atk
   * @subpackage attributes
   *
   * @copyright (c)2000-2004 Ibuildings.nl BV
   * @license http://www.achievo.org/atk/licensing ATK Open Source License
   *
   * @version $Revision: 2854 $
   * $Id: class.atkhtmlattribute.inc 6355 2009-04-21 15:20:09Z lineke $
   */

  // Load used attribute class
  useattrib("atktextattribute");

  /**
   * The atkHtmlAttribute class is the same as a normal atkAttribute. It only
   * (has a different display function. For this attribute, the value is
   * rendered as-is, which means you can use html codes in the text.
   *
   * There might me times where you want the user to be able to use html tags,
   * but you don't want to have the inconvenience of using br's for each line.
   * For this reason the constructor accepts a parameter which tells it to do
   * a newline-to-br conversion.
   *
   * @author Ivo Jansch <ivo@achievo.org>
   * @package atk
   * @subpackage attributes
   *
   */
  class atkHtmlAttribute extends atkTextAttribute
  {
    /**
     * New line to BR boolean
     */
    var $nl2br = false;

    /**
     * Constructor
     * @param string $name Name of the attribute
     * @param int $flags Flags of the attribute
     * @param bool $nl2br nl2br boolean
     */
    function atkHtmlAttribute($name, $flags=0, $nl2br = false)
    {
      $this->atkAttribute($name,$flags); // base class constructor
      $this->nl2br = $nl2br;
    }

    /**
     * Returns a displayable string for this value.
     * @param array $record Array wit fields
     * @return Formatted string
     */
    function display($record)
    {
      if ($this->nl2br) return nl2br($record[$this->fieldName()]);
      else return $record[$this->fieldName()];
    }
  }
?>
