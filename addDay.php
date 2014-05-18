<?php
session_start();
if($_SESSION['user']){
}
else{
header("location:index.php");
}
$user = $_SESSION['user']; //assigns user value
if($_SERVER['REQUEST_METHOD'] = "POST"){ //Added an if to keep the page secured
try
{
//connect the database.
$conn=mysql_connect("localhost","root","");
echo "<h3>DB connesso</h3>";

//selezioniamo il database su cui lavorare
$sql = "USE first_db";
$ok =mysql_query($sql,$conn);
if (!$ok)
die("<br>Unable to select DB: ".mysql_error());
else
echo "<h3>Selected the DB first_db</h3>";
//retrieve the user_id from username
echo "<h3>Select from DB the user_id</h3>";
//Add a new table to the database called users
$sql="select id from users where username = '$user'";
// stampa di controllo
echo "<h4>Query SQL: $sql</h4>";
//esecuzione della query
$res= mysql_query($sql,$conn);
if (!$res)
die("Error query: ".mysql_error());
else{
$row=mysql_fetch_array($res);
$user_id=$row[0];
}
/*DEBUG
$sql="SELECT CURRENT_DATE()";
$ok =mysql_query($sql,$conn);
if (!$ok)
die("<br>Unable to get data: ".mysql_error());
else{
  $row = mysql_fetch_array($ok);
  echo $row[0];
}
*///END DEBUG
$sql="INSERT INTO presence (id_users, data, hour_in,hour_out) VALUES ('$user_id', CURRENT_DATE(),'08:30','13:30')";
echo $sql;
$ok =mysql_query($sql,$conn);
if (!$ok)
die("<br>Unable to insert dato to DB: ".mysql_error());

// Close the connection before leaving
mysql_close($conn);
echo "<h3>Close connection<h3>";

}catch(Exception $e) {
die('Generic Error');
}
}//End IF
header("location:presence.php");
?>
