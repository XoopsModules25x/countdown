<{include file="db:countdown_header.tpl"}>
<div class="panel panel-info">

    <h5><strong><{$smarty.const._MD_COUNTDOWN_EVENTS}></strong></h5>
    <table id="events" class="table table-striped">
        <thead>
        <tr>

            <th><{$smarty.const._MD_COUNTDOWN_EVENTS}></th>

        </tr>
        </thead>
            <tbody>
        <{foreach item=events from=$events}>
            <tr>
                <td>
				#<{$events.id}>	<{*<{$events.uid}>*}><br>

				<strong><{$smarty.const._MD_COUNTDOWN_EVENTS_NAME}></strong>   <br>        
					<a href="event.php?id=<{$events.id}>"><{$events.name}></a>
				<br>
				<strong> <{$smarty.const._MD_COUNTDOWN_EVENTS_DESCRIPTION}> </strong><br>            
					<{$events.description}>
				<br>
				<strong><{$smarty.const._MD_COUNTDOWN_EVENTS_ENDDATETIME}> </strong><br>
						<{$events.enddatetime}>
                <br>
				<strong><{$smarty.const._MD_COUNTDOWN_TIME_REMAINING}> </strong><br>
                    <div id="app-timer">
                            <time-item v-for="times in times" v-bind:time="times"></time-item>
                    </div>
                <br>
                    <{if $xoops_isadmin == true}>
                        <a href="admin/events.php?op=edit&id=<{$events.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                        &nbsp;
                        <a href="admin/events.php?op=delete&id=<{$events.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                    <{/if}>
                </td>
            </tr>
		<{/foreach}> 
	 </tbody>
     </table>
</div>
<{$pagenav}>
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

  <script>
                                $(document).ready(function () {
                                    $('#events').DataTable({
                                        "ordering": false,
                                        "lengthChange": false,
                                        "displayLength": <{$eventperpage}>,
                                        "language": {
                                            "decimal": "<{$smarty.const._MD_COUNTDOWN_DTABLE_DECIMAL}>",
                                            "emptyTable": "<{$smarty.const._MD_COUNTDOWN_DTABLE_EMPTYTABLE}>",
                                            "info": "<{$smarty.const._MD_COUNTDOWN_DTABLE_INFOSHOWING}> _START_ <{$smarty.const._MD_COUNTDOWN_DTABLE_INFOTO}> _END_ <{$smarty.const._MD_COUNTDOWN_DTABLE_INFOOF}> _TOTAL_ <{$smarty.const._MD_COUNTDOWN_DTABLE_INFOENTRIES}>",
                                            "infoEmpty": "<{$smarty.const._MD_COUNTDOWN_DTABLE_INFOEMPTY}>",
                                            "infoFiltered": "(<{$smarty.const._MD_COUNTDOWN_DTABLE_INFOFILTEREDFROM}> _MAX_ <{$smarty.const._MD_COUNTDOWN_DTABLE_INFOFILTEREDTOTALENTRIES}>)",
                                            "infoPostFix": "<{$smarty.const._MD_COUNTDOWN_DTABLE_INFOPOSTFIX}>",
                                            "thousands": "<{$smarty.const._MD_COUNTDOWN_DTABLE_THOUSANDS}>",
                                            "lengthMenu": "<{$smarty.const._MD_COUNTDOWN_DTABLE_LENGTHMENUSHOW}> _MENU_ <{$smarty.const._MD_COUNTDOWN_DTABLE_LENGTHMENUENTRIES}>",
                                            "loadingRecords": "<{$smarty.const._MD_COUNTDOWN_DTABLE_LOADINGRECORDS}>",
                                            "processing": "<{$smarty.const._MD_COUNTDOWN_DTABLE_PROCESSING}>",
                                            "search": "<{$smarty.const._MD_COUNTDOWN_DTABLE_SEARCH}>",
                                            "zeroRecords": "<{$smarty.const._MD_COUNTDOWN_DTABLE_ZERORECORDS}>",
                                            "paginate": {
                                                "first": "<{$smarty.const._MD_COUNTDOWN_DTABLE_FIRST}>",
                                                "last": "<{$smarty.const._MD_COUNTDOWN_DTABLE_LAST}>",
                                                "next": "<{$smarty.const._MD_COUNTDOWN_DTABLE_NEXT}>",
                                                "previous": "<{$smarty.const._MD_COUNTDOWN_DTABLE_PREVIOUS}>"
                                            },
                                            "aria": {
                                                "sortAscending": "<{$smarty.const._MD_COUNTDOWN_DTABLE_SORT_ASCENDING}>",
                                                "sortDescending": "<{$smarty.const._MD_COUNTDOWN_DTABLE_SORT_DESCENSING}>"
                                            }
                                        }
                                    });
                                });
                            </script>