<head>
	<link rel='stylesheet' href='login.css'>
</head>

<body>
	<div id="sign-in">
		<h1> Please Sign In </h1>
	</div>

	<form method='GET' action='autho.php'>
	  <p class="error" id="loginFail">
		  <?php
			if($_GET['failed']) echo('invalid e-mail or password');
		  ?>
	  </p>
	  <p class="success" id="logoutSuccess">
		  <?php
			if($_GET['logout']){
				session_start();
				$_SESSION['user_data'] = '';
				echo ('Logout success');
			};
		  ?>
	  </p>
	  <div>
		<input type="email" placeholder="E-mail" id='email' name='email'>
	  </div>
	  <div>
	  <input type="password" placeholder="Password" id='password' name='password'>
	  </div>
	  <div>
		<input type="submit" value="login" id="login">
		</div>
	</form>
</body>


