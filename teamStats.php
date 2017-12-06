<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>
		Football
	</title>

	<link rel = "icon" href = "bball.png">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Catamaran:100|Quicksand:300" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<div id = "topBar">
		<h2 class = "head">
			Lacross
		</h2>
	</div>
	<div id="navBar">
   <ul>
    <li class = "navLink"><a href = "index.html" class = "topLink">Insert Players</a></li>
    <li class = "navLink"><a href = "playerStat.html" class = "topLink active">Add Player Stats</a></li>
    <li class = "navLink"><a href = "team.html" class = "topLink">Add Team</a></li>
    <li class = "navLink"><a href = "coach.html" class = "topLink">Insert Coaches</a></li>
    <li class = "navLink"><a href = "remove.html" class = "topLink">Find/Remove Elements</a></li>
    <li class = "navLink"><a href = "viewDB.html" class = "topLink">View Database</a></li>
  </ul>
</div>

<div id ="body">
<br>
<br>
<br>

<?php 
    include("connection.php");

	$year = $_GET["year"];
	$name = $_GET["name"];
	$games = $_GET["games"];
	

	$sql = "INSERT INTO Ptstats 
		values ('".$name."',".$games.",".$year.",
		(SELECT avg(ppg) from Ppstats WHERE team LIKE '%".$name."%'),
		(SELECT avg(apg) from Ppstats WHERE team LIKE '%".$name."%'),
		(SELECT avg(rpg) from Ppstats WHERE team LIKE '%".$name."%'),
		(SELECT avg(stl) from Ppstats WHERE team LIKE '%".$name."%'),
		(SELECT avg(blk) from Ppstats WHERE team LIKE '%".$name."%'),
		(SELECT avg(3p) from Ppstats WHERE team LIKE '%".$name."%'),
		(SELECT avg(fg) from Ppstats WHERE team LIKE '%".$name."%'));";

	if ($mysqli_conn->query($sql) === TRUE) {
    		echo "New record created successfully";
	} 
	else {
	    echo "Error: " . $sql . "<br>" . $mysqli_conn->error;
	}
	
	$mysqli_conn->close();
?> 

<br>
</div>


<div id = "bottomBar">
  <ul>
</ul>

 <ul>
   <li>
     &nbsp;
   </li>
 </ul>
 <ul>

  <li>
    <a href = "https://github.com/Nivekhu/BballData" target="_blank"><i class="fa fa-github" style="font-size:36px"></i></a>
  </li>
</ul>
</div>
</body>
</html>
