<!doctype html>
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
</style>
<title>Create Database</title>
</head>

<body>
<h2>SetupDB</h2>
<a href="index.php">Go to Home page</a>
<?php
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

echo "<h3>Prepare DB creating table presenze</h3>";
//Add a new table to the database called users
$sql="CREATE TABLE IF NOT EXISTS presence (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_users varchar(50) NOT NULL,
  data Date NOT NULL,
  hour_in varchar(8) NOT NULL default '08:30:00',
  hour_out varchar(8) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=2";

// stampa di controllo
echo "<h4>Query SQL: $sql</h4>";
//esecuzione della query
$ok= mysql_query($sql,$conn);
if (!$ok)
die("Error query: ".mysql_error());
else{
echo "<h2>Table presence created</h2>";
}

// Set up database insert some fake data
echo "<h3>Insert some presence</h3>";
$sql="INSERT INTO presence (id_users, data, hour_in,hour_out) VALUES ('1', Date('11/11/2013'),'08:30','13:30'),".
"('1', Date('12/11/2013'),'08:30','13:30'),".
"('1', Date('13/11/2013'),'08:30','13:30')";
// stampo la query che eseguiro'
echo "<h3>Setting up presence</h3>";
echo "$sql"."<br>";
//esecuzione della query
$ok=mysql_query($sql,$conn);
if (!$ok)
die("<h1>Error query: </h1>".mysql_error());
else
print "<h2>Inserted data</h2>";

//Read all of the data from the table and print it in an HTML table
//this work only if connection is already open.
$sql="SELECT * FROM presence";
// stampa di controllo
echo "query SQL: $sql"."<br>";
//esecuzione della query
$res=mysql_query($sql,$conn);
if (!$res)
die("Errore query: ".mysql_error());

//recupero i record inseriti (se presenti)
$rows=mysql_num_rows($res);
echo "<h3>Find $rows users";

if ($rows==0) {
// controllo se la risposta è vuota
echo "<h3>No record found</h3>";
}
else {
// altrimenti li visualizzo in una tabella
print "<table>";
print "<tr>
<th>Id</th>
<th>Day</th>
<th>Hour IN</th>
<th>Hour Out</th>
</tr>";
//ciclo su tutti i record id`, `details`, `date_posted`, `time_posted`, `date_edited`, `time_edited`, `public`
while ($row=mysql_fetch_array($res)) {
print "<tr><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td></tr>";
}
print "</table>";
}

// Close the connection before leaving
mysql_close($conn);
echo "<h3>Close connection<h3>";

}catch(Exception $e) {
die('Generic Error');
}
?>
<footer>
<h3><a href="index.php">Go to Home page</a></h3>
</footer>
</body>
</html>
