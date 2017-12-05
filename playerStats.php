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
    <li class = "navLink"><a href = "b.html" class = "topLink">Schedule B</a></li>
    <li class = "navLink"><a href = "c.html" class = "topLink">Schedule C</a></li>
    <li class = "navLink"><a href = "viewDB.html" class = "topLink">View Database</a></li>
  </ul>
</div>

<div id ="body">
<br>
<br>
<br>

<?php 
    include("connection.php");

	$id = $_GET["id"];
	$games = $_GET["games"];
	$year = $_GET["year"];
	$team = $_GET["team"];
	$ppg = $_GET["ppg"];
	$apg = $_GET["apg"];
	$rpg = $_GET["rpg"];
	$steal = $_GET["steal"];
	$block = $_GET["block"];
	$threep = $_GET["3p"];
	$fg = $_GET["fg"];

	$sql = "INSERT INTO Ppstats values (".$id.",
					     ".$games.",
				              ".$year.",
					     '".$team."',
					      ".$ppg.",
					      ".$apg.",
					      ".$rpg.",
					      ".$steal.",
					      ".$block.",
					      ".$threep.",
					      ".$fg.")";

	if ($mysqli_conn->query($sql) === TRUE) {
    		echo "New record created successfully";
	} 
	else {
	    echo "Error: " . $sql . "<br>" . $mysqli_conn->error;
	}
	
	$mysqli_conn->close();
?> 

<br>

INCOMPLETE:
Sort by: <a href="sort.php?sort=student_name">Names</a> OR <a href="sort.php?sort=grade">Grades</a>
</div>
</body>
</html>
