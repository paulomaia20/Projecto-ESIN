<?php
  include ('config/init.php');
  include('config/checkLogin.php');
  include ('database/user.php');
  
  if (( isset($_GET['name']) && userExists($_GET['name'])) === true)
   {    
    $username=$_GET['name'];
     $user_info = getUserInfo($username);
     
     $latest_missions=getLatestMissions($username);
     $latest_events=getLatestEvents($username);
     $badges=getLatestBadges($username);
     $score=getTotalScore($username);
     $level=getLevelFromTotalScore($score);
   }

   else {
       header('Location: homepage.php');
   }
 
include('templates/header.php');  
 ?> 
    <title>RecycleABit - Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

      <header class="header-container">
            <!-- Header content -->
            <?php include('templates/navbar.php'); ?> 
      </header>
        
        <div class="container">

        <nav id="user_info">

            <img alt="avatar" src="img/thumbs_small/<?=$user_info['path_photo']?>">

            <div class="first_row_profile">
                <h1> <?=$username?> </h1>
                <h2>Experience points - <?= $score ?> </h2>
                <div id="skillbar">
                    <div class="skills" style='width:<?=100*round($score/$level[1],2)?>%; background-color: rgb(189, 189, 74);'><?=100*round($score/$level[1],2).'%'?></div>
                </div>
            </div>
            <article id="about_me">Sobre mim</article>

            <article id="level">Nível <?=$level[0]?></article>
            <article id="date">Utilizador desde <?=$user_info['regist_date']?> </article>
            <article id="email"><?=$user_info['email']?></article>
            <?php if($username==$_SESSION['name']) { ?> 
        <button class="button" type="button"><a href='edit_profile.php?name=<?=$username?>'><i class="fa fa-edit"></i>Editar perfil</a></button><br>
            <?php } ?> 
        </nav>

        <main id="latest_news">

            <article id="missions">
                <h1>Últimas missões completadas:</h1>
                <?php if(empty($latest_missions)) { ?> 
                <p> Nenhuma missão completada ainda! <p> 
                <?php } ?>

<?php foreach($latest_missions as $mission){ ?> 
                <ul>
                 <li> <?='Missão # '.$mission['id_mission']?> </li>                      
                </ul>
<?php } ?>
            </article>

            <article id="events">
                <h1>Últimos eventos em que participei:</h1>
                <?php if(empty($latest_events)) { ?> 
                <p> Não participaste em nenhum evento ainda! <p> 
                <?php } ?>

                <?php foreach($latest_events as $event){ ?> 

                <ul>
                        <li> <a href='event_page.php?id=<?=$event['id']?>'><?=$event['title']?> - <span><?=$event['date']?></span></a> </li>
        
                </ul>
                <?php } ?>

            </article>
        </main>

        <aside id="badge_info">
            <h1>Badges</h1>
            <ul>
            <?php foreach($badges as $badge){ ?> 

                <li><span><img alt="badge" width="30" height="30" src='img/<?=$badge['path_img']?>'> <?=$badge['name']?> </span> </li>
              
            </ul>
            <?php } ?> 
        </aside>

    </div>


</body>

</html>