<{if $eventsRows > 0}>
    <div class="outer">
        <form name="select" action="events.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('eventsId[]');} else if (isOneChecked('eventsId[]')) {return true;} else {alert('<{$smarty.const._AM_EVENTS_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1"/>
            <div class="floatleft">
                <select name="op">
                    <option value=""><{$smarty.const._AM_COUNTDOWN_SELECT}></option>
                    <option value="delete"><{$smarty.const._AM_COUNTDOWN_SELECTED_DELETE}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>"/>
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav}></div>
            </div>


            <table class="$events" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectorname}></th>
                    <th class="center"><{$selectordescription}></th>
                    <th class="center"><{$selectordate}></th>
					<th class="center"><{$selectorcategory}></th>
					<th class="center"><{$selectorlogo}></th>
					<th class="center"><{$selectoruid}></th>
					<th class="center"><{$selectordatecreated}></th>
                    <th class="center"><{$selectordateupdated}></th>
                    <th class="center width5"><{$smarty.const._AM_COUNTDOWN_FORM_ACTION}></th>
                </tr>
                <{foreach item=eventsArray from=$eventsArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="events_id[]" title="events_id[]" id="events_id[]" value="<{$eventsArray.events_id}>"/></td>
                        <td class='center'><{$eventsArray.event_id}></td>
                        <td class='center'><a href="<{$countdown_url}>/event.php?id=<{$eventsArray.event_id}>"><{$eventsArray.event_name}></a></td>
                        <td class='center'><{$eventsArray.event_description}></td>
                        <td class='center'><{$eventsArray.event_date}></td>
					    <td class='center'><{$eventsArray.event_categoryid}></td>
						<!--<td class='center'><{$eventsArray.event_categoryname}></td>-->
						<td class='center'><{$eventsArray.event_logo}></td>
						<td class='center'><{$eventsArray.event_postername}></td>
						<td class='center'><{$eventsArray.date_created}></td>
                        <td class='center'><{$eventsArray.date_updated}></td>
                        <td class="center width5"><{$eventsArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectorname}></th>
                    <th class="center"><{$selectordescription}></th>
                    <th class="center"><{$selectordate}></th>
				    <th class="center"><{$selectorcategory}></th>
					<th class="center"><{$selectorlogo}></th>
					<th class="center"><{$selectoruid}></th>
					<th class="center"><{$selectordatecreated}></th>
                    <th class="center"><{$selectordateupdated}></th>
                    <th class="center width5"><{$smarty.const._AM_COUNTDOWN_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $events</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
