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

if (isset($_GET['title']) && isset($_GET['date']) && isset($_GET['place'])) {
    $title = $_GET['title'];
    $date = $_GET['date'];
    $place = $_GET['place'];  
}

if (isset($title) && isset($date) && isset($place))
    $events = getEventsBySearch($title, $date, $place);
?>

<html lang="en-US">
    
<head>
<title>RecycleABit - Next events</title>
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
            <?php include('templates/navbar.php'); ?> 
        <div>
            <h1 id="faq-heading">Next events</h1> 
        </div>
        <form id="searchbar" action="event_list.php" method="get">
            <input type="text" name="title" placeholder="Event Name">
            <input type="text" name="date" placeholder="Date">
            <input type="text" name="place" placeholder="Venue">
            <input type="submit" value="Search">
        </form>

<ul class="grid">
<?php foreach ($events as $event) {?>
    select * from event_type where id=?
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
    

  