<!DOCTYPE html>
<html>

<head>
	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	<link href="css/form.css" rel="stylesheet" type="text/css">
	<link href="css/navbar.css" rel="stylesheet" type="text/css">

	<link href="https://fonts.googleapis.com/css?family=Catamaran:800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,800" rel="stylesheet">
	<title>RecycleABit</title>
</head>
</html>

<body>
	<div class="main-navbar">
		<a class="navbar-brand" href="mainpage.html"><b>Recycle</b>ABit</a>
			<ul class="nav navbar-nav">
				<li><a href="mainpage.html" class="active">Home</a></li>
				<li><a href="https://en.wikipedia.org/wiki/About">About</a></li>
				<li><a href="https://pt.wikipedia.org/wiki/Experience">FAQ</a></li>
			</ul>
		</div>

	<img id="skyline" src="img/theskyline4.jpg" alt="Sky Line">
	<div id="section1">
		<h1 id="name"><b>Recycle</b>ABit</h1>
	</div>
	<div class="row">
        <form method="post" action="action_login.php">
		<input type="text" name="name" placeholder="Nome de Utilizador">
		<input type="password" placeholder="Senha" name="password">
        <input type="submit" value="Log In">
        </form>
	</div>
	<p id="inscreve-te"> Não tens uma conta no RecycleABit? <a href="mainpage.html">Inscreve-te!</a></p>
</body>