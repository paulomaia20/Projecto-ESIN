<?php
  include('config/init.php');
  include('templates/header.php');
  include('templates/navbar.php');
?>

<link href="css/mainstyle.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/error_message.css" rel="stylesheet" type="text/css">


</head>

<body>
	<img id="skyline" src="img/theskyline4.jpg" alt="Sky Line">
	<div id="section1">
		<h1 id="name"><b>Recycle</b>ABit</h1>
	</div>

	<div class="row">
		<div id="introduction" class="col-6">
		 Junta-te a nós!
		</div>
		<div class="col-6">
			<div class="loginbox">
				<h2>Inscreve-te gratuitamente:</h2>
				<div>
					<p>O nome de utilizador deve conter entre 1 e 20 caracteres; contendo apenas letras de A a Z, números de 0 a 9,
                        hifens ou traços sublinhados, não podendo ser incluso quaisquer termos inapropriados.</p>
                        
          <form method="post" action="action_register.php" enctype="multipart/form-data">

						<input type="text" name="name" placeholder="Nome de Utilizador" required pattern="[a-z][a-z0-9]{1,15}" title="Username must must start whith a letter and contain only lowercase letters and numbers!">
						<input type="text" name="email" placeholder="E-mail" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Please input a valid email (example@email.com)!">
						<input type="password" placeholder="Senha" name="password" required pattern="[^s?]{6,}" title="Six or more characters">
						<input type="password" placeholder="Confirmar senha" name="confirm_password" required pattern=".{6,}" title="Six or more characters">
						
						<label for="avatar"><p>Avatar:</p></label>
						<input type="file" name="image">
						
						<input type="submit" value="Inscrever">
					</form>

<div class="error_message">
<?php  	
 if(isset($_ERROR_MESSAGE))
    {
        echo $_ERROR_MESSAGE; //ver init.php 
	}  
	?> 
</div>
				</div>
			</div>
		</div>
	</div>
	<div id="sobrenos" class="row">
		<h2> Sobre Nós </h2>
	</div>
	<div class="row">
		<div class="col-4">
			<h3>Bruno Santos</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
		</div>
		<div class="col-4">
			<h3>Diogo Malafaya</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
		</div>
		<div class="col-4">
			<h3>Paulo Maia</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
		</div>
	</div>

	<footer>
		<img id="treeline" src="img/treeline5.jpg" alt="Tree Line">
	</footer>
</body>

</html>