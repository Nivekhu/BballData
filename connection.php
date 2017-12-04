<?php 
$mydb = @mysql_connect("student2.cs.appstate.edu/huk", "huk", "900502862"); 
if( !$mydb) 
{ 
    echo( "Connection to database server failed <br>"); 
    exit( ); 
}
