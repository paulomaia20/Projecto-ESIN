<?php
include('config/init.php');
include('config/checkLogin.php');

include('database/event.php');

if (isset($_GET['page']))
    $page = $_GET['page'];
else 
    $page = 1;

    $events = getAllEvents($page);

    //print_r($events);
?>

<html lang="en-US">
    
<head>
<title>RecycleABit - Next events</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style_withoutgridlayout.css">
    <link rel="stylesheet" href="css/event_list.css" type="text/css">
    <link href="css/navbar.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,800" rel="stylesheet"></head>
<body>
<header class="header-container">
            <!-- Header content -->
            <div class="main-navbar">
                <a class="navbar-brand" href="#"><b>Recycle</b>ABit</a>
                <ul>
                    <li><a href="#" title="My profile">Meu perfil</a></li>
                    <li><a href="#" title="New event">Novo evento</a></li>
                    <li><a href="#" class="active" title="Next events">Eventos</a></li>
                    <li><a href="#" title="Log out">Sair</a></li> 
                </ul>
            </div>
   
        <div>
            <h1 id="faq-heading">Next events</h1> 
        </div>

<ul class="grid">
<?php foreach ($events as $event) {?>
    <li><img src="img/newspaper.png" alt="image" class="board"><a href="#"><h3><?= $event['title'] ?> </h3></a><h4>@ <?= $event['place'] ?></h4><h5><?= $event['date'] ?></h5></li>
<?php } ?> 
    
</ul>
</header>

<div class="page" id="pagination" >
    <?php if($page!==1) { ?> 
        <a href="event_list.php?page=<?=$page-1?>">&lt;</a>
    <?php } ?> 
    <?=$page?> 
    <a href="event_list.php?page=<?=$page+1?>">&gt;</a>
</div>
</body>
<footer>
    <img id="sky" src="img/sky1.png" alt="sky">
</footer>
</html>
    

  