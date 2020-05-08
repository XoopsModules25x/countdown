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
               <div id="timer<{$events.id}>" class="timer">
<!--  Timer Component  -->
  <Timer 
         starttime="<{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}>" 
         endtime="<{$events.dateiso}>" 
         trans='{  
         "day":"<{$smarty.const._MD_COUNTDOWN_DAY}>",
         "hours":"<{$smarty.const._MD_COUNTDOWN_HOURS}>",
         "minutes":"<{$smarty.const._MD_COUNTDOWN_MINUTES}>",
         "seconds":"<{$smarty.const._MD_COUNTDOWN_SECONDS}>",
         "expired":"<{$smarty.const._MD_COUNTDOWN_EXPIRED}>",
         "running":"<{$smarty.const._MD_COUNTDOWN_TILLEND}>",
         "upcoming":"<{$smarty.const._MD_COUNTDOWN_TILLSTART}>",
         "status": {
            "expired":"<{$smarty.const._MD_COUNTDOWN_STATUS_EXPIRED}>",
            "running":"<{$smarty.const._MD_COUNTDOWN_STATUS_RUNNING}>",
            "upcoming":"<{$smarty.const._MD_COUNTDOWN_STATUS_FUTURE}>"
           }}'
         ></Timer>
<!--  End! Timer Component  -->
</div>


<script>
 Vue.component('Timer',{
	template: `
  	<div class="rounded bg-gradient-1 text-white shadow p-5 text-center mb-5">
                    <p class="mb-0 font-weight-bold text-uppercase text-white"><a href="<{$xoops_url}>/modules/countdown2/event.php?id=<{$events.id}>"><{$events.name}></a><br><small><{$events.date|date_format:"%A, %B %e %Y %l:%M %p"}></small>
					<a href="<{$xoops_url}>/modules/countdown2/event.php?id=<{$events.id}>">
					<img src="<{$xoops_url}>/uploads/countdown/images/<{$events.logo}>" alt="<{$events.name}>" title="<{$events.name}>" class="img-fluid"><br>
					<span class="text-body"><{$events.name}></span></a>
					<br><small><{$events.date|date_format:"%A, %B %e %Y %l:%M %p"}></small><br>
					  <{$events.description}>
					</p>
                    <div id="clock-c" class="countdown py-4">
				      <div v-show ="statusType !== 'expired'">
          <span class="h1 text-body font-weight-bold">{{ days }}</span> {{ wordString.day }}
          <span class="h1 text-body font-weight-bold">{{ hours }}</span> {{ wordString.hours }}
          <span class="h1 text-body font-weight-bold">{{ minutes }}</span> {{ wordString.minutes }}
          <span class="h1 text-body font-weight-bold">{{ seconds }}</span> {{ wordString.seconds }}
	</div>
	</div>
                    <!-- Call to actions -->
                    <ul class="list-inline">
                        <li class="list-inline-item pt-2">
                            <button id="btn-message" type="button" class="btn btn-countdown"> {{ message }}</button>
                        </li>
                        <li class="list-inline-item pt-2">
                            <button id="btn-status" type="button" class="btn btn-countdown"> {{ statusText }}</button>
                        </li>
                    </ul>   
					
				 <p>
				 <small><span class="fa fa-info-circle"></span>&nbsp;<{$events.postinfo}></small>
				 <!--<span class="fa fa-calendar"></span>
                  <{if $events.date_created == $events.date_updated}>
                       <small><{$events.date_created|date_format}></small>
                  <{else}>
                        <small><{$events.date_updated|date_format}></small>
                  <{/if}>
				  <small><span class="fa fa-user-circle-o"></span> <{$events.postername}>  <span class="fa fa-tag"></span> <{$events.category}></small>
                     --> </p>
			
                <{if $xoops_isadmin == true}>
				 <p class="float-right">
                    <a href="admin/events.php?op=edit&id=<{$events.id}>" target="_blank" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
                    <a href="admin/events.php?op=delete&id=<{$events.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                <{/if}>
				</p>
</div>
  `,
  props: ['starttime','endtime','trans'] ,
  data: function(){
  	return{
    	timer:"",
      wordString: {},
      start: "",
      end: "",
      interval: "",
      days:"",
      minutes:"",
      hours:"",
      seconds:"",
      message:"",
      statusType:"",
      statusText: "",
    
    };
  },
  created: function () {
        this.wordString = JSON.parse(this.trans);
    },
  mounted(){
    this.start = new Date(this.starttime).getTime();
    this.end = new Date(this.endtime).getTime();
    // Update the count down every 1 second
    this.timerCount(this.start,this.end);
    this.interval = setInterval(() => {
        this.timerCount(this.start,this.end);
    }, 1000);
  },
  methods: {
    timerCount: function(start,end){
        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = start - now;
        var passTime =  end - now;

        if(distance < 0 && passTime < 0){
            this.message = this.wordString.expired;
            this.statusType = "expired";
            this.statusText = this.wordString.status.expired;
            clearInterval(this.interval);
            return;

        }else if(distance < 0 && passTime > 0){
            this.calcTime(passTime);
            this.message = this.wordString.running;
            this.statusType = "running";
            this.statusText = this.wordString.status.running;

        } else if( distance > 0 && passTime > 0 ){
            this.calcTime(distance); 
            this.message = this.wordString.upcoming;
            this.statusType = "upcoming";
            this.statusText = this.wordString.status.upcoming;
        }
    },
    calcTime: function(dist){
      // Time calculations for days, hours, minutes and seconds
        this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
        this.hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
        this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
    }
    
  }
});

new Vue({
  el: "#timer<{$events.id}>",
});
</script>

                </td>
            </tr>
		<{/foreach}> 
	 </tbody>
     </table>
</div>
<{$pagenav}>

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