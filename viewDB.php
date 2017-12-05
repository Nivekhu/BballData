<html>
<body>

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
Go back: <br>
<a href="index.html">Insert Players</a><br>
<a href="playerStat.html">Insert Player Stats</a><br>
<a href="viewDB.html">View Database</a><br>

INCOMPLETE:
Sort by: <a href="sort.php?sort=student_name">Names</a> OR <a href="sort.php?sort=grade">Grades</a>

</body>
</html>