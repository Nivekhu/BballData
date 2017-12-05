<html>
<body>

<?php 
      	include("connection.php");
	
	$id = $_GET["id"];
	$fname = $_GET["fname"];
	$lname = $_GET["lname"];
	$salary = $_GET["salary"];
	$injury = $_GET["injured"];
	$position = $_GET["position"];

	if($injury == ""){
		$injury = 0;	
	}

	$sql = "INSERT INTO Pplayers values (".$id.",
					     '".$fname."',
					     '".$lname."',
					      ".$salary.",
					      ".$injury.",
					      '".$position."')";

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


INCOMPLETE:
Sort by: <a href="sort.php?sort=student_name">Names</a> OR <a href="sort.php?sort=grade">Grades</a>

</body>
</html>
