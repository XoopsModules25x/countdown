<{include file="db:countdown_header.tpl"}>
<div class="panel panel-info">

    <h5><strong><{$smarty.const._MD_COUNTDOWN_EVENTS}></strong></h5>
	<a href="<{$xoops_url}>/modules/countdown/index.php" class="float-left btn btn-info btn-sm"><{$smarty.const._MD_COUNTDOWN_EVENT_ALL}></a>
	<a href="<{$xoops_url}>/modules/countdown/index.php?op=running" class="float-left btn btn-primary btn-sm"><{$smarty.const._MD_COUNTDOWN_EVENT_RUNNING}></a>
	<a href="<{$xoops_url}>/modules/countdown/index.php?op=expired" class="float-left btn btn-danger btn-sm"><{$smarty.const._MD_COUNTDOWN_EVENT_EXPIRED}></a>
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
         "expired":"<{$smarty.const._COUNTDOWN_PASTEVENT}>",
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
  	<div>
                    <p class="mb-0 p-2 font-weight-bold text-body">
					<{if $displayeventlogo == 1}>
						<a href="<{$xoops_url}>/modules/countdown/event.php?id=<{$events.id}>">
						<img src="<{$xoops_url}>/uploads/countdown/images/<{$events.logo}>" alt="<{$events.name}>" title="<{$events.name}>" class="img-fluid float-right" width="200">
						</a>
					<{/if}>
					<h4><a href="<{$xoops_url}>/modules/countdown/event.php?id=<{$events.id}>"><{$events.name}></a></h4>
					<small><b><{$smarty.const._MD_COUNTDOWN_EVENTS_DATE}> :</b> <{$events.date|date_format:"%A, %B %e %Y %l:%M %p"}></small><br>
					<{if $displayeventdescription == 1}>
					  <{$events.description}><{/if}>
					</p>
                    <div id="clock-c" class="countdown py-4">
				      <div v-show ="statusType !== 'expired'">
          <span class="h4 text-body font-weight-bold">{{ days }}</span> {{ wordString.day }}
          <span class="h4 text-body font-weight-bold">{{ hours }}</span> {{ wordString.hours }}
          <span class="h4 text-body font-weight-bold">{{ minutes }}</span> {{ wordString.minutes }}
          <span class="h4 text-body font-weight-bold">{{ seconds }}</span> {{ wordString.seconds }}
	</div>
	</div>
                    <!-- Call to actions -->
                    <ul class="list-inline">
                        <li class="list-inline-item pt-2">
                            <button type="button" class="btn btn-primary"> {{ message }}</button>
                        </li>
                        <li class="list-inline-item pt-2">
                            <button type="button" class="btn btn-danger"> {{ statusText }}</button>
                        </li>
                    </ul>   
					
				 
				 <{if $displayinfo == 1}>
				 <p><small><span class="fa fa-info-circle"></span>&nbsp;<{$events.info}></small></p><{/if}>
			
		
                <{if $xoops_isadmin === true}>
                    <p class="float-right">
					<a href="admin/events.php?op=edit&id=<{$events.id}>" target="_blank" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                    <a href="admin/events.php?op=delete&id=<{$events.id}>" target="_blank" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"></a>
					</p>
				<{/if}>
				
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
