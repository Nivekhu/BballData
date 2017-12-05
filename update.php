<html>
<body>

<?php 
      	include("connection.php");
	
	$id = $_GET["id"];
	$name = $_GET["name"];
	$jersey = $_GET["jersey"];
	$salary = $_GET["salary"];
	$injury = $_GET["injured"];
	$position = $_GET["position"];
	$coachid = $_GET["coachID"];
	$teamid = $_GET["teamID"];

	if($injury == ""){
		$injury = 0;	
	}
	$sql = "INSERT INTO Pplayers values (".$id.",
					     '".$name."',
				              ".$jersey.",
					      ".$salary.",
					      ".$injury.",
					      '".$position."',
					      ".$coachid.",
					      ".$teamid.")";

	if ($mysqli_conn->query($sql) === TRUE) {
    		echo "New record created successfully";
	} 
	else {
	    echo "Error: " . $sql . "<br>" . $mysqli_conn->error;
	}
	
	$mysqli_conn->close();
?> 

<br>
Sort by: <a href="sort.php?sort=student_name">Names</a> OR <a href="sort.php?sort=grade">Grades</a>

</body>
</html>
