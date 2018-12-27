
<?php if(!isset($_SESSION['name'])) { ?> 
<div class="main-navbar">
		<a class="navbar-brand" href="homepage.php"><b>Recycle</b>ABit</a>
			<ul class="nav navbar-nav">
				<li><a href="homepage.php" class="active">Home</a></li>
				<li><a href="FAQ_page.php">FAQ</a></li>
				<li><a href="login.php">Log In</a></li>
			</ul>
</div>

<?php } ?> 

<?php if(isset($_SESSION['name'])) { ?> 
	<div class="main-navbar" id="myMainNavbar">
            <a class="navbar-brand" href="homepage.php"><b>Recycle</b>ABit</a>
            <ul>
                <li class="responsive_homepage_name"><a href="homepage.php" title="Home">HOMEPAGE</a></li>
                <li><a href="event_list.php" title="Search">Eventos</a></li>
                <li><a href="create_event.php" title="New event">Novo evento</a></li>
                <li><a href='user_profile.php?name=<?=$_SESSION['name']?>' title="My profile">Meu perfil</a></li>
                <li><a href="action_logout.php" title="Log out">Sair</a></li>
                </ul>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                     <i class="fa fa-bars"></i>
  </a>
        </div>
        <?php } ?> 
        
        
 <script> 

 function myFunction() {
  var x = document.getElementById("myMainNavbar");
  if (x.className === "main-navbar") {
    x.className += " responsive";
  } else {
    x.className = "main-navbar";
  }

}
</script>
