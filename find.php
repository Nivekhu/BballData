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
    <li class = "navLink"><a href = "coach.html" class = "topLink">Insert Coaches</a></li>
    <li class = "navLink"><a href = "remove.html" class = "topLink active">Find/Remove Elements</a></li>
    <li class = "navLink"><a href = "viewDB.html" class = "topLink">View Database</a></li>
  </ul>
</div>

<div id ="body">
<br>
<br>
<br>

<?php 
    include("connection.php");
	$db = $_GET["db"];
	$search = $_GET["search_term"];
	$remove = $_GET["remove"];
	
	//Players
	if($db == "Pplayers"){
		$sql = "SELECT * FROM Pplayers WHERE CONCAT
			(Pid, '_', Fname, '_', Lname, '_', Salary, '_', Position) LIKE '%".$search."%'";
		if($remove == 1){
			$sql = "DELETE FROM Pplayers WHERE CONCAT
				(Pid, '_', Fname, '_', Lname, '_', Salary, '_', Position) LIKE '%".$search."%'";
		}
		$result = $mysqli_conn->query($sql);
		
		if($result->num_rows == 0){
			echo "<table> <tr> <td> Item Not Found <td> </tr> </table>";
		}
		else if($remove == 1){
			echo "<table> <tr> <td>  Removed Items <td> </tr> </table>";
		}
		else{
			echo "<table id='currentTable'>";
			echo "<tr>".
				 "<th>Id</th><th>First Name</th><th>Last Name</th><th>Salary</th>" .
				 "<th>Position</th>".
				 " </tr> ";
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" .$row["Pid"] ."</td>" ."<td>" .$row["Fname"] ."</td>" .
				"<td>" .$row["Lname"] ."</td>" . "<td>" .$row["Salary"] ."</td>" .
				"<td>" .$row["Position"] ."</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	}

	//Player Stats
	else if($db == "Ppstats"){
		$sql = "SELECT * FROM Ppstats WHERE id = ".$search." ";
		if($remove == 1){
			$sql = "DELETE FROM Ppstats WHERE id = ".$search." ";
		}
		$result = $mysqli_conn->query($sql);
		
		if($result->num_rows == 0){
			echo "<table> <tr> <td> Item Not Found <td> </tr> </table>";
		}
		else if($remove == 1){
			echo "<table> <tr> <td>  Removed Items <td> </tr> </table>";
		}
		else{
			echo "<table id='currentTable'>";
			echo "<tr>".
				 "<th>Id</th> <th>Games</th> <th>Year</th> <th>Team</th>" .
				 "<th>PPG</th> <th>APG</th> <th>RPG</th> <th>STL</th>".
				 "<th>BLK</th> <th>3p%</th> <th>FG%</th>".
				 " </tr> ";
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" .$row["id"] ."</td>" ."<td>" .$row["games"] ."</td>" .
				"<td>" .$row["pYear"] ."</td>" . "<td>" .$row["Team"] ."</td>" .
				"<td>" .$row["ppg"] ."</td>" ."<td>" .$row["apg"] ."</td>".
				"<td>" .$row["rpg"] ."</td>" ."<td>" .$row["stl"] ."</td>".
				"<td>" .$row["blk"] ."</td>" ."<td>" .$row["3p"] ."</td>".
				"<td>" .$row["fg"] ."</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	}	

	//Teams
	else if($db == "Pteam"){
		$sql = "SELECT * FROM Pteam WHERE CONCAT
			(Name, '_', City) LIKE '%".$search."%' ";
		if($remove == 1){
			"DELETE FROM Pteam WHERE CONCAT
			(Name, '_', City) LIKE '%".$search."%' ";
		}
		$result = $mysqli_conn->query($sql);
		
		if($result->num_rows == 0){
			echo "<table> <tr> <td> Item Not Found <td> </tr> </table>";
		}
		else if($remove == 1){
			echo "<table> <tr> <td>  Removed Items <td> </tr> </table>";
		}
		else{
			echo "<table id='currentTable'>";
			echo "<tr>".
				 "<th>Team Name</th> <th>Team City</th>" .
				 " </tr> ";
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" .$row["Name"] ."</td>" ."<td>" .$row["City"] ."</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	}

	//Team Stats
	else if($db == "Ptstats"){
		$sql = "SELECT * FROM Ptstats WHERE Name LIKE '%".$search."%' ";
		if($remove == 1){
			$sql = "DELETE FROM Ptstats WHERE Name LIKE '%".$search."%' ";
		}
		$result = $mysqli_conn->query($sql);
		
		if($result->num_rows == 0){
			echo "<table> <tr> <td> Item Not Found <td> </tr> </table>";
		}
		else if($remove == 1){
			echo "<table> <tr> <td>  Removed Items <td> </tr> </table>";
		}
		else{
			echo "<table id='currentTable'>";
			echo "<tr>".
				 "<th>Name</th> <th>Games</th> <th>Year</th>" .
				 "<th>PPG</th> <th>APG</th> <th>RPG</th> <th>STL</th>".
				 "<th>BLK</th> <th>3p%</th> <th>FG%</th>".
				 " </tr> ";
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" .$row["Name"] ."</td>" ."<td>" .$row["Games"] ."</td>" .
				"<td>" .$row["Year"] ."</td>" . "<td>" .$row["PPG"] ."</td>" .
				"<td>" .$row["APG"] ."</td>".
				"<td>" .$row["RPG"] ."</td>" ."<td>" .$row["Steal"] ."</td>".
				"<td>" .$row["Block"] ."</td>" ."<td>" .$row["3p"] ."</td>".
				"<td>" .$row["fg"] ."</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	}

	//Coach
	if($db == "Pcoach"){
		$sql = "SELECT * FROM Pcoach WHERE CONCAT
			(Cid, '_', Fname, '_', Lname, '_', Wins, '_', Losses) LIKE '%".$search."%'";
		if($remove == 1){
			$sql = "DELETE FROM Pcoach WHERE CONCAT
				(Cid, '_', Fname, '_', Lname) LIKE '%".$search."%'";
		}
		$result = $mysqli_conn->query($sql);
		
		if($result->num_rows == 0){
			echo "<table> <tr> <td> Item Not Found <td> </tr> </table>";
		}
		else if($remove == 1){
			echo "<table> <tr> <td>  Removed Items <td> </tr> </table>";
		}
		else{
			echo "<table id='currentTable'>";
			echo "<tr>".
				 "<th>Id</th> <th>First Name</th> <th>Last Name</th> <th>Wins</th>" .
				 "<th>Losses</th> <th>Win/Loss%</th>".
				 " </tr> ";
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" .$row["Cid"] ."</td>" ."<td>" .$row["Fname"] ."</td>" .
				"<td>" .$row["Lname"] ."</td>" . "<td>" .$row["Wins"] ."</td>" .
				"<td>" .$row["Losses"] ."</td>" ."<td>" .$row["WL"] ."</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
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
