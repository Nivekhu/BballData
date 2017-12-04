<html> 
<body> 
<?php 
      include("connection.php");
      mysql_select_db("huk",$mydb); 
      $result = @mysql_query("SELECT * FROM employee",$mydb); 
      printf("First Name: %s<br>\n", mysql_result($result,0,"fname")); 
	printf("Last Name: %s<br>\n", mysql_result($result,0,"lname")); 
      printf("Address: %s<br>\n", mysql_result($result,0,"address")); 
      printf("SSN: %s<br>\n", mysql_result($result,0,"ssn")); 

?> 
</body> 
</html>
