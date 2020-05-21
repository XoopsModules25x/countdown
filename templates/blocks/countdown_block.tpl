<link rel="stylesheet" type="text/css" href="<{$xoops_url}>/modules/countdown/assets/css/countdown.css">
<script src="<{$xoops_url}>/modules/countdown/assets/js/vue.min.js"></script>

<div id="timer<{$block.id}>" class="timer">
    <!--  Timer Component  -->
    <Timer
            starttime="<{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}>"
            endtime="<{$block.dateiso}>"
            trans='{
         "day":"<{$smarty.const._MB_COUNTDOWN_DAY}>",
         "hours":"<{$smarty.const._MB_COUNTDOWN_HOURS}>",
         "minutes":"<{$smarty.const._MB_COUNTDOWN_MINUTES}>",
         "seconds":"<{$smarty.const._MB_COUNTDOWN_SECONDS}>",
         "expired":"<{$smarty.const._MB_COUNTDOWN_EXPIRED}>",
         "running":"<{$smarty.const._MB_COUNTDOWN_TILLEND}>",
         "upcoming":"<{$smarty.const._MB_COUNTDOWN_TILLSTART}>",
         "status": {
            "expired":"<{$smarty.const._MB_COUNTDOWN_STATUS_EXPIRED}>",
            "running":"<{$smarty.const._MB_COUNTDOWN_STATUS_RUNNING}>",
            "upcoming":"<{$smarty.const._MB_COUNTDOWN_STATUS_FUTURE}>"
           }}'
    ></Timer>
    <!--  End! Timer Component  -->
</div>


<script>

    Vue.component('Timer', {
        template: `
	  <div class="rounded bg-gradient-0 text-white shadow p-5 text-center mb-5">
                    <p class="mb-0 font-weight-bold text-uppercase">
					<{if $block.displayeventlogo == 1}>
					<img src="<{$xoops_url}>/uploads/countdown/images/<{$block.logo}>" alt="<{$block.name}>" title="<{$block.name}>" class="img-fluid"><br><{/if}>
					<h4><a href="<{$xoops_url}>/modules/countdown/event.php?id=<{$block.id}>"><span class="text-body"><{$block.name}></span></a></h4>
					<small><{$block.date|date_format:"%A, %B %e %Y %l:%M %p"}></small><br>
					  <{$block.description}>
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
        <button id="btn-message" type="button" class="btn btn-countdown"> {{message}}</button>
        </li>
        <li class="list-inline-item pt-2">
        <button id="btn-status" type="button" class="btn btn-countdown"> {{statusText}}</button>
        </li>
        </ul>

        <{if $block.displayinfo == 1}>
        <p><small><span class="fa fa-info-circle"></span>&nbsp;<{$block.info}></small></p><{/if}>
        </div>
        `
    ,
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
