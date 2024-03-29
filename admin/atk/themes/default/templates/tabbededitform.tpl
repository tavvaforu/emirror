<table id="{$panename}_editform" border="0">
  {if (count($errors)>0)}
    <tr>
      <td colspan="2" class="error">
        {$errortitle}
        {foreach from=$errors item=error}
          <br>{$error.label}: {$error.message} {if isset($error.tablink)} ({atktext "error_tab"} {$error.tablink}){/if}
        {/foreach}
      </td>
    </tr>
  {/if}
  {foreach from=$fields item=field}
    <tr{if $field.rowid != ""} id="{$field.rowid}"{/if}{if !$field.initial_on_tab} style="display: none"{/if} class="{$field.class}">
      {if isset($field.line) && $field.line!=""}
        <td colspan="2" valign="top" nowrap>{$field.line}</td>
      {else}
      {if $field.label!=="AF_NO_LABEL"}<td valign="top" class="{if isset($field.error)}errorlabel{else}fieldlabel{/if}">{if $field.label!=""}{$field.label}:  {if isset($field.obligatory)}{$field.obligatory}{/if}{/if}</td>{/if}
        <td valign="top" id="{$field.id}" {if $field.label==="AF_NO_LABEL"}colspan="2"{/if} class="field">{$field.full}</td>
      {/if}
    </tr>
  {/foreach}
</table>