<!DOCTYPE html>
<html>
	<head>
		<title>register</title>
		<meta charset="UTF-8">
		<style>
			html, body {
				height: 100%;
				font-family: consolas;
			}

			body {
				margin: 0;
			}

			.masthead {
				background-color: black;
				width:100%;
				height: 100px;
				text-align: center;
				position:absolute;
			}
			.home {
				color: white;
				position: absolute;
				left: 13px;
				text-decoration: none;
				font-size: 1.8em;
				line-height: 25px;
			}
			
			form {

				background: whitesmoke;
				margin: auto;
				position: relative;
				top:100px;
				right:5px;
				width: 300px;
				height: 200px;
				font-size: 14px;
				line-height: 24px;
				font-weight: bold;
				color: black;
				text-decoration: none;
				border-radius: 10px;
				padding: 10px;
				border: 1px solid #999;
				border: inset 1px solid #333;
				box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
			}
			input[type="text"] {
				margin-top: 7px;
				padding: 4px;
				border: solid 3px #c9c9c9;
				transition: border 0.3s;
			}

			input[type="password"] {
				margin-top: 6px;
				padding: 4px;
				border: solid 3px #c9c9c9;
				transition: border 0.3s;
			}

			input[type="submit"] {

				width: 100px;
				position: absolute;
				right: 20px;
				bottom: 20px;
				background: rgb(39, 39, 50);
				color: white;
				height: 30px;
				border-radius: 15px;
				border: 1p solid #999;
			}
		</style>
	</head>
	<body>
		<header class="masthead">
			<a href="sharefolio.php" class="home"><h1>SHAREFOLIO</h1></a>
			</header>
			
			<form name="signup_form" method="post" action="signup_ck.php" >
				ID :
				<input type="text" name="user_id" />
				<br />
				E-mail :
				<input type="text" name="user_email" />
				<br />
				PW :
				<input type="password" name="user_pass" />
				<br />

				<input type="submit" value="join" />
			</form>
			
	</body>
</html>


