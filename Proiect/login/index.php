<?php
include "../baza_date/connect_cocan.php ";
include "login_user.php ";
if(isset($_SESSION['user'])){
	header("Location: ../baza_date/profile ");
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<title>Test</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/menu_style.css">
	<link rel="stylesheet" href="../css/login_style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<header>
		<?php include "../baza_date/meniu.php "; ?>
	</header>
	<img class="wave" src="../imagini/wave.png" alt="un val verde">
	<div class="container">
		<div class="img">
			<img src="../imagini/bg.svg" alt="versiune mobil">
		</div>
		<div class="login-content">
			<form action="index " method = "post">
				<img src="../imagini/avatar.svg" alt="avatar">
				<h2>Bine ai revenit!</h2>
				<?php
					 if (isset($_SESSION["ok_pass"]) && ($_SESSION["ok_pass"]==1)){
		 							echo "<div class='ok_pass'>
									<p>Te-ai înregistrat cu succes!<p>
									</div>";
								}
			 		include("../baza_date/errors.php ");
			 ?>
           		<div class="input-div user">
           		   		<i class="fa fa-envelope" aria-hidden="true"></i>
           		   <div class="div">
           		   		<input type="text" name="email" class="input" required>
						<label>Email</label>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		    	<i class="fa fa-lock" aria-hidden="true"></i>
           		   <div class="div">
           		    	<input type="password" name="parola" class="input" required>
						<label>Password</label>
            	   </div>
            	</div>
            	<a class="forma" href="#">Ai uitat parola?</a>
				<a class="forma" href="../register/register ">Creează un cont nou</a>
            	<input type="submit" class="btn" name="login_btn" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
