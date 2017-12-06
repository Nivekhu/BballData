<html>
<head>
	<link rel="stylesheet" type="text/css" href="theme.css">
	<title>View</title>

</head>

<body>
<center>
<table>
<tr>
	<td><a href="view.php?view=student"><button>Students</button></a></td>
	<td><a href="view.php?view=staff"><button>Staff</button></a></td>
	<td><a href="view.php?view=course"><button>Courses</button></a></td>
	<td><a href="view.php?view=extracurricular"><button>Extracurricular</button></a></td>
</tr>
</table>

<form action="view.php?view=student">
	Search:<input type="text" name="searchkey" value="">
	<input type="hidden" name="view" value="<?php echo $_GET["view"]?>">
	<input type="submit" value="Submit">
</form>

<?php 

$view = $_GET["view"];
$searchkey = $_GET["searchkey"];
//echo "VIEW: " . $view . "<br>";
//echo "SEARCHKEY: " . $searchkey . "<br>";


//TABLE VIEW OF SEARCHED DATA
if($searchkey != NULL)
{
	echo "Search Results:<br>";
	if($view == 'student')
	{
		include("connection.php");
		$sql = "SELECT * FROM Student WHERE CONCAT(studentId, '_', fname, '_', minit, '_', lname, '_', gender, '_', standing, '_', gEmail) LIKE '%".$searchkey."%'";
		
		$result = $conn->query($sql);
		echo "<table id='currentTable'>";
		echo "<tr>".
			 "<th>ID</th><th>First Name</th><th>M</th><th>Last Name</th>" .
			 "<th>Gender</th><th>Standing</th><th>Guardian Email</th>".
			 " </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo "<td>" .$row["studentId"] ."</td>" ."<td>" .$row["fname"] ."</td>" .
			"<td>" .$row["minit"] ."</td>" . "<td>" .$row["lname"] ."</td>" .
			"<td>" .$row["gender"] ."</td>" ."<td>" .$row["standing"] ."</td>" . 
			"<td>" .$row["gEmail"] ."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";
	
		$conn->close();
	}
	if($view == 'staff')
	{
		include("connection.php");
		$sql = "SELECT * FROM Staff WHERE CONCAT(fname, '_', minit, '_', lname, '_', role, '_', superID, '_', staffID, '_', CONVERT(salary, char)) LIKE '%".$searchkey."%'";
		
		$result = $conn->query($sql);
		echo "<table id='currentTable'>";
	echo "<tr>".
			"<th>ID</th>
			<th>First Name</th>
			<th>M</th>
			<th>Last Name</th>
			<th>Role</th>
			<th>Boss ID</th>
			<th>Salary</th>"
			." </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo 	"<td>" .$row["staffID"]. "</td>" .
					"<td>". $row["fname"]."</td>" .
					"<td>". $row["minit"]."</td>".
					"<td>". $row["lname"]."</td>".
					"<td>". $row["role"]."</td>".
					"<td>". $row["superID"]."</td>".
					"<td>". $row["salary"]."</td>";
			echo "</tr>";
		}
	echo "</table>";
		echo "<br>";
	
		$conn->close();
	}
	if($view == 'course')
	{
		include("connection.php");
		$sql = "SELECT * FROM course WHERE CONCAT(cId, '_', cName, '_', roomNumber, '_', cDescription) LIKE '%".$searchkey."%'";
		
		$result = $conn->query($sql);
		echo "<table id='currentTable'>";
	echo "<tr>".
			"<th>ID</th>
			<th>Course Title</th>
			<th>Room #</th>
			<th>Description</th>"
			." </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo 	"<td>" .$row["cId"]. "</td>" .
					"<td>". $row["cName"]."</td>" .
					"<td>". $row["roomNumber"]."</td>".
					"<td>". $row["cDescription"]."</td>";
			echo "</tr>";
		}
	echo "</table>";
		echo "<br>";
	
		$conn->close();
	}
	if($view == 'extracurricular')
	{
		include("connection.php");
		$sql = "SELECT * FROM extracurricular WHERE CONCAT(eName, '_', eType, '_', adminID) LIKE '%".$searchkey."%'";
		
		$result = $conn->query($sql);
		echo "<table id='currentTable'>";
	echo "<tr>".
			"<th>Name</th>
			<th>Type</th>
			<th>Administer ID</th>"
			." </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo 	"<td>" .$row["eName"]. "</td>" .
					"<td>". $row["eType"]."</td>" .
					"<td>". $row["adminID"]."</td>";
			echo "</tr>";
		}
	echo "</table>";
		echo "<br>";
	
		$conn->close();
	}
}
echo "Full List:<br>";
//TABLE VIEW OF ALL DATA
if($view == 'student')
{
	getAllStudents();
}
if($view == 'staff')
{
	getAllStaff();
}
if($view == 'course')
{
	getAllCourses();
}
if($view == 'extracurricular')
{
	getAllEC();
}
	
function getAllStudents(){
	include("connection.php");
	$sql = "SELECT * FROM Student";
	$result = $conn->query($sql);
	echo "<table id='currentTable'>";
	echo "<tr>".
			"<th>ID</th><th>First Name</th><th>M</th><th>Last Name</th>" .
			"<th>Gender</th><th>Standing</th><th>Guardian Email</th>".
			" </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo "<td>" .$row["studentId"] ."</td>" ."<td>" .$row["fname"] ."</td>" .
			"<td>" .$row["minit"] ."</td>" . "<td>" .$row["lname"] ."</td>" .
			"<td>" .$row["gender"] ."</td>" ."<td>" .$row["standing"] ."</td>" . 
			"<td>" .$row["gEmail"] ."</td>";
			echo "</tr>";
		}
	echo "</table>";
	
	$conn->close();
	
}

function getAllStaff(){
	include("connection.php");
	$searchkey = $_GET["searchkey"];
		/*
		if(strcmp($searchkey, ""))
		{
			echo "searchkey is empty";
		}
		else
		{
			echo "searchkey is not empty";
		}
		*/
		$sql = "SELECT * FROM Staff";
	
	// else
	// {
		// $sql = "SELECT * FROM Staff WHERE" .
				// "staffID LIKE ". $searchkey . " OR ".
				// "fname LIKE ". $searchkey . " OR ".
				// "minit LIKE ". $searchkey . " OR ".
				// "lname LIKE ". $searchkey . " OR ".
				// "role LIKE ". $searchkey . " OR ".
				// "superID LIKE ". $searchkey . " OR ".
				// "salary LIKE " $searchkey;
	// }
	$result = $conn->query($sql);
	echo "<table id='currentTable'>";
	echo "<tr>".
			"<th>ID</th>
			<th>First Name</th>
			<th>M</th>
			<th>Last Name</th>
			<th>Role</th>
			<th>Boss ID</th>
			<th>Salary</th>"
			." </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo 	"<td>" .$row["staffID"]. "</td>" .
					"<td>". $row["fname"]."</td>" .
					"<td>". $row["minit"]."</td>".
					"<td>". $row["lname"]."</td>".
					"<td>". $row["role"]."</td>".
					"<td>". $row["superID"]."</td>".
					"<td>". $row["salary"]."</td>";
			echo "</tr>";
		}
	echo "</table>";
	$conn->close();
	
}

function getAllCourses(){
	include("connection.php");
	$sql = "SELECT * FROM course";
	$result = $conn->query($sql);
	echo "<table id='currentTable'>";
	echo "<tr>".
			"<th>ID</th>
			<th>Course Title</th>
			<th>Room #</th>
			<th>Description</th>"
			." </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo 	"<td>" .$row["cId"]. "</td>" .
					"<td>". $row["cName"]."</td>" .
					"<td>". $row["roomNumber"]."</td>".
					"<td>". $row["cDescription"]."</td>";
			echo "</tr>";
		}
	echo "</table>";
	$conn->close();
	
}

function getAllEC(){
	include("connection.php");
	$sql = "SELECT * FROM extracurricular";
	$result = $conn->query($sql);
	echo "<table id='currentTable'>";
	echo "<tr>".
			"<th>Name</th>
			<th>Type</th>
			<th>Administer ID</th>"
			." </tr> ";	

		while($row = $result->fetch_assoc() ) {
			echo "<tr>";
			echo 	"<td>" .$row["eName"]. "</td>" .
					"<td>". $row["eType"]."</td>" .
					"<td>". $row["adminID"]."</td>";
			echo "</tr>";
		}
	echo "</table>";
	$conn->close();
	
}

?> 

<br>
<a href="add.php"><button>Add</button></a><br><br>
<a href="index.html"><button>Home</button></a>
</center>
</body>
</html>