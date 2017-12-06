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
    <li class = "navLink"><a href = "team.html" class = "topLink">Add Team</a></li>
    <li class = "navLink"><a href = "remove.html" class = "topLink">Find/Remove Elements</a></li>
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
	echo "<table id='currentTable'>";	

	//Prints Players
	if ($result->num_rows > 0 && $db == "Pplayers") {
		echo "<tr>".
		     "<th>ID</th> <th>First Name</th> <th>Last Name</th>" .
		     "<th>Salary</th> <th>Position</th>" .
		     "</tr>";
    		while($row = $result->fetch_assoc()){
			echo "<tr>";
        		echo "<td> ".$row["Pid"]." </td>".
			     "<td> ".$row["Fname"]." </td>".
			     "<td>" .$row["Lname"]."</td>".
			     "<td>" .$row["Salary"]."</td>".
			     "<td>" .$row["Position"]."</td>";
			echo "</tr>";
    		}
	} 

	//Prints Player stats
	else if ($result->num_rows > 0 && $db == "Ppstats"){
		echo "<tr>".
		     "<th>ID</th> <th>Games</th> <th>Year Played</th>" .
		     "<th>Team</th> <th>PPG</th> <th>APG</th> <th>RPG</th>" .
		     "<th>Steals</th> <th>Blocks</th> <th>3 Point %</th> <th>Field Goal %</th>".
		     "</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td> ".$row["id"]." </td>".
			     "<td> ".$row["games"]." </td>".
			     "<td> ".$row["pYear"]." </td>".
			     "<td> ".$row["Team"]." </td>".
			     "<td> ".$row["ppg"]." </td>".
			     "<td> ".$row["apg"]." </td>".
			     "<td> ".$row["rpg"]." </td>".
			     "<td>" .$row["stl"]."</td>".
			     "<td> ".$row["blk"]." </td>".
			     "<td> ".$row["3p"]." </td>".
			     "<td>" .$row["fg"]."</td>";
			echo "</tr>";

    		}
	}

	//Prints Teams
	else if ($result->num_rows > 0 && $db == "Pteam"){
		echo "<tr>".
		     "<th>Name</th> <th>City</th>" .
		     "</tr>";
    		while($row = $result->fetch_assoc()){
			echo "<tr>";
        		echo "<td> ".$row["Name"]." </td>".
			     "<td> ".$row["City"]." </td>";
			echo "</tr>";
    		}
	}

	else {
    		echo "0 results";
	}

	echo "</table>";
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