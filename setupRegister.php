<html>
    <head>
	<style>
.codice{
color:red;
font-size:16px;
}
table, td, th
{
border:1px solid green;
}
th
{
background-color:green;
color:white;
}
table{
border-collapse:collapse;
}
.double{
  width:20px;
}
</style>
        <title>My first PHP Website</title>
	
	<script>
    function myFunction(id)
    {
       var r = confirm("Are you sure you want to delete this record?");
       if(r == true)
       {
          window.location.assign("delete.php?id=" + id);
       }
    }
</script>
    </head>
	
	
   <?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>
    <body>        
<?php 
echo "<h2>Home Page $user</h2>";
?>
 <!--Display's user name-->
        <a href="logout.php">Click here to go logout</a><br/><br/>
        <form action="add.php" method="POST">
           Add more to list: <input type="text" name="details" /> <br/>
           Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
           <input type="submit" value="Add to list"/>
        </form>
    <h2>My presence</h2>
   <?php
   //check when I'm present
   try{
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
echo "<h2>Retrieved user_id: $user_id</h2>";
}
// -----------------------
echo "<h3>Select from DB all the user presence</h3>";
//Add a new table to the database called users
$sql="select users.username, presence.data, presence.hour_in,presence.hour_out from users,presence where users.id = presence.id_users AND users.id='$user_id'";
// stampa di controllo
echo "<h4>Query SQL: $sql</h4>";
//esecuzione della query
$res= mysql_query($sql,$conn);
if (!$res)
die("Error query: ".mysql_error());
else{
echo "<h2>Retrieved presence</h2>";
}
//recupero i record inseriti (se presenti)
$rows=mysql_num_rows($res);
echo "<h3>Find $rows users";

if ($rows==0) {
// controllo se la risposta è vuota
echo "<h3>No record found</h3>";
}
else {

//Create table presence
print "<table>";
$matrix=
while ($row=mysql_fetch_array($res)) {
print "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td></tr>";
}
print "</table>";
}

// create table for all days of school

print "<table>";
$months=["September","October","November","December","January","February","March","April","May","June"];
for($jj=0;$jj<count($months);$jj++){
print "<tr><th>$months[$jj]</th>";
for($ii=1;$ii<=31;$ii++){
  echo "<td class='double'>$ii</td>";
}
print "</tr>";
}
print "</table>";

// Close the connection before leaving
mysql_close($conn);
echo "<h3>Close connection<h3>";

}catch(Exception $e) {
die('Generic Error');
}
?>
</body>
</html>
