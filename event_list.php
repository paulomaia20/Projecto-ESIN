<?php
include('config/init.php');
include('config/checkLogin.php');
include('database/event.php');
include('config/checkLogin.php');
include('templates/header.php');

if (isset($_GET['page']))
    $page = $_GET['page'];
else 
    $page = 1;

    $events = getAllEvents($page);

    //print_r($events);

if (isset($_GET['title']) && isset($_GET['name_creator']) && isset($_GET['place'])) {
    $title = $_GET['title'];
    $name_creator = $_GET['name_creator'];
    $place = $_GET['place'];  
}

if (isset($title) && isset($name_creator) && isset($place))
    $events = getEventsBySearch($title, $name_creator, $place);
?>

<html lang="en-US">
    
<head>
<title>RecycleABit - Next events</title>
    <link rel="stylesheet" href="css/style_withoutgridlayout.css">
    <link rel="stylesheet" href="css/event_list.css" type="text/css"></head>
<body>
<header class="header-container">
            <!-- Header content -->
            <?php include('templates/navbar.php'); ?> 
        <div>
            <h1 id="faq-heading">Next events</h1> 
        </div>
        <form id="searchbar" action="event_list.php" method="get">
            <input type="text" name="title" placeholder="Event Name">
            <input type="text" name="name_creator" placeholder="Name of Creator">
            <input type="text" name="place" placeholder="Venue">
            <input type="submit" value="Search">
        </form>

<ul class="grid">
<?php foreach ($events as $event) {
    $src=getEventTypeById( $event['id']);
    ?>
    <li><img src="img/<?=$src['path_img'] ?>" alt="image" class="board"><a href="<?=$event['id'] ?>"><h3><?= $event['title'] ?> </h3></a><h4>@ <?= $event['place'] ?></h4><h5><?= $event['date'] ?></h5></li>
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
</html>
    

  