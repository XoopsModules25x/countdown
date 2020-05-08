#<{$block.id}>	<{*<{$block.uid}>*}><br>


				<img src="<{$xoops_url}>/uploads/countdown/images/<{$block.logo}>" alt="<{$block.name}>" title="<{$block.name}>" class="img-fluid"><br>
     
				<strong><{$smarty.const._MB_COUNTDOWN_EVENTS_NAME}></strong>   <br>        
					<a href="event.php?id=<{$block.id}>"><{$block.name}></a>
				<br>
				<strong> <{$smarty.const._MB_COUNTDOWN_EVENTS_DESCRIPTION}> </strong><br>            
					<{$block.description}>
				<br>
				<strong><{$smarty.const._MB_COUNTDOWN_EVENTS_DATE}> </strong><br>
						<{$block.date}>
                <br>
				<strong><{$smarty.const._MB_COUNTDOWN_TIME_REMAINING}> </strong><br>
               <div id="timer<{$block.id}>" class="timer">
<!--  Timer Component  -->
  <Timer 
         starttime="<{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}>" 
         endtime="<{$block.dateiso}>" 
         trans='{  
         "day":"Day",
         "hours":"Hours",
         "minutes":"Minuts",
         "seconds":"Seconds",
         "expired":"Event has been expired.",
         "running":"Till the end of event.",
         "upcoming":"Till start of event.",
         "status": {
            "expired":"Expired",
            "running":"Running",
            "upcoming":"Future"
           }}'
         ></Timer>
<!--  End! Timer Component  -->
</div>


<script>
 Vue.component('Timer',{
	template: `
  	<div>
      <div class="day">
        <span class="number">{{ days }}</span>
        <div class="format">{{ wordString.day }}</div>
      </div>
      <div class="hour">
        <span class="number">{{ hours }}</span>
        <div class="format">{{ wordString.hours }}</div>
      </div>
      <div class="min">
        <span class="number">{{ minutes }}</span>
        <div class="format">{{ wordString.minutes }}</div>
      </div>
      <div class="sec">
        <span class="number">{{ seconds }}</span>
        <div class="format">{{ wordString.seconds }}</div>
      </div>
      <div class="message">{{ message }}</div>
      <div class="status-tag" :class="statusType">{{ statusText }}</div>
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
  el: "#timer<{$block.id}>",
});
</script>

                <br>					
					 <p class="text-muted"><span class="fa fa-calendar"></span>
                                                        <{if $block.date_created == $block.date_updated}>
                                                            <small><{$block.date_created|date_format}></small>
                                                        <{else}>
                                                            <small><{$block.date_updated|date_format}></small>
                                                        <{/if}>
														<span class="fa fa-user-circle-o"></span> <{$block.postername}> <span class="fa fa-tag"></span> <{$block.category}>
                      </p>
					
	
	