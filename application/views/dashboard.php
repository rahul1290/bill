<style>.fontH {font-family:Times New Roman;font-size:16px;}.font {font-family:Times New Roman;font-size:13px;}
.calendar { color:black;margin-left:0px;;width:100%;border:1px solid #CDCDCD; }
.weekday { text-align:center;width:14%;height:30px;border:1px solid #CCCCCC;font-style:oblique;font-family:Times New Roman; font-weight:bold; background-color:#FFFF9F; color:#000000; }
.day { border:1px solid #CCCCCC;width:14%;height:80px;vertical-align:top;font-style:oblique;font-family:Times New Roman; font-size:18px;} 
.leave { text-align:center;width:100%;height:30px;font-style:oblique;font-family:Times New Roman; font-weight:bold; background-color:#FFFF9F; color:#000000; }
</style>

    <table width="100%" border="0">
    <tr>
     <td style="width:40%;">
<?php $m=date("m"); if(date("m")==1 AND $m==12){$y=date("Y")-1;}else{$y=date("Y");} 
$mkdate = mktime(0,0,0, $m, 1, $y); $FDay = date('w',$mkdate); $pwkDay = date('w',$mkdate);
$days = date('t',$mkdate); $sieve = date("Y").$m.'01'; $day = '1';  $showBtn=1; ?>	
 
<?php /****** Calander Open ******/ ?>
<table class="calendar" cellpadding="2" cellspacing="0" border="0">
 <tr>
  <td class="weekday">Sunday</td><td class="weekday">Monday</td><td class="weekday">Tuesday</td>
  <td class="weekday">Wednesday</td><td class="weekday">Thursday</td><td class="weekday">Friday</td>
  <td class="weekday">Saturday</td>
 </tr>
 <tr>
<?php $weeks = '1'; $loopCount ='1'; while($loopCount<=$FDay){ ?>
	  <td class="day" style="height:<?php if($resCer['TimeApply']=='N'){echo 50;}?>px;width:<?php if($resCer['TimeApply']=='N'){echo 6;}?>%;"><img src="images/something.gif" alt="0"/></td>
<?php $loopCount++; } $FDay++; ?>
	  
<?php $nan=1; 
      while($day<=$days)
      { //While-Open
	  
	  ?>
	  
	  <td class="day" style="height:50px;width:6%;" bgcolor="<?php 
	  if(date("w",strtotime(date($y."-".$m."-".$day)))==0){echo '#428400';}else{echo '#FFFFFF';}?>" >
	 
	  
<?php /** Disply Records Open ****/?>				
<?php $lday=sprintf('%02d',$day); ?>
	  
<?php if($day>0){echo $day;}else{echo '';} ?>
<?php /* Disply Records Close ****/ ?>
		
	  </td> 
<?php if($FDay == '7'){echo '</tr><tr>'; $FDay='0'; $weeks++;} $day++; $sieve++; $FDay++; 
      } //While-Close ?>
	  
<?php $dim=$weeks*7; $lastdays=$dim-($days+$pwkDay); $lc=1; while($lc<=$lastdays){ ?>
        <td class="day" style="height:50px;width:6%;"><img src="images/something.gif" alt="0"/></td><?php $lc++; } ?>
 
 </tr>
</table>
<?php /****** Calander Close ******/ ?>

</td>
</tr>
</table>