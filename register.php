<?php

  include('config/init.php');
  include('templates/header.php');
  include('templates/navbar.php');

?>

<body>
    
	<img id="skyline" src="img/theskyline4.jpg" alt="Sky Line">
	<div id="section1">
		<h1 id="name"><b>Recycle</b>ABit</h1>
	</div>

	<div class="row">
		<div id="introduction" class="col-6">
			Este joguinho vai nos valer 3000€, por isso inscreve-te! Para alem disso vamos ter 20. Junta-te a nós!
		</div>
		<div class="col-6">
			<div class="loginbox">
				<h2>Inscreve-te gratuitamente:</h2>
				<div>
					<p>O nome de utilizador deve conter entre 1 e 20 caracteres; contendo apenas letras de A a Z, números de 0 a 9,
                        hifens ou traços sublinhados, não podendo ser incluso quaisquer termos inapropriados.</p>
                        
                    <form method="post" action="action_register.php">

					<input type="text" name="name" placeholder="Nome de Utilizador">
					<input type="text" name="email" placeholder="E-mail">
					<input type="password" placeholder="Senha" name="password">
					<input type="password" placeholder="Confirmar senha" name="confirm_password">
					<input type="submit" value="Inscrever">
					
					</form>

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