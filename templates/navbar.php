
<?php if(!isset($_SESSION['name'])) { ?> 
<div class="main-navbar">
		<a class="navbar-brand" href="#"><b>Recycle</b>ABit</a>
			<ul class="nav navbar-nav">
				<li><a href="#" class="active">Home</a></li>
				<li><a href="mainpage.html#sobrenos">About</a></li>
				<li><a href="FAQs.html">FAQ</a></li>
				<li><a href="login.html">Log In</a></li>
			</ul>
</div>

<?php } ?> 

<?php if(isset($_SESSION['name'])) { ?> 
	<div class="main-navbar">
            <a class="navbar-brand" href="#"><b>Recycle</b>ABit</a>
            <ul>

                <li>
                    <input type="text" placeholder="Pesquisa de eventos">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </li>

                <li><a href="#" title="New event">Novo evento</a></li>
                <li><a href="#" class="active" title="My profile">Meu perfil</a></li>
                <li><a href="action_logout.php" title="Log out">Sair</a></li>
            </ul>
        </div>
		<?php } ?> 
