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
    <li class = "navLink"><a href = "playerStat.html" class = "topLink">Add Player Stats</a></li>
    <li class = "navLink"><a href = "b.html" class = "topLink">Schedule B</a></li>
    <li class = "navLink"><a href = "c.html" class = "topLink">Schedule C</a></li>
    <li class = "navLink"><a href = "viewDB.html" class = "topLink active">View Database</a></li>
  </ul>
</div>

<div id ="body">
<br>
<br>
<br>

<?php 
    include("connection.php");

	$db = $_GET["db"];
	
	$sql = "SELECT * FROM ".$db."";
	
	//Error Checking
	if ($mysqli_conn->query($sql) === TRUE) {
    		echo "Record fetched successfully";
	} 
	else {
	    echo "Error: " . $sql . "<br>" . $mysqli_conn->error;
	}
	//End Error Checking

	$result = $mysqli_conn->query($sql);
	
	//Prints Players
	if ($result->num_rows > 0 && $db == "Pplayers") {
    		while($row = $result->fetch_assoc()) {
        		echo "id: ".$row["Pid"]." - Name: ".$row["Fname"]." ".$row["Lname"]." <br>";
    		}
	} 
	//Prints Player stats
	else if ($result->num_rows > 0 && $db == "Ppstats"){
		while($row = $result->fetch_assoc()) {
        		echo "id: ".$row["id"]." - Games: ".$row["games"]." ".$row["pYear"]." <br>";
    		}
	}
	else {
    		echo "0 results";
	}

	
	$mysqli_conn->close();
?> 

<br>

INCOMPLETE:
Sort by: <a href="sort.php?sort=student_name">Names</a> OR <a href="sort.php?sort=grade">Grades</a>
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