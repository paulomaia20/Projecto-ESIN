<?php
  include ('config/init.php');
  include('templates/header.php');  
?>

	<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
	<link href="css/form.css" rel="stylesheet" type="text/css">
	<title>RecycleABit</title>
</head>

<body>
<?php include('templates/navbar.php'); ?> 

	<img id="skyline" src="img/theskyline4.jpg" alt="Sky Line">
	<div id="section1">
		<h1 id="name"><b>Recycle</b>ABit</h1>
	</div>
	<div class="form-login">
       <form  method="post" action="action_login.php">
		<input type="text" name="name" placeholder="Nome de Utilizador">
		<input type="password" placeholder="Senha" name="password">
        <input type="submit" value="Log In">
        </form> 
	</div>

	<div class="error_message">
<?php  	
 if(isset($_ERROR_MESSAGE))
    {
        echo $_ERROR_MESSAGE; //ver init.php 
	}  
	?> 
</div>

	<p id="inscreve-te"> Não tens uma conta no RecycleABit? <a href="register.php">Inscreve-te!</a></p>
</body>