<html>
<head>
		<title>Calender</title>
		<script type="text/javascript" src="js/jquery-1.3.min.js"></script>
		<script type="text/javascript" src="js/coda.js"> </script>
		<script  type='text/javascript'>
			function popup(url) 
			{
				$('#open').popupWindow({ 
				windowURL:url, 
				windowName:'swip' 
				});	
			}
		</script>
</head>
<body background="background.jpg">
<link rel="stylesheet" href="css/style.css" type="text/css">
<?php
				
		$calendar = getCalendar($month,$year);
		function getCalendar($month = "" , $year = "")
		{
			$con=mysql_connect("localhost","root","");		//Coonect to mysql
			if(!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("kennisplay_cal",$con);		//select database
			$year=date("Y");		/*Current year as 2012*/
			$month=date("n");		/*Current month as 5*/	
			$day=date("j");		/*Current day as 1 (mon)*/		
			if (isset($_GET['m'])) 		//get variable from url 
			{
				$month = mysql_escape_string(htmlentities(strip_tags($_GET['m'])));
			}
			if (isset($_GET['y'])) 
			{
				$year = mysql_escape_string(htmlentities(strip_tags($_GET['y'])));
			}	
			$last_year = $year;
			$last_month = $month;
			$last_month--;
			if ("$last_month"=="0") 		//if month goes before jan, make it dec of previous year
			{
				$last_year--;
				$last_month = "12";
			}

			$next_year = $year;
			$next_month = $month;
			$next_month++;
			if ("$next_month"=="13")		//if month goes beyond dec, make it jan of next year
			 {
				$next_year++;
				$next_month = "1";
			}

			$no_of_days=date("t",mktime(0,0,0,$month,1,$year));    //no of days in a month
			$firstday=date("w",mktime(0,0,0,$month,1,$year));         /*Day on which first day falls*/
			$no_of_cells=$firstday + $no_of_days;		
			$no_of_weeks=ceil($no_of_cells/7);
			for($j=0;$j<$no_of_weeks;$j++)
			{
				for($i=0;$i<7;$i++)
				{
					$counter++;
					$week[$j][$i]=$counter;
					$week[$j][$i]-=$firstday;
					if(($week[$j][$i] < 1) || ($week[$j][$i] > $no_of_days))         
					{	
						$week[$j][$i] ="";		//make those cells before the first day and after last as empty
					}			
				}
			}
	
			echo "
			<table border='1' cellpadding='2' cellspacing='3'>
			<div style='text-align:center;'>
			<tr>
			<td colspan='1'><span style='float:left;'>
				<a href='$global[envself]?y=$last_year&m=$last_month' > <img src='leftarrow.png' height=30 width=30> </a><span>
			</td>
			<th colspan='5' background='calpad.jpg' > <span style='font-size:25px'>	
			";
			echo date('M', mktime(0,0,0,$month,1,$year)).' '.$year;  	//display current month and year
			echo "</span> </th>
	 		<td colspan='1'><span style='float:right;'>
			<a href='$global[envself]?y=$next_year&m=$next_month' ><img src='rightarrow.png' height=30 width=30> </a></span>
			</td>
				</tr>
			</div>
				<tr>
				<td align='center' background='calpad.jpg'> <b> Sun</b> </td>
				<td align='center' background='calpad.jpg'> <b>Mon</b></td>
				<td align='center' background='calpad.jpg'> <b>Tues</b></td>
				<td align='center' background='calpad.jpg'> <b>Wed</b></td>
				<td align='center' background='calpad.jpg'> <b>Thur</b></td>
				<td align='center' background='calpad.jpg'> <b>Fri. </b></td>
				<td align='center' background='calpad.jpg'> <b>Sat </b></td>
				</tr>
			";
			for($j=0;$j<$no_of_weeks;$j++)
				{
					
					echo "<tr>";
					for($i=0;$i<7;$i++)
					{	
						$url="http://localhost/details.php?yr=".$year."&dat=".$week[$j][$i]."&mn=".$month;		
						$rs1 = mysql_query("SELECT * FROM calender where month=$month and year=$year");
						if(($ro = mysql_fetch_assoc($rs1))&&($week[$j][$i]==$ro['day']))	//check if current date has any details in database
						{
							echo "<td align='center' background='background.jpg'> ";	//if so, make background diffrent
							echo "<span id='open'  onClick=popup('$url') > ";
							echo $week[$j][$i];		
							echo " </span>";
						}
						else
						{
							echo "<td align='center' background='calpad.jpg'> ";
							echo $week[$j][$i];		
						}
						
					}
					echo "</tr> ";
				}
			echo "</table>";
		}
?>
<div id="calendar_wrapper"><?PHP echo @$calendar ?></div>		<!-- call calender function -->
</body>
</html>