<div class="header">
    <span class="left"><b><{$smarty.const.MD_COUNTDOWN_TITLE}></b>&#58;&#160;</span>
    <span class="left"><{$smarty.const.MD_COUNTDOWN_DESC}></span><br>
</div>
<div class="head">
    <{if $adv != ''}>
        <div class="center"><{$adv}></div>
    <{/if}>
</div>
<br>
<ul class="nav nav-pills">
    <li class="active"><a href="<{$countdown_url}>"><{$smarty.const.MD_COUNTDOWN_INDEX}></a></li>

    <li><a href="<{$countdown_url}>/events.php"><{$smarty.const.MD_COUNTDOWN_EVENTS}></a></li>
</ul>

<br>
