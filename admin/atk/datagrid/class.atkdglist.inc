<?php
/**
 * This file is part of the Achievo ATK distribution.
 * Detailed copyright and licensing information can be found
 * in the doc/COPYRIGHT and doc/LICENSE files which should be
 * included in the distribution.
 *
 * @package atk
 * @subpackage utils
 *
 * @copyright (c) 2000-2007 Ibuildings.nl BV
 *
 * @license http://www.achievo.org/atk/licensing ATK Open Source License
 */

/**
 * The data grid list component renders the recordlist.
 *
 * Options:
 * - alwaysShowGrid: always show datagrid, even if there are no records?
 *                   by default the grid won't display the grid headers
 *                   in embedded mode when there are no existing records
 *
 * @author Peter C. Verhage <peter@achievo.org>
 * @package atk
 * @subpackage datagrid
 *
 * @todo At the moment the grid component is based on atkRecordList legacy code. This code
 *       should be refactored / optimized but this also means that some backwards incompatible
 *       changes have to be made to the differen ATK attributes. For example, the component
 *       still uses the recordlist flags when calling attribute methods because the attributes
 *       are not 100% aware yet of the new datagrid.
 *
 * @todo Keyboard navigation is at the moment broken because we don't supply the navigation array.
 *       However, this should be done in a different way anyhow.
 */
class atkDGList extends atkDGComponent
{
  protected $m_hasActionColumn = null;

  /**
   * Render the list.
   *
   * @return string rendered list HTML
   */
  public function render()
  {
    $alwaysShowGrid = $this->getOption('alwaysShowGrid', false);

    if (!$alwaysShowGrid &&
        $this->getGrid()->isEmbedded() &&
        !$this->getGrid()->isUpdate() &&
        count($this->getGrid()->getRecords()) == 0)
    {
        return '';
    }

    $grid = $this->getGrid();
    $data = $this->getRecordlistData($grid->getRecords(), $grid->getDefaultActions(), $grid->getExcludes());
    $ui = $grid->getNode()->getUi();
    return $ui->render($grid->getNode()->getTemplate("admin"), $data, $grid->getNode()->m_module);
  }

  /**
   * Get records for a recordlist without actually rendering the recordlist.
   * @param atkNode $node                   the atknode of the grid
   * @param Array   $recordset    the list of records
   * @param Array   $actions      the default actions array
   * @param Integer $flags        recordlist flags (see the top of this file)
   * @param Array   $suppressList fields we don't display
   * @return String The rendered recordlist
   */
  private function getRecordlistData($recordset, $actions, $suppressList="")
  {
    $grid = $this->getGrid();
    $theme = $this->getTheme();
    $page = $this->getPage();

    $edit = $grid->isEditing();

    $page->register_style($theme->stylePath("recordlist.css",$grid->getNode()->m_module));
    $page->register_script(atkconfig("atkroot")."atk/javascript/recordlist.js");

    $listName = $grid->getName();

    $defaulthighlight = $theme->getAttribute("highlight");
    $selectcolor = $theme->getAttribute("select");

    /* retrieve list array */
    $list = $this->listArray($recordset, "", $actions, $suppressList);

    /* Check if some flags are still valid or not... */
    $hasMRA = $grid->hasFlag(atkDataGrid::MULTI_RECORD_ACTIONS);
    if ($hasMRA && (count($list["mra"]) == 0 || count($list["rows"]) == 0))
    {
      $hasMRA = false;
    }

    $hasSearch = $grid->hasFlag(atkDataGrid::SEARCH) && !$grid->isEditing() ;
    if ($hasSearch && count($list["search"]) == 0)
    {
      $hasSearch = false;
    }

    if ($grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS) && (count($grid->getNode()->m_priority_actions) == 0 || count($list["rows"]) == 0))
    {
      $grid->removeFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS);
    }
    else if ($grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS))
    {
      $grid->removeFlag(atkDataGrid::MULTI_RECORD_ACTIONS);
      if ($grid->getNode()->m_priority_max == 0)
        $grid->getNode()->m_priority_max = $grid->getNode()->m_priority_min + count($list["rows"]) - 1;
    }

    $hasActionCol = $this->_hasActionColumn($list, $hasSearch);

    $orientation  = atkconfig('recordlist_orientation', $theme->getAttribute("recordlist_orientation"));
    $vorientation = trim(atkconfig('recordlist_vorientation', $theme->getAttribute("recordlist_vorientation")));

    /**************/
    /* HEADER ROW */
    /**************/
    $headercols = array();

    if ($hasActionCol && count($list["rows"]) == 0)
    {
      if ($orientation == "left" || $orientation == "both")
      {
        // empty cell above search button, if zero rows
        // if $orientation is empty, no search button is shown, so no empty cell is needed
        $headercols[] = array("content"=>"&nbsp;");
      }
    }

    if (!$edit && ($hasMRA || $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS)))
    {
      $headercols[] = array("content"=>""); // Empty leader on top of mra action list.
    }
    if ($grid->hasFlag(atkDataGrid::LOCKING))
    {
      $lockHeadIcon = atkTheme::getInstance()->iconPath('lock_'.$grid->getNode()->getLockMode().'_head', 'lock', $grid->getNode()->m_module);
      $headercols[] = array("content"=>'<img src="'.$lockHeadIcon.'">');
    }
    if (($orientation == "left" || $orientation == "both") && ($hasActionCol && count($list["rows"]) > 0))
    {
      $headercols[] = array("content"=>"");
    }

    foreach (array_values($list["heading"]) as $head)
    {
      if (!$grid->hasFlag(atkDataGrid::SORT) || empty($head["order"]))
      {
        $headercols[] = array("content"=>$head["title"]);
      }
      else
      {
        $call = atk_htmlentities($grid->getUpdateCall(array('atkorderby' => $head['order'], 'atkstartat' => 0)));
        $link = '<a href="javascript:void(0)" onclick="'.$call.'">'.$head["title"].'</a>';
        $headercols[] = array("content" => $link);
      }
    }

    if (($orientation == "right" || $orientation == "both") && ($hasActionCol && count($list["rows"]) > 0))
    {
      $headercols[] = array("content"=>"");
    }

    if ($hasActionCol && count($list["rows"]) == 0)
    {
      if ($orientation == "right" || $orientation == "both")
      {
        // empty cell above search button, if zero rows
        // if $orientation is empty, no search button is shown, so no empty cell is needed
        $headercols[] = array("content"=>"&nbsp;");
      }
    }


    /**************/
    /* SORT   ROW */
    /**************/
    $sortcols = array();
    $sortstart="";
    $sortend="";
    if ($grid->hasFlag(atkDataGrid::EXTENDED_SORT))
    {
      $call = atk_htmlentities($grid->getUpdateCall(array('atkstartat' => 0), array(), 'ATK.DataGrid.extractExtendedSortOverrides'));
      $button = '<input type="button" value="'.atktext("sort").'" onclick="'.$call.'">';

      if (!$edit && ($hasMRA || $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS)))
      {
        $sortcols[] = array("content"=>""); // Empty leader on top of mra action list.
      }
      if ($grid->hasFlag(atkDataGrid::LOCKING))
      {
        $sortcols[] = array("content"=>"");
      }
      if ($orientation == "left" || $orientation == "both")
      {
        $sortcols[] = array("content"=>$button);
      }

      foreach (array_keys($list["heading"]) as $key)
      {
        if (isset($list["sort"][$key])) $sortcols[] = array("content"=>$list["sort"][$key]);
      }

      if ($orientation == "right" || $orientation == "both")
      {
        $sortcols[] = array("content"=>$button);
      }
    }

    /**************/
    /* SEARCH ROW */
    /**************/

    $searchcols = array();
    $searchstart="";
    $searchend="";
    if ($hasSearch)
    {
      $call = atk_htmlentities($grid->getUpdateCall(array('atkstartat' => 0), array(), 'ATK.DataGrid.extractSearchOverrides'));
      $buttonType = $grid->isEmbedded() ? "button" : "submit";
      $button = '<input type="'.$buttonType.'" class="btn_search" value="'.atktext("search").'" onclick="'.$call.' return false;">';
      if ($grid->hasFlag(atkDataGrid::EXTENDED_SEARCH))
      {
        $button .= '<br>'.href(atkSelf()."?atknodetype=".$grid->getActionNode()->atkNodeType()."&atkaction=".$grid->getActionNode()->getExtendedSearchAction(),"(".atktext("search_extended").")",SESSION_NESTED);
      }

     // $searchstart = '<a name="searchform"></a>';
     $searchstart = "";

      if (!$edit && ($hasMRA || $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS)))
      {
        $searchcols[] = array("content"=>"");
      }
      if ($grid->hasFlag(atkDataGrid::LOCKING))
      {
        $searchcols[] = array("content"=>"");
      }
      if ($orientation == "left" || $orientation == "both")
      {
        $searchcols[] = array("content"=>$button);
      }

      foreach (array_keys($list["heading"]) as $key)
      {
        if (isset($list["search"][$key]))
        {
          $searchcols[] = array("content"=>$list["search"][$key]);
        }
        else
        {
          $searchcols[] = array("content"=>"");
        }
      }
      if ($orientation == "right" || $orientation == "both")
      {
        $searchcols[] = array("content"=>$button);
      }
    }

    /*******************************************/
    /* MULTI-RECORD-(PRIORITY-)ACTIONS FORM DATA */
    /*******************************************/
    $liststart = "";
    $listend = "";

    if (!$edit && ($hasMRA || $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS)))
    {
      $page->register_script(atkconfig("atkroot")."atk/javascript/formselect.js");

      if ($hasMRA)
      {
        $liststart.= '<script language="javascript" type="text/javascript">var '.$listName.' = new Object();</script>';
      }
    }

    /********/
    /* ROWS */
    /********/

    $records = array();
    $keys = array_keys($actions);
    $actionurl = (count($actions)>0) ? $actions[$keys[0]] : '';
    $actionloader = "rl_a['".$listName."'] = {};";
    $actionloader.= "\nrl_a['".$listName."']['base'] = '".session_vars($grid->getActionSessionStatus(), 1, $actionurl)."';";
    $actionloader.= "\nrl_a['".$listName."']['embed'] = ".($grid->isEmbedded() ? 'true' : 'false').";";

    for ($i = 0, $_i = count($list["rows"]); $i < $_i; $i++)
    {
      $record = array();

      /* Special rowColor method makes it possible to change the row color based on the record data.
       * the method can return a simple value (which will be used for the normal row color), or can be
       * an array, in which case the first element will be the normal row color, and the second the mouseover
       * row color, example: function rowColor(&$record, $num) { return array('red', 'blue'); }
       */
      $method = "rowColor";
      $bgn="";
      $bgh = $defaulthighlight;
      if (method_exists($grid->getNode(), $method))
      {
        $bgn = $grid->getNode()->$method($recordset[$i], $i);
        if (is_array($bgn)) list($bgn, $bgh) = $bgn;
      }

      $record['class'] = $grid->getNode()->rowClass($recordset[$i], $i);

      foreach ($grid->getNode()->getRowClassCallback() as $callback)
      {
        $record['class'] .= " ".call_user_func_array($callback, array($recordset[$i], $i));
      }

      /* alternate colors of rows */
      $record["background"] = $bgn;
      $record["highlight"] = $bgh;
      $record["rownum"] = $i;
      $record["id"] = $listName.'_'.$i;
      $record["type"] = $list["rows"][$i]["type"];

      /* multi-record-priority-actions -> priority selection */
      if (!$edit && $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS))
      {
        $select = '<select name="'.$listName.'_atkselector[]">'.
                    '<option value="'.atk_htmlentities($list["rows"][$i]["selector"]).'"></option>';
        for ($j = $grid->getNode()->m_priority_min; $j <= $grid->getNode()->m_priority_max; $j++)
          $select .= '<option value="'.$j.'">'.$j.'</option>';
        $select .= '</select>';
        $record["cols"][] = array("content" => $select, "type" => "mrpa");
      }

      /* multi-record-actions -> checkbox */
      elseif (!$edit && $hasMRA)
      {
        if (count($list["rows"][$i]["mra"]) > 0)
        {
          $inputHTML = '';

          switch ($grid->getMRASelectionMode())
          {
            case MRA_SINGLE_SELECT:
              $inputHTML = '<input type="radio" name="'.$listName.'_atkselector[]" value="'.$list["rows"][$i]["selector"].'" class="atkradiobutton" onclick="if (this.disabled) this.checked = false">';
              break;
            case MRA_NO_SELECT:
              $inputHTML =
                '<input type="checkbox" disabled="disabled" checked="checked">'.
                '<input type="hidden" name="'.$listName.'_atkselector[]" value="'.$list["rows"][$i]["selector"].'">';
              break;
            case MRA_MULTI_SELECT:
            default:
              $inputHTML = '<input type="checkbox" name="'.$listName.'_atkselector['.$i.']" value="'.$list["rows"][$i]["selector"].'" class="atkcheckbox" onclick="if (this.disabled) this.checked = false">';
          }

          $record["cols"][] = array(
            "content" =>
              $inputHTML.'
              <script language="javascript"  type="text/javascript">'.
                $listName.'["'.atk_htmlentities($list["rows"][$i]["selector"]).'"] =
                  new Array("'.implode($list["rows"][$i]["mra"], '","').'");
              </script>',
            "type" => "mra"
          );
        }
        else $record["cols"][] = array("content"=>"");
      }

      // editable row, add selector
      else if ($edit && $list["rows"][$i]['edit'])
      {
        $liststart .=
          '<input type="hidden" name="atkdatagriddata_AE_'.$i.'_AE_atkprimkey" value="'.htmlentities($list["rows"][$i]["selector"]).'">';
      }

      /* locked? */
      if ($grid->hasFlag(atkDataGrid::LOCKING))
      {
        if (is_array($list["rows"][$i]["lock"]))
        {
          $this->getPage()->register_script(atkconfig('atkroot').'atk/javascript/overlibmws/overlibmws.js');
          $lockIcon = atkTheme::getInstance()->iconPath('lock_'.$grid->getNode()->getLockMode(), 'lock', $grid->getNode()->m_module);
          $lockInfo = addslashes(str_replace(array("\r\n", "\r", "\n"), " ", atk_htmlentities($this->getLockInfo($list["rows"][$i]["lock"]))));
          $record["cols"][] = array("content"=>'<img src="'.$lockIcon.'" onmouseover="return overlib(\''.$lockInfo.'\', NOFOLLOW, FULLHTML);" onmouseout="nd();" border="0">', "type" => "lock");
        }
        else $record["cols"][] = array("content"=>"");
      }

      $str_actions = "<span class=\"actions\">";
      $actionloader.="\nrl_a['".$listName."'][".$i."] = {};";
      $icons = (atkconfig('recordlist_icons', $theme->getAttribute("recordlist_icons"))===false ||
                atkconfig('recordlist_icons', $theme->getAttribute("recordlist_icons"))==='false'?false:true);

      foreach ($list["rows"][$i]["actions"] as $name => $url)
      {
        if (substr($url, 0, 11) == 'javascript:')
        {
          $call = substr($url, 11);
          $actionloader.="\nrl_a['{$listName}'][{$i}]['{$name}'] = function() { $call; };";
        }
        else
        {
          $actionloader.="\nrl_a['{$listName}'][{$i}]['{$name}'] = '$url';";
        }

        $module = $grid->getNode()->m_module;
        $nodetype = $grid->getNode()->m_type;
        $actionKeys = array(
          'action_'.$module.'_'.$nodetype.'_'.$name,
          'action_'.$nodetype.'_'.$name,
          'action_'.$name,
          $name
        );

        $link = atk_htmlentities($this->text($actionKeys));

        if ($icons == true)
        {
          $icon = $theme->iconPath($module.'_'.$nodetype.'_'.strtolower($name),"recordlist", $module, '', false);
          if (!$icon)
          {
            $icon = $theme->iconPath($module.'_'.strtolower($name),"recordlist", $module, '', false);
          }
          if (!$icon)
          {
            $icon = $theme->iconPath(strtolower($name),"recordlist", $grid->getNode()->m_module);
          }
          if (is_file($icon))
          {
            $link = sprintf('<img class="recordlist" border="0" src="%1$s" alt="%2$s" title="%2$s">', $icon, $link);
          }
          else
          {
            atkwarning("Icon for action '$name' not found!");
          }
        }

        $confirmtext= "false";
        if (atkconfig("recordlist_javascript_delete") && $name=="delete")
        $confirmtext = "'".$grid->getNode()->confirmActionText($name)."'";
        $str_actions.=$this->_renderRecordActionLink($url, $link, $listName, $i, $name, $confirmtext);
      }

      $str_actions.="</span>";
      /* actions (left) */
      if ($orientation == "left" || $orientation == "both")
      {
        if (!empty($list["rows"][$i]["actions"]))
        {
          $record["cols"][] = array("content"=>$str_actions, "type" => "actions");
        }
        else if ($hasActionCol)
        {
          $record["cols"][] = array("content"=>"");
        }
      }

      /* columns */
      foreach ($list["rows"][$i]["data"] as $html)
        $record["cols"][] = array("content"=>$html, "type" => "data");

      /* actions (right) */
      if ($orientation=="right"||$orientation=="both")
      {
        if (!empty($list["rows"][$i]["actions"])) $record["cols"][] = array("content"=>$str_actions, "type" => "actions");
        else if ($hasActionCol)
        {
          $record["cols"][] = array("content"=>"");
        }
      }

      $records[] = $record;

    }

    $page->register_scriptcode($actionloader);
    $this->m_actionloader = $actionloader;

    /*************/
    /* TOTAL ROW */
    /*************/
    $totalcols = array();

    if (count($list["total"]) > 0)
    {
      if (!$edit && ($hasMRA || $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS))) $totalcols[] = array("content"=>"");
      if ($grid->hasFlag(atkDataGrid::LOCKING)) $totalcols[] = array("content"=>"");
      if (($orientation == "left" || $orientation == "both") && ($hasActionCol && count($list["rows"]) > 0))
        $totalcols[] = array("content"=>"");

      foreach (array_keys($list["heading"]) as $key)
      {
        $totalcols[] = array("content"=>(isset($list["total"][$key])?$list["total"][$key]:""));
      }

      if (($orientation == "right" || $orientation == "both") && ($hasActionCol && count($list["rows"]) > 0))
       $totalcols[] = array("content"=>"");
    }

    /*************************************************/
    /* MULTI-RECORD-PRIORITY-ACTION FORM (CONTINUED) */
    /*************************************************/
    $mra = "";
    if (!$edit && $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS))
    {
      $target = session_url(atkSelf().'?atknodetype='.$grid->getActionNode()->atkNodeType(), SESSION_NESTED);

      /* multiple actions -> dropdown */
      if (count($grid->getNode()->m_priority_actions) > 1)
      {
        $mra = '<select name="'.$listName.'_atkaction">'.
                     '<option value="">'.atktext("with_selected").':</option>';

        foreach ($grid->getNode()->m_priority_actions as $name)
          $mra .= '<option value="'.$name.'">'.atktext($name).'</option>';

        $mra .= '</select>&nbsp;'.$this->getCustomMraHtml().
                   '<input type="button" class="btn" value="'.atktext("submit").'" onclick="atkSubmitMRPA(\''.$listName.'\', this.form, \''.$target.'\')">';
      }

      /* one action -> only the submit button */
      else
      {
        $mra= $this->getCustomMraHtml().'<input type="hidden" name="'.$listName.'_atkaction" value="'.$grid->getNode()->m_priority_actions[0].'">'.
                   '<input type="button" class="btn" value="'.atktext($grid->getNode()->m_priority_actions[0]).'" onclick="atkSubmitMRPA(\''.$listName.'\', this.form, \''.$target.'\')">';
      }
    }


    /****************************************/
    /* MULTI-RECORD-ACTION FORM (CONTINUED) */
    /****************************************/
    elseif (!$edit && $hasMRA)
    {
      $postvars = $grid->getNode()->m_postvars;

      $target = session_url(
        atkSelf().'?atknodetype=' . $grid->getNode()->atkNodeType()
          . '&atktarget=' . (!empty($postvars['atktarget']) ? $postvars['atktarget'] : '')
          . '&atktargetvar=' . (!empty($postvars['atktargetvar']) ? $postvars['atktargetvar'] : '')
          . '&atktargetvartpl=' . (!empty($postvars['atktargetvartpl']) ? $postvars['atktargetvartpl'] : '')
        ,
        SESSION_NESTED
      );

      $mra = (count($list["rows"]) > 1 && $grid->getMRASelectionMode() == MRA_MULTI_SELECT ?
                  '<a href="javascript:void(0)" onclick="updateSelection(\''.$listName.'\', $(this).up(\'form\'), \'all\')">'.atktext("select_all").'</a> | '.
                  '<a href="javascript:void(0)" onclick="updateSelection(\''.$listName.'\', $(this).up(\'form\'), \'none\')">'.atktext("deselect_all").'</a> | '.
                  '<a href="javascript:void(0)" onclick="updateSelection(\''.$listName.'\', $(this).up(\'form\'), \'invert\')">'.atktext("select_invert").'</a> '.
                  '<div style="height: 8px"></div>'
                 :
                  '');

      $module = $grid->getNode()->m_module;
      $nodetype = $grid->getNode()->m_type;

      /* multiple actions -> dropdown */
      if (count($list["mra"]) > 1)
      {
        $default = $this->getGrid()->getMRADefaultAction();
        $mra .= '<select name="'.$listName.'_atkaction" onchange="javascript:updateSelectable(\''.$listName.'\', this.form)">'.
                   '<option value="">'.atktext("with_selected").':</option>';

        foreach ($list["mra"] as $name)
        {
          if ($grid->getNode()->allowed($name))
          {
            $actionKeys = array(
              'action_'.$module.'_'.$nodetype.'_'.$name,
              'action_'.$nodetype.'_'.$name,
              'action_'.$name,
              $name
            );

            $mra .= '<option value="'.$name.'"';
            if ($default == $name)
            {
              $mra .= 'selected="selected"';
            }
            $mra .= '>'.atktext($actionKeys, $grid->getNode()->m_module, $grid->getNode()->m_type).'</option>';
          }
        }

        $embedded = $this->getGrid()->isEmbedded() ? 'true' : 'false';
        $mra .= '</select>&nbsp;'.$this->getCustomMraHtml().
                   '<input type="button" class="btn" value="'.atktext("submit").'" onclick="atkSubmitMRA(\''.$listName.'\', this.form, \''.$target.'\', '.$embedded.', false)">';
      }

      /* one action -> only the submit button */
      else
      {
        if ($grid->getNode()->allowed($list["mra"][0]))
        {
          $name = $list["mra"][0];

          $actionKeys = array(
            'action_'.$module.'_'.$nodetype.'_'.$name,
            'action_'.$nodetype.'_'.$name,
            'action_'.$name,
            $name
          );

          $embedded = $this->getGrid()->isEmbedded() ? 'true' : 'false';
          $mra .= '<input type="hidden" name="'.$listName.'_atkaction" value="'.$name.'">'.
          $this->getCustomMraHtml().
                     '<input type="button" class="btn" value="'.atktext($actionKeys,$grid->getNode()->m_module, $grid->getNode()->m_type).'" onclick="atkSubmitMRA(\''.$listName.'\', this.form, \''.$target.'\', '.$embedded.', false)">';
        }
      }
    }

    else if ($edit)
    {
      $embedded = $this->getGrid()->isEmbedded() ? 'true' : 'false';
      $mra =
       '<input type="button" class="btn" value="'.atktext('save').'" onclick="'.atk_htmlentities($this->getGrid()->getSaveCall()).'">';
    }


    if (atkconfig("use_keyboard_handler"))
    {
      $kb = &atkKeyboard::getInstance();
      $kb->addRecordListHandler($listName, $selectcolor, count($records));
    }

    $recordListData = array("vorientation"=>$vorientation,
                            "rows"=>$records,
                            "header"=>$headercols,
                            "search"=>$searchcols,
                            "sort"=>$sortcols,
                            "total"=>$totalcols,
                            "searchstart"=>$searchstart,
                            "searchend"=>$searchend,
                            "sortstart"=>$sortstart,
                            "sortend"=>$sortend,
                            "liststart"=>$liststart,
                            "listend"=>$listend,
                            "listid"=>$listName,
                            "mra"=>$mra,
                            "editing"=>$this->getGrid()->isEditing());

    return $recordListData;
  }

  /**
   * Renders a link for a row action with the specified parameters

   * @param string $url The URL for the record action
   * @param string $link HTML for displaying the link (between the <a></a>)
   * @param string $listName The name of the recordlist
   * @param string $i The row index to render the action for
   * @param string $name The action name
   * @param bool|string $confirmtext The text for the confirmation if set
   */
  protected function _renderRecordActionLink($url, $link, $listName, $i, $name, $confirmtext = "false")
  {
     return '<a href="'."javascript:rl_do('$listName',$i,'$name',$confirmtext);".'">'.$link.'</a>&nbsp;';
  }

  /**
   * Returns an HTML snippet which is used to display information about locks
   * on a certain record in a small popup.
   *
   * @param array $locks lock(s) array
   */
  protected function getLockInfo($locks)
  {
    return $this->getUi()->render('lockinfo.tpl', array('locks' => $locks), $this->getNode()->m_module);
  }

  /**
   * Checks wether the recordlist should display a column which holds the actions.
   *
   * @access private
   * @param Array $list The recordlist data
   * @return bool Wether the list should display an extra column to hold the actions
   */
  function _hasActionColumn($list, $hasSearch)
  {
    $grid = $this->getGrid();

    if ($this->m_hasActionColumn === null)
    {
      // when there's a search bar, we always need an extra column (for the button)
      if ($hasSearch)
      {
        $this->m_hasActionColumn = true;
      }
      // when there's an extended sort bar, we also need the column (for the sort button)
      else if ($grid->hasFlag(atkDataGrid::EXTENDED_SORT))
      {
        $this->m_hasActionColumn = true;
      }
      else
      {
        // otherwise, it depends on whether one of the records has actions defined.
        $this->m_hasActionColumn = false;

        foreach ($list["rows"] as $record)
        {
          if (!empty($record['actions']))
          {
            $this->m_hasActionColumn = true;
            break;
          }
        }
      }
    }
    return $this->m_hasActionColumn;
  }

  /**
   * Get custom mra html
   *
   * @return string The custom mra html
   */
  function getCustomMraHtml()
  {
    $grid = $this;
    if (method_exists($grid->getNode(), "getcustommrahtml"))
    {
      $output = $grid->getNode()->getCustomMraHtml();
      return $output;
    }
  }

  /**
   * Convert datagrid flags to recordlist flags.
   *
   * @todo this should be replaced in the long term
   * @deprecated
   *
   * @return int
   */
  private function convertDataGridFlags()
  {
    $grid = $this->getGrid();

    atkimport('atk.recordlist.atkrecordlist');
    $result  = !$grid->isEditing() && $grid->hasFlag(atkDataGrid::MULTI_RECORD_ACTIONS) ? RL_MRA : 0;
    $result |= !$grid->isEditing() && $grid->hasFlag(atkDataGrid::MULTI_RECORD_PRIORITY_ACTIONS) ? RL_MRPA : 0;
    $result |= !$grid->isEditing() && $grid->hasFlag(atkDataGrid::LOCKING) ? RL_LOCK : 0;
    $result |= $grid->isEditing() || !$grid->hasFlag(atkDataGrid::SEARCH) ? RL_NO_SEARCH : 0;
    $result |= $grid->isEditing() || !$grid->hasFlag(atkDataGrid::EXTENDED_SEARCH) ? RL_NO_EXTENDED_SEARCH : 0;
    $result |= !$grid->isEditing() && $grid->hasFlag(atkDataGrid::EXTENDED_SORT) ? RL_EXT_SORT : 0;
    $result |= $grid->isEditing() ? RL_NO_SORT : 0;
    return $result;
  }

  /**
   * Function outputs an array with all information necessary to output a recordlist.
   *
   * @param Array   $recordset    List of records that need to be displayed
   * @param String  $prefix       Prefix for each column name (used for subcalls)
   * @param Array   $actions      List of default actions for each record
   * @param Array   $suppress     An array of fields that you want to hide
   *
   * The result array contains the following information:
   *  "name"     => the name of the recordlist
   *  "heading"  => for each visible column an array containing: "title" {, "url"}
   *  "search"   => for each visible column HTML input field(s) for searching
   *  "rows"     => list of rows, per row: "data", "actions", "mra", "record"
   *  "totalraw" => for each totalisable column the sum value field(s) (raw)
   *  "total"    => for each totalisable column the sum value (display)
   *  "mra"      => list of all multi-record actions
   *
   * @return see above
   */
  private function listArray(&$recordset, $prefix="", $actions=array(), $suppress=array())
  {
    $grid = $this->getGrid();

    $flags = $this->convertDataGridFlags();

    if (!is_array($suppress)) $suppress = array();
    $result = array("name"=>$grid->getName(), "heading" => array(), "search" => array(), "rows" => array(),
                    "totalraw" => array(), "total" => array(), "mra" => array());

    $columnConfig = &$grid->getNode()->getColumnConfig($grid->getName());

    if (!hasFlag($flags, RL_NO_SEARCH) || $grid->isEditing())
    {
      $grid->getNode()->setAttribSizes();
    }

    $this->_addListArrayHeader($result, $prefix, $suppress, $flags, $columnConfig);

    /* actions array can contain multi-record-actions */
    if (count($actions) == 2 && count(array_diff(array_keys($actions), array("actions", "mra"))) == 0)
    {
      $mra = $actions["mra"];
      $actions = $actions["actions"];
    }
    else
      $mra = $grid->getNode()->hasFlag(NF_NO_DELETE) ? array() : array("delete");

    /* get the rows */
    for ($i = 0, $_i = count($recordset); $i < $_i; $i++)
    {
      $result["rows"][$i] = array("columns" => array(), "actions" => $actions, "mra" => $mra, "record" => &$recordset[$i], "data" => array());
      $result["rows"][$i]["selector"] = $grid->getNode()->primaryKey($recordset[$i]);
      $result["rows"][$i]["type"]="data";
      $row = &$result["rows"][$i];

      /* locked */
      if ($grid->hasFlag(atkDataGrid::LOCKING))
      {
        $result["rows"][$i]["lock"] = $grid->getNode()->m_lock->isLocked($result["rows"][$i]["selector"], $grid->getNode()->m_table, $grid->getNode()->getLockMode());
        if (is_array($result["rows"][$i]["lock"]) && $grid->getNode()->getLockMode() == atkLock::EXCLUSIVE)
        {
          unset($row["actions"]["edit"]);
          unset($row["actions"]["delete"]);
          $row["mra"] = array();
        }
      }

      /* actions / mra */
      $grid->getNode()->collectRecordActions($row["record"], $row["actions"], $row["mra"]);

      // filter actions we are allowed to execute
      foreach($row["actions"] as $name => $url)
      {
        if (!empty($url) && $grid->getNode()->allowed($name, $row["record"]))
        {
          /* dirty hack */
          $atkencoded = strpos($url, "_15B") > 0;

          $url = str_replace("%5B","[",     $url);
          $url = str_replace("%5D","]",     $url);
          $url = str_replace("_1"."5B","[", $url);
          $url = str_replace("_1"."5D","]", $url);

          if ($atkencoded) $url = str_replace('[pk]', atkurlencode(rawurlencode($row["selector"]), false), $url);
          else $url = str_replace('[pk]', rawurlencode($row["selector"]), $url);

          $parser = new atkStringParser($url);
          $url = $parser->parse($row["record"], true, false);
          $row["actions"][$name] = $url;
        }
        else
        {
          unset($row["actions"][$name]);
        }
      }

      // filter multi-record-actions we are allowed to execute
      foreach ($row["mra"] as $j => $name)
      {
        if (!$grid->getNode()->allowed($name, $row["record"]))
        {
          unset($row["mra"][$j]);
        }
      }

      $row['mra'] = array_values($row['mra']);
      $result["mra"] = array_merge($result["mra"], $row["mra"]);

      /* columns */
      $editAllowed = $grid->getPostvar('atkgridedit', false) && $grid->getNode()->allowed('edit', $result["rows"][$i]["record"]);
      $result["rows"][$i]["edit"] = $editAllowed;
      $this->_addListArrayRow($result, $prefix, $suppress, $flags, $i, $editAllowed);
    }

    if (hasFlag($flags, RL_EXT_SORT) && $columnConfig->hasSubTotals())
    {
      atkimport("atk.recordlist.atktotalizer");
      $totalizer = new atkTotalizer($grid->getNode(), $columnConfig);
      $result["rows"] = $totalizer->totalize($result["rows"]);
    }

    if (hasFlag($flags, RL_MRA))
      $result["mra"] = array_values(array_unique($result["mra"]));

    return $result;
  }

  /**
   * Returns the list attributes and their possible child column
   * names for this list.
   */
  protected function _getColumns()
  {
    $result = array();

    $columns = $this->getOption('columns');
    if ($columns == null)
    {
      foreach ($this->getNode()->getAttributeNames() as $attrName)
      {
        $entry = new stdClass();
        $entry->attrName = $attrName;
        $entry->columnName = '*';
        $result[] = $entry;
      }
    }
    else
    {
      foreach ($columns as $column)
      {
        $parts = explode('.', $column);
        $entry = new stdClass();
        $entry->attrName = $parts[0];
        $entry->columnName = isset($parts[1]) ? $parts[1] : null;
        $result[] = $entry;
      }
    }

    return $result;
  }

  /**
   * Add the list array header to the result list.
   */
  private function _addListArrayHeader(&$listArray, $prefix, $suppressList, $flags, $columnConfig)
  {
    $columns = $this->_getColumns();

    foreach ($columns as $column)
    {
      if (in_array($column->attrName, $suppressList))
      {
        continue;
      }

      $attr = $this->getNode()->getAttribute($column->attrName);
      if (!is_object($attr))
      {
        throw new Exception("Invalid attribute {$column->attrName} for node ".$this->getNode()->atkNodeType());
      }

      $attr->addToListArrayHeader(
        $this->getNode()->getAction(),
        $listArray,
        $prefix,
        $flags,
        $this->getGrid()->getPostvar('atksearch'),
        $columnConfig,
        $this->getGrid(),
        $column->columnName
      );
    }
  }

  /**
   * Adds the given row the the list array.
   */
  private function _addListArrayRow(&$listArray, $prefix, $suppressList, $flags, $rowIndex, $editAllowed)
  {
    $columns = $this->_getColumns();

    foreach ($columns as $column)
    {
      if (in_array($column->attrName, $suppressList))
      {
        continue;
      }

      $attr = $this->getNode()->getAttribute($column->attrName);
      if (!is_object($attr))
      {
        throw new Exception("Invalid attribute {$column->attrName} for node ".$this->getNode()->atkNodeType());
      }

      $edit = $editAllowed && in_array($column->attrName, $this->getNode()->m_editableListAttributes);

      $attr->addToListArrayRow(
        $this->getNode()->getAction(),
        $listArray,
        $rowIndex,
        $prefix,
        $flags,
        $edit,
        $this->getGrid(),
        $column->columnName
      );
    }
  }
}