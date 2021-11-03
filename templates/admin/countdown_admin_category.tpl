<{if $categoryRows > 0}>
    <div class="outer">
        <form name="select" action="category.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('categoryId[]');} else if (isOneChecked('categoryId[]')) {return true;} else {alert('<{$smarty.const._AM_COUNTDOWN_CATEGORY_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1">
            <div class="floatleft">
                <select name="op">
                    <option value=""><{$smarty.const._AM_COUNTDOWN_SELECT}></option>
                    <option value="delete"><{$smarty.const._AM_COUNTDOWN_SELECTED_DELETE}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>">
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav}></div>
            </div>


            <table class="$category" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectortitle}></th>
                    <th class="center"><{$selectorweight}></th>
                    <th class="center width5"><{$smarty.const._AM_COUNTDOWN_FORM_ACTION}></th>
                </tr>
                <{foreach item=categoryArray from=$categoryArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="category_id[]" title="category_id[]" id="category_id[]" value="<{$categoryArray.category_id}>"></td>
                        <td class='center'><{$categoryArray.category_id}></td>
                        <td class='center'><{$categoryArray.category_title}></td>
                        <td class='center'><{$categoryArray.category_weight}></td>
                        <td class="center width5"><{$categoryArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectortitle}></th>
                    <th class="center"><{$selectorweight}></th>
                    <th class="center width5"><{$smarty.const._AM_COUNTDOWN_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $category</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
