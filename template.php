<html>
	<head>
		<title>Template</title>
		<?
	  	  include('head.php');	
		?>
	</head>
	<body>
	  <div class="page">
		<?
		   include('header.php');
		   echo"<br>";
		   include('menu.php');
		?>
		<br>
		<div class="content">
			<div class="leftwindow">
			<!--Working Area.. Place your code/Include your file here --->
				
			</div>
			
			<div class="rightwindow">
			<?
			   include('calender.php');
			?>
			</div>
		</div>
		<div class="cleaner">
		</div>
		<div class="bottom">
		</div>
		<div class="status">
			&copy;&nbsp;Powered by <a href="http://csmit.org" target="_blank">Computer Society Of MIT</a>&nbsp;&nbsp;
		</div>            
	  </div>
	</body>
</html>
