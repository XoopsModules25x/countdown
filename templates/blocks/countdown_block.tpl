<style>
hr.style1{
	border-top: 1px dashed #f1f1f1;
}


.circle-badge {
  height: 60px;
  width: 60px;
  line-height:60px;
  text-align: center;
  border-radius: 50px;
  background: #1ACAC0;
  color:white;
  margin-left:auto;
  margin-right:auto;
}

.countdown li {
  display: inline-block;
  font-size: 1.0em;
  font-weight:bold;
  list-style-type: none;
  padding: 1em;
  text-transform: uppercase;
}

.countdown li span {
  display: block;
  font-size: 2.5rem;
}
</style>

	<{assign var="event_id" value=$block.event_id}>
	
	<{php}>
	

	$event_id=$this->get_template_vars('event_id'); 
//echo "$event_id";			


// The current date
	date_default_timezone_set("Asia/Kuching");
$date = date('Y-m-d');
      global $xoopsDB;
$result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("countdown_events")." WHERE id IN ($event_id)"); 


			
     

			
			

while($row=$xoopsDB->fetchArray($result)) {
			
		$name=$row['name'];
		$description=$row['description'];	
		$enddatetime=$row['enddatetime'];	
		$eventdate = date("Y-m-d", strtotime($enddatetime));
		$displaydate = date("d.m.Y", strtotime($enddatetime));
		
		

	if ($date <= $eventdate) {
		
	 echo "<div class='container-fluid'><div class='row text-center'><div class='alert alert-info alert-dismissable fade in'>";
			echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
			echo "<h2>COUNTDOWN</h2>";   
			echo "<h4>$name</h4>";
			echo "<h4><i class='fa fa-calendar-check-o' aria-hidden='true'></i> $displaydate</h4>";
			if ($description !=''){echo "$description";}
			
			date_default_timezone_set("Asia/Kuching");
			$today = new DateTime(); // This object represents current date/time
$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

//echo "Current Date : ";
$currentdate=$today ->format('Y-m-d'); 
//echo $currentdate;

//echo "<br /><br />";

//echo "Event Date: $eventdate";;
//echo "<br /><br />";
//$match_date = DateTime::createFromFormat( "Y.m.d\\TH:i", $eventdate );
$match_date = DateTime::createFromFormat( "Y-m-d", $eventdate );
$match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$diff = $today->diff( $match_date );
$diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

switch( $diffDays ) {
    case 0:
             //  echo "<button type='button' class='btn btn-success'>Today</button>";
        break;
    case -1:
       // echo "<button type='button' class='btn btn-default'>Yesterday</button>";
        break;	
    case +1:
      echo "<br /><button type='button' class='btn btn-danger btn-lg'>Tomorrow</button>";
	  
        break;	
    default:

	if ($diffDays > 1) {
		//echo "//Future Event<br />";
		
list($y,$m,$d) = explode('-', $diff->format('%y-%m-%d'));
if ($matchdate < $eventdate ) {
    $months = $y*12 + $m;
    $weeks = floor($d/7);
    $days = $d%7;
echo "<ul class='countdown'>";
    //printf('Countdown To Event : ');
    if ($months) {printf('<li><span id="month" class="circle-badge">%d</span> month%s </li>', $months, $months>1?'s':'');}
    if ($weeks) {printf('<li><span id="week" class="circle-badge">%d</span> week%s </li>', $weeks, $weeks>1?'s':'');}
    if ($days) {printf('<li><span id="day" class="circle-badge">%d</span> day%s </li>', $days, $days>1?'s':'');}
echo "</ul>";	
	
    }	
}
else
{
//echo "Past Event";	
}
	
        break;	

		
		

}
			
		
			
		} //stay visible	

	echo "</div></div></div>";			
        }
      






	<{/php}>