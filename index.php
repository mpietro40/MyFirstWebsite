<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My PHP Website</title>
    </head>
    <body>
   <header>
        <h2>Login Page</h2>
    </header>
    <nav>    
		<a href="login.php">Click here to login</a> <br/>
		<a href="register.php">Click here to register</a><br/>
                <a href="setupDB.php"><h2 style="color:red;">TO BE USED ONLY ONE TIME IN SET UP ENVIRONMENT PHASE</h2></a><br/>
    </nav>
    <section>
    	<h2 align="center">List</h2>
	<table width="100%" border="1px">
			<tr>
				<th>Id</th>
				<th>Details</th>
				<th>Post Time</th>
				<th>Edit Time</th>
			</tr>
			<?php
				mysql_connect("localhost", "root","") or die(mysql_error()); //Connect to server
				mysql_select_db("first_db") or die("Cannot connect to database"); //connect to database
				$query = mysql_query("Select * from list Where public='yes'"); // SQL Query
				while($row = mysql_fetch_array($query))
				{
					Print "<tr>";
						Print '<td align="center">'. $row['id'] . "</td>";
						Print '<td align="center">'. $row['details'] . "</td>";
						Print '<td align="center">'. $row['date_posted']. " - ". $row['time_posted']."</td>";
						Print '<td align="center">'. $row['date_edited']. " - ". $row['time_edited']. "</td>";
					Print "</tr>";
				}
			?>
	</table>
	</section>
    <aside>
    </aside>
    <footer>
    </footer>    
    </body>
</html>
