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
 * @copyright (c) 2007-2008 Ibuildings.nl BV
 * @license http://www.achievo.org/atk/licensing ATK Open Source License
 *
 * @version $Revision: 6309 $
 * $Id: class.atkradiodetailsattribute.inc 6354 2009-04-15 02:41:21Z mvdam $
 */

/**
 * Displays radio buttons with options to choose from just like the
 * atkRadioAttribute but allows you to use other attributes for detail
 * selections once certain options are selected.
 *
 * @author Peter C. Verhage <peter@achievo.org>
 * @package atk
 * @subpackage attributes
 */
class atkRadioDetailsAttribute extends atkAttribute
{
  /**
   * Options
   *
   * @var array
   */
  protected $m_options;

  /**
   * Details.
   *
   * @var array
   */
  protected $m_details;

  /**
   * Constructor.
   *
   * Options can be an array using the following format:
   * array('option_a', 'option_b' => 'option_b_details')
   *
   * The options can either be specified as value (by not specifying a key)
   * or as key in which case you need to specify an attribute name as
   * value of another attribute which renders the detail selection for the
   * given option.
   *
   * @param string $name    attribute name
   * @param string $options can either be an array of values or a key/value
   *                        array in which case the key is used for the
   *                        translation and value is the value which is saved
   *                        in the database
   * @param array $details  allows you to specify attributes that should be
   *                        used for the detail selection for certain options
   *                        the key should be the option value and the value
   *                        should be the attribute name
   * @param int $flags
   */
  public function __construct($name, $options, $details, $flags=0)
  {
    parent::__construct($name, $flags);

    $this->m_options = isset($options[0]) ? array_combine($options, $options) : $options;

    // Cast single detail attributes to arrays
    foreach ($details as $value => $detail)
    {
      $this->m_details[$value] = (array)$detail;
    }
  }

  /**
   * Hide attributes that are used for the details because we are
   * going to render them inline.
   */
  public function postInit()
  {
    foreach (array_values($this->m_details) as $attrNames)
    {
      foreach($attrNames as $attrName)
      {
        if ($attrName != null)
        {
          $attr = $this->getOwnerInstance()->getAttribute($attrName);
          $attr->addDisabledMode(DISABLED_VIEW|DISABLED_EDIT);
        }
      }
    }
  }

  /**
   * Edit.
   *
   * @param array  $record
   * @param string $fieldprefix
   * @param string $mode
   */
  public function edit($record, $fieldprefix, $mode='add')
  {
    $this->getOwnerInstance()->getPage()->register_script(atkconfig('atkroot').'atk/javascript/class.'.strtolower(__CLASS__).'.js');

    $name = $fieldprefix.$this->fieldName();

    $result = '<div class="atkradiodetailsattribute-selection">';

    foreach ($this->m_options as $label => $value)
    {
      $isSelected = $record[$this->fieldName()] == $value;
      $checked = $isSelected ? ' checked="checked"' : '';
      $attrNames = @$this->m_details[$value];

      if ($attrNames != null)
      {
        $url = partial_url($this->getOwnerInstance()->atkNodeType(), $mode, 'attribute.'.$this->fieldName().'.details', array('value' => $value, 'fieldprefix' => $fieldprefix));
        $onChange = "ATK.RadioDetailsAttribute.select(this, '{$url}');";
      }
      else
      {
        $onChange = "ATK.RadioDetailsAttribute.select(this);";
      }

      $result .= '
        <input type="radio" class="atkradiodetailsattribute-option" name="'.$name.'" id="'.$name.'_'.$value.'" value="'.$value.'" onchange="'.$onChange.'"'.$checked.'/>
        <label for="'.$name.'_'.$value.'">'.$this->text($label).'</label><br/>
      ';

      if ($attrNames != null)
      {
        $result .= '<div id="'.$name.'_'.$value.'_details" class="atkradiodetailsattribute-details">';

        if ($isSelected)
        {
          foreach ($attrNames as $attrName)
          {
            $attr = $this->getOwnerInstance()->getAttribute($attrName);
            if (is_null($attr)) continue;

            $result .= '<blockquote>'.$attr->edit($record, $fieldprefix, $mode).'&nbsp;'.atk_htmlentities($attr->getLabel($record,$mode)).'</blockquote>';
          }
        }
        $result .= '</div>';
      }
    }

    $result .= '</div>';

    return $result;
  }
  
  /**
   * Display.
   * 
   * @param array $record The record that holds the value for this attribute
   * @param String $mode The display mode ("view" for viewpages, or "list"
   *                     for displaying in recordlists, "edit" for
   *                     displaying in editscreens, "add" for displaying in
   *                     add screens. "csv" for csv files. Applications can
   *                     use additional modes.
   * @return String HTML String
   */
  public function display($record, $mode='list')
  {
    $value = $record[$this->fieldName()];
    $options = array_flip($this->m_options);
    $result = atk_htmlentities($this->text($options[$value]));
    
    if ($mode == 'view')
    {
      $attrNames = @$this->m_details[$value];
      if ($attrNames != null)
      {
        foreach ($attrNames as $attrName)
        {
          $attr = $this->getOwnerInstance()->getAttribute($attrName);
          if (is_null($attr)) continue;
          
          $label = $attr->getLabel($record, $mode);
          $result .= '
            <blockquote>
              '.(!empty($label) ? atk_htmlentities($label).':' : '').'
              '.$attr->display($record, $mode).'
            </blockquote>';
        }
      }
    }
      
    return $result;
  }

  /**
   * Partial details
   *
   * @param string $mode
   * @return html code
   */
  public function partial_details($mode)
  {
    $fieldprefix = $this->getOwnerInstance()->m_postvars['fieldprefix'];
    $value = $this->getOwnerInstance()->m_postvars['value'];

    $attrNames = $this->m_details[$value];
    if (is_null($attrNames)) return '';

    $result = '';
    foreach ($attrNames as $attrName)
    {
      $attr = $this->getOwnerInstance()->getAttribute($attrName);
      if (is_null($attr)) continue;

      $result .= '<blockquote>'.$attr->edit(array(), $fieldprefix, $mode).'&nbsp;'.$attr->getLabel(array(),$mode).'</blockquote>';
    }

    return $result;
  }
}
