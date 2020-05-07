<{include file="db:countdown_header.tpl"}>

<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Events </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const._MD_COUNTDOWN_EVENTS_ID}></td>
            <td><{$events.id}></td>
        </tr>
        <{*<tr>*}>
            <{*<td><{$smarty.const._MD_COUNTDOWN_EVENTS_UID}></td>*}>
            <{*<td><{$events.uid}></td>*}>
        <{*</tr>*}>
		<tr>
            <td><{$smarty.const._MD_COUNTDOWN_EVENTS_LOGO}></td>
            <td>	<img src="<{$xoops_url}>/uploads/countdown/images/<{$events.logo}>" alt="<{$events.name}>" title="<{$events.name}>" class="img-fluid"><br></td>
        </tr>       
	   <tr>
            <td><{$smarty.const._MD_COUNTDOWN_EVENTS_NAME}></td>
            <td><{$events.name}></td>
        </tr>
        <tr>
            <td><{$smarty.const._MD_COUNTDOWN_EVENTS_DESCRIPTION}></td>
            <td><{$events.description}></td>
        </tr>
        <tr>
            <td><{$smarty.const._MD_COUNTDOWN_EVENTS_ENDDATETIME}></td>
            <td><{$events.enddatetime}></td>
        </tr>
        <tr>
            <td><{$smarty.const._MD_COUNTDOWN_EVENTS_ENDDATETIME}></td>
            <td>
                <div id="app-timer" class="container-fluid">
                    <div class="row">
                        <time-item v-for="times in times" v-bind:time="times"></time-item>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td><{$smarty.const._MD_COUNTDOWN_ACTION}></td>
            <td>
			
				 <p class="text-muted"><span class="fa fa-calendar"></span>
                                                        <{if $events.date_created == $events.date_updated}>
                                                            <small><{$events.date_created|date_format}></small>
                                                        <{else}>
                                                            <small><{$events.date_updated|date_format}></small>
                                                        <{/if}>
														<span class="fa fa-user-circle-o"></span> <{$events.postername}>  <span class="fa fa-tag"></span> <{$events.category}>
                      </p>
			
                <!--<a href="events.php?op=view&id=<{$events.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>    &nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="admin/events.php?op=edit&id=<{$events.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                    &nbsp;
                    <a href="admin/events.php?op=delete&id=<{$events.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                <{/if}>
            </td>
        </tr>
        </tbody>

    </table>
</div>
<div id="pagenav"><{$pagenav}></div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>

<{include file="db:countdown_footer.tpl"}>

<script src="https://unpkg.com/vue/dist/vue.min.js"></script>

<script>
    // template for number card
    Vue.component("time-item", {
        props: ["time"],
        template: `
<div>
{{time.time}}{{time.text}}
</div>`
    });


    //app logic
    var app = new Vue({
        el: "#app-timer",
        data: {
            endTime: "<{$events.enddatetimeiso}>",
            times: [
                {id: 0, text: " Days, " + '\xa0', time: 45},
                {id: 1, text: " Hours," + '\xa0', time: 35},
                {id: 2, text: " Minutes," + '\xa0', time: 25},
                {id: 3, text: " Seconds", time: 15}
            ],
            a: 1,
            progress: 50,
            // currentTime: Date.parse(new Date("July 2, 2018 16:30:00"))
        },
        methods: {
            updateTimer: function () {
                this.getTimeRemaining();
                this.updateProgressBar();
            },
            getTimeRemaining: function () {
                let t = Date.parse(new Date(this.endTime)) - Date.parse(new Date());

                // console.log(this.progress);
                this.times[3].time = Math.floor(t / 1000 % 60);
                this.times[2].time = Math.floor(t / 1000 / 60 % 60);
                this.times[1].time = Math.floor(t / (1000 * 60 * 60) % 24);
                this.times[0].time = Math.floor(t / (1000 * 60 * 60 * 24));
            },
            updateProgressBar: function () {
                //TODO fix progress bar
                // let interval = Date.parse(new Date(this.endTime)) - Date.parse(new Date());
                // this.progress = Math.floor(this.currentTime / Date.parse(new Date(this.endTime))*100);
            }
        },
        created: function () {
            this.updateTimer();
            // console.log("date is " + new Date());
            // console.log("abc is: " + this.a);
            let timeinterval = setInterval(this.updateTimer, 1000);
        }
    });

</script>
