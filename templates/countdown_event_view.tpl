
<{include file="db:countdown_header.tpl"}>  
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
                    <p class="mb-0 font-weight-bold text-uppercase"><{$events.name}><br><small><{$events.date|date_format:"%A, %B %e %Y %l:%M %p"}></small><br>
					<{if $displayeventlogo == 1}>
					<img src="<{$xoops_url}>/uploads/countdown/images/<{$events.logo}>" alt="<{$events.name}>" title="<{$events.name}>" class="img-fluid"><br><{/if}>
					<span class="text-body"><{$events.name}></span>
					<br><small><{$events.date|date_format:"%A, %B %e %Y %l:%M %p"}></small><br>
					  <{if $displayeventdescription == 1}>
					  <{$events.description}><{/if}>
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
					
				  
				  <{if $displaypostinfo == 1}>
				 <p><small><span class="fa fa-info-circle"></span>&nbsp;<{$events.postinfo}></small></p><{/if}>
				 <!--<span class="fa fa-calendar"></span>
                  <{if $events.date_created == $events.date_updated}>
                       <small><{$events.date_created|date_format}></small>
                  <{else}>
                        <small><{$events.date_updated|date_format}></small>
                  <{/if}>
				  <small><span class="fa fa-user-circle-o"></span> <{$events.postername}>  <span class="fa fa-tag"></span> <{$events.category}></small>
                     --> 
			
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
            
          
<br><div id="pagenav"><{$pagenav}></div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>

<{include file="db:countdown_footer.tpl"}>




