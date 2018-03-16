<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>SHAREFOLIO</title>

	<link rel="stylesheet" type="text/css" href="sub.css"/>
	<style>
	.f1 {
		display: flex;
		flex-flow: wrap;
		margin-left: 8%;
		margin-right: 8%;
		margin-top: 4%;
		background-color:whitesmoke;
	}

	</style>
</head>

<body>
	<header class="masthead">
		<a href="sharefolio.php" class="home"><h1>SHAREFOLIO</h1></a>
		<nav>
			<ul>

				
				<?php if (isset($_SESSION['is_logged'])) { ?>
				<li>
					<a href="logout.php" title="">Logout</a>
				</li>
				<li>
					<a href="projects.php" title="">Projects</a>
				</li>
				<?php } else { ?>
				<li>
					<a href="signup.php" title="">Register</a>
				</li>
				<li>
					<a href="login.php" title="">Login</a>
				</li>

				<?php } ?>
				<li> 
					<a href="main.html">Cafe</a>
				</li>
			</ul>
		</nav>
	</header>
	<section>

		<div class="f1">

			<?php

			include_once ('config.php');
			$db = @new mysqli('localhost:8889', 'root', 'root', 'member');
			if (mysqli_connect_errno()) {
				exit("DB connection error");
			}

			$result = $db -> query("select * from file_list");

			while ($row = $result -> fetch_assoc()) {

				//이미지 정보 가져오기
				$name = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $row['db_filename'];
				$imagesize = getimagesize($name);
				
				echo "<div><img style='border:2px solid black; border-radius: 15px; '. src='uploads/".$row['db_filename']."' width='200' height='200' />

				";
				echo  "
				<p style='color: black; font-size:1.2em; word-wrap: break-word; overflow: auto;'>" . $row['name'] . "</p>
				<div><a style='color: black;border:2px solid black; font-size:1.2em;text-decoration:none;'. href=".$row['demo'] . " target=_blank>" .$row['demo'] . "</a></div>
				<div><a style='color: black;border:2px solid black; font-size:1.2em;text-decoration:none;'. href=".$row['myurl'] . " target=_blank>" .$row['myurl']. "</a></div></div>
				
				" ;
				

			}

			?>

		</div>
	</section>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</body>
</html>