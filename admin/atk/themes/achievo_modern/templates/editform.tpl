  {foreach from=$fields item=field}
    <tr{if $field.rowid != ""} id="{$field.rowid}"{/if}{if !$field.initial_on_tab} style="display: none"{/if} class="{$field.class}">
      {if isset($field.line) && $field.line!=""}
        <td colspan="2" valign="top" nowrap>{$field.line}</td>
      {else}
      {if $field.label!=="AF_NO_LABEL"}<td valign="top" class="{if isset($field.error)}errorlabel{else}fieldlabel{/if}">{if $field.label!=""}<b>{$field.label}</b>:  {if isset($field.obligatory)}{$field.obligatory}{/if}{/if}</td>{/if}
<!--    </tr>
    <tr{if $field.rowid != ""} id="{$field.rowid}"{/if}{if $field.initial_on_tab!='yes'} style="display: none"{/if} class="{$field.tab}"> -->
        <td valign="top" id="{$field.id}" {if $field.label==="AF_NO_LABEL"}colspan="2"{/if} class="field">{$field.full}</td>
      {/if}
    </tr>
  {/foreach}