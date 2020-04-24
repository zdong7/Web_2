<head>
    <title>Abet web - Login</title>
    <link rel="stylesheet" href="login.css">
</head>


<body>
    <div id="sign-in">
        Please Sign In
    </div>

    <form method="GET" action="logAut.php">
        <div class="NotAuthorized"  id="NotAuthorized" >
            <?php
                if($_GET['failed']) echo('invalid e-mail or password');
            ?>
        </div>
        <div class="Authorized" id="Authorized">
            <?php
                if($_GET['logout']){
				    session_start();
				    $_SESSION['user_data'] = '';
				    echo ('Logout success');
			};
		  ?>
        </div>
        <div id="top">
            <input type="email" name="email" placeholder="E-mail" required>
        </div>
        <div id="bot">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div id="login">
            <input type="submit" value="login">
        </div>
    </form>
</body>

