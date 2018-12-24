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
    <link rel="stylesheet" href="css/event_list.css" type="text/css">
</head>
<body>
    
    <header>
            <img id="skyline" src="img/theskyline4.jpg" alt="Sky Line">
        <div>
            <h1 id="faq-heading">Next events</h1> 
        </div>

    <ul class="grid">
    <?php foreach ($events as $event) {?>
        <li><img src="img/newspaper.png" alt="image" class="board"><a href="#"><h3><?= $event['title'] ?> </h3></a><h4>@ <?= $event['place'] ?></h4><h5><?= $event['date'] ?></h5></li>
    <?php } ?> 
    
    </ul>
    </header>

    <div id="pagination">
        <?php if($page!==1) { ?> 
            <a href="event_list.php?page=<?=$page-1?>">&lt;</a>
       <?php } ?> 
        <?=$page?> 
        <a href="event_list.php?page=<?=$page+1?>">&gt;</a>
    </div>
</body>
<footer>
    <img id="treeline" src="img/treeline5.jpg" alt="Tree Line">
</footer>
</html>
    

  