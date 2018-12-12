<?php
  include ('config/init.php');
  include('config/checkLogin.php');
  include ('database/user.php');
  
  if (isset($_GET['name']))
   { $username=$_GET['name'];
     $user_info = getUserInfo($username);
   }

   else {
       header('Location: homepage.php');
   }
  ?> 


<html lang="en-US">

<head>
    <title>RecycleABit - Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,800" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet" type="text/css">

</head>

<body>

      <header class="header-container">
            <!-- Header content -->
            <?php include('templates/navbar.php'); ?> 

        </header>
        
        <div class="container">

        <nav id="user_info">

            <img alt="avatar" src="img/avatar_1.jpg">

            <div id="first_row">
                <h1> <?=$username?> </h1>
                <h2>Experience points</h2>
                <div id="skillbar">
                    <div class="skills" style="height: 100%; width:80%; background-color: rgb(189, 189, 74);">80%</div>
                </div>
            </div>
            <article id="about_me">Sobre mim</article>

            <article id="level">Nível N</article>
            <article id="date">Utilizador desde 23/11/2018</article>
            <article id="email"><?=$user_info['email']?></article>
        <button class="button" type="button"><a href='edit_profile.php?name=<?=$username?>'><i class="fa fa-edit"></i>Editar perfil</a></button><br>
        </nav>

        <main id="latest_news">

            <article id="missions">
                <h1>Últimas missões completadas:</h1>
                <ul>
                   
                        <li> <a href="#">Limpar o mato - <span>23/11/2018</span></a> </li>
                        <li> <a href="#">Limpar o mato - <span>23/11/2018</span></a> </li>
                        <li> <a href="#">Limpar o mato - <span>23/11/2018</span></a> </li>               
                      
                </ul>
            </article>

            <article id="events">
                <h1>Últimos eventos em que participei:</h1>
                <ul>
                        <li> <a href="#">Limpar o mato - <span>23/11/2018</span></a> </li>
                        <li> <a href="#">Limpar o mato - <span>23/11/2018</span></a> </li>
                        <li> <a href="#">Limpar o mato - <span>23/11/2018</span></a> </li>
        
                </ul>
            </article>
        </main>

        <aside id="badge_info">
            <h1>Badges</h1>
            <ul>
                <li><span><img alt="badge" width="20" height="20" src="img/badges/badge_1.png"> Rock</span> </li>
                <li><span><img alt="badge" width="20" height="20" src="img/badges/badge_2.png"> Water</span> </li>
                <li><span><img alt="badge" width="20" height="20" src="img/badges/badge_1.png"> Rock</span> </li>
                <li><span><img alt="badge" width="20" height="20" src="img/badges/badge_2.png"> Water</span> </li>
            </ul>
        </aside>

    </div>


</body>
<footer>
    <img class="sky" src="img/sky1.png" alt="skyline">
</footer>
</html>