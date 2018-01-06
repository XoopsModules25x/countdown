<{if $bookmarks != 0}>
    <{include file="db:system_bookmarks.tpl"}>
<{/if}>

<{if $fbcomments != 0}>
    <{include file="db:system_fbcomments.tpl"}>
<{/if}>

<div class="left"><{$copyright}></div>
<{if $xoops_isadmin}>
    <div class="center bold"><a href="<{$admin}>"><{$smarty.const.MD_COUNTDOWN_ADMIN}></a></div>
<{/if}>
<div class="pad2 marg2">
    <{if $comment_mode == "flat"}>
        <{include file="db:system_comments_flat.tpl"}>
    <{elseif $comment_mode == "thread"}>
        <{include file="db:system_comments_thread.tpl"}>
    <{elseif $comment_mode == "nest"}>
        <{include file="db:system_comments_nest.tpl"}>
    <{/if}>
</div>
<{include file='db:system_notification_select.tpl'}>
