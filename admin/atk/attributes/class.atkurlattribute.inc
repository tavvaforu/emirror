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
   * @copyright (c)2006 Ibuildings.nl BV
   * @license http://www.achievo.org/atk/licensing ATK Open Source License
   *
   * @version $Revision: 4200 $
   * $Id: class.atkurlattribute.inc 6422 2009-07-09 11:54:46Z martin $
   */

  /**
   * Add one space after each "/", "?" and "&" to fit a (long) url into <td></td>.
   */
  define('AF_URL_ALLOWWRAP', AF_SPECIFIC_1);

  /**
   * Don't display "http://". Link remains intact.
   */
  define('AF_URL_STRIPHTTP', AF_SPECIFIC_2);

  /**
   * Check if URL is a valid absolute URL
   */
  define('ABSOLUTE', 1);

  /**
   * Check if URL is a valid relative URL
   */
  define('RELATIVE', 2);

  /**
   * Check if URL is a valid anchor
   */
  define('ANCHOR',   4);


  /**
   * The atkUrlAttribute class represents a field containing URLs.
   *
   * @author Przemek Piotrowski <przemek.piotrowski@nic.com.pl>
   * @author Jeroen van Sluijs <jeroenvs@ibuildings.nl>
   *
   * @package atk
   * @subpackage attributes
   */
  class atkUrlAttribute extends atkAttribute
  {
    var $m_accepts_url_flag = 0;

    var $m_newWindow = false;
    var $m_allowWrap = false;
    var $m_stripHttp = false;

    /**
     * base url. Set it by
     * calling setBaseUrl()
     * on the attribute.
     *
     * @var string
     */
    public $m_baseUrl = null;

    /**
     * The atk url attribute
     *
     * @param String $name Name of the attribute (unique within a node, and
     *                     for most attributes, corresponds to a field in
     *                     the database.
     * @param int $flags Flags for the attribute.
     * @param mixed $size  The size(s) of the attribute. See the $size
     *                     parameter of the setAttribSize() method for more
     *                     information on the possible values of this
     *                     parameter.
     * @return atkUrlAttribute
     */
    function atkUrlAttribute($name, $flags = 0, $size=0)
    {
      if (AF_POPUP === ($flags & AF_POPUP))
      {
        $this->m_newWindow = true;
        $flags &= (~ AF_POPUP);
      }

      if (AF_URL_ALLOWWRAP === ($flags & AF_URL_ALLOWWRAP))
      {
        $this->m_allowWrap = true;
        $flags &= (~ AF_URL_ALLOWWRAP);
      }

      if (AF_URL_STRIPHTTP === ($flags & AF_URL_STRIPHTTP))
      {
        $this->m_stripHttp = true;
        $flags &= (~ AF_URL_STRIPHTTP);
      }

      $this->atkAttribute($name, $flags, $size);
    }

    /**
     * Returns a displayable string for this value, to be used in HTML pages.
     *
     * @param array $record The record that holds the value for this attribute
     * @param String $mode The display mode ("view" for viewpages, or "list"
     *                     for displaying in recordlists, "edit" for
     *                     displaying in editscreens, "add" for displaying in
     *                     add screens. "csv" for csv files. Applications can
     *                     use additional modes.
     * @return String HTML String
     */
    function display($record, $mode="")
    {
      $output = '';

      if (!empty($record[$this->fieldName()])) {
        $url = $record[$this->fieldName()];

        $target = '';
        if (true === $this->m_newWindow) {
          $target = ' target="_new"';
        }

        /**
         * prepend a custom hostname to make the link
         * go to a custom domain. But only when you are using relative
         * urls.
         */
        if(($this->getBaseUrl()) && (($this->m_accepts_url_flag & RELATIVE) == RELATIVE)) {
          $base = $this->getBaseUrl();
          $url = $base . $url;
        }

        $text = $record[$this->fieldName()];
        if (true === $this->m_stripHttp) {
          $text = preg_replace('/^http:\/\//', '', $text);
        }
        if (true === $this->m_allowWrap) {
          $text = preg_replace('/([^\/?])\/([^\/?])/', '\1/ \2', $text);
          $text = preg_replace('/([?&].)/', ' \1', $text);
        }

        $output = '<a href="' . $url . '"' . $target . '">' . $text . '</a>';
      }

      return $output;
    }

    /**
     * Return the base url (if set)
     */
    public function getBaseUrl()
    {
      return $this->m_baseUrl;
    }

    /**
     * Set the base url to
     * help the display function
     * set the correct domain
     *
     * @param string $baseUrl http://my.domain.com
     */
    public function setBaseUrl($baseUrl)
    {
      $this->m_baseUrl = $baseUrl;
    }

    /**
     * Specify which URL-types are allowed
     *
     * Example: acceptUrls(ABSOLUTE) - only absolute are accepted
     *          acceptUrls(ABSOLUTE|ANCHOR) - accept absolute URL's, anchors and an absolute URL followed by an anchor
     *
     * @param int $accepts_flag
     */
    function acceptUrls($accepts_flag)
    {
      $this->m_accepts_url_flag = $accepts_flag;
    }

    /**
     * Checks if a value is valid.
     *
     * @param array $record The record that holds the value for this
     *                      attribute. If an error occurs, the error will
     *                      be stored in the 'atkerror' field of the record.
     * @param String $mode The mode for which should be validated ("add" or
     *                     "update")
     */
    function validate(&$record, $mode)
    {
       $this->validateUrl($record, $mode, true);
    }

    /**
     * Validates absolute, relative and anchor URL through regular expression
     *
     * @param array $record Record that contains value to be validated.
     *                      Errors are saved in this record, in the 'atkerror'
     *                      field.
     * @param String $mode Validation mode. Can be either "add" or "update"
     * @param boolean $show_error fire a triggerError when validation fails
     */
    function validateUrl(&$record, $mode, $show_error=false)
    {
      $result = false;

      $absolute_result = true;
      $anchor_result = true;
      $absolute_anchor_result = true;
      $relative_result = true;

      $base_url_regex                 = "(ft|htt)ps?:\/\/[a-zA-Z0-9\.\-\_]+\.[a-zA-Z]{2,4}";
      $relative_url_regex             = "[a-zA-Z0-9\.\-\_\/?&=%]";
      $relative_url_regex_with_anchor = "[a-zA-Z0-9\.\-\_\/?&=%#]";


     /**
      * Validate URL, check if format is absolute (external URL's) and has no anchor
      *
      * Example: http://www2-dev.test_url.com
      * or:      ftp://www2-dev.test_url.com/index.php?/feeds/index.rss2
      */
      if (($this->m_accepts_url_flag & ABSOLUTE) == ABSOLUTE)
      {
        $absolute_result = preg_match("/^".$base_url_regex.$relative_url_regex."*$/Ui", $record[$this->fieldName()])?true:false;

        $result = $result || $absolute_result;
      }

     /**
      * Validate URL, check if format is a valid anchor
      *
      * Example: #internal_bookmark
      */
      if (($this->m_accepts_url_flag & ANCHOR) == ANCHOR)
      {
        $anchor_result = preg_match("/^#".$relative_url_regex."*$/Ui", $record[$this->fieldName()])?true:false;

        $result = $result || $anchor_result;
      }

     /**
      * Validate URL, check if format is absolute (external URL's) and has (optional) anchor
      *
      * Example: http://www2-dev.test_url.com
      * or:      ftp://www2-dev.test_url.com/index.php?/feeds/index.rss2
      * or:      https://www2-dev.test_url.com/index.php?/history.html#bookmark
      */
      if ((($this->m_accepts_url_flag & ABSOLUTE) == ABSOLUTE) && (($this->m_accepts_url_flag & ANCHOR) == ANCHOR))
      {
        $absolute_anchor_result = preg_match("/^".$base_url_regex.$relative_url_regex_with_anchor."*$/Ui", $record[$this->fieldName()])?true:false;

        $result = $result || $absolute_anchor_result;
      }

     /**
      * Validate URL, check if format is relative
      *
      * Example: /mysite/guestbook/index.html
      */
      if (($this->m_accepts_url_flag & RELATIVE) == RELATIVE)
      {
        $relative_result = preg_match("/^".$relative_url_regex_with_anchor."+$/Ui", $record[$this->fieldName()])?true:false;

        $result = $result || $relative_result;
      }


      /**
       * If an error occured, show applicable message(s)
       */
      if (!$result && $show_error)
      {
        // if result of all validations is false, display error-messages
        if ($absolute_result === false)        triggerError($record, $this->fieldName(), 'invalid_absolute_no_anchor_url', atktext('invalid_absolute_no_anchor_url'));
        if ($anchor_result === false)          triggerError($record, $this->fieldName(), 'invalid_url_anchor',             atktext('invalid_url_anchor'));
        if ($absolute_anchor_result === false) triggerError($record, $this->fieldName(), 'invalid_absolute_url',           atktext('invalid_absolute_url'));
        if ($relative_result === false)        triggerError($record, $this->fieldName(), 'invalid_relative_url',           atktext('invalid_relative_url'));
      }
      return ($result||parent::validate($record, $mode));
    }
  }
?>
