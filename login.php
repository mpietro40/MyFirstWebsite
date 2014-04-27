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
        <a href="index.php">Click here to go back</a><br/>
    </nav>
    <section>
		<form action="checklogin.php" method="post">
			Enter Username: <input type="text" name="username" required="required"/> <br/>
			Enter Password: <input type="password" name="password" required="required" /> <br/>
			<input type="submit" value="Login"/>
		</form>
    </section>
    <aside>
    </aside>
    <footer>
    </footer>      
   </body>
</html>
