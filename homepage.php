<?php
include('config/init.php');
include('config/checkLogin.php');
include('database/missions.php');
include('database/user.php');

// Get current mission for the logged user
$curr_mission=getMissionByUser($_SESSION['name']);

$mission_tasks=getTasksByMission($curr_mission['id']);
$completed_tasks=getCompletedTasks($_SESSION['name'],$curr_mission['id']);

$incompleted_tasks=getIncompleteTasks($_SESSION['name'],$curr_mission['id']);

$iscompleted=checkAllTasksCompleted($completed_tasks,$mission_tasks);

if($iscompleted==true)
{
    insertNextMission($_SESSION['name'], $curr_mission['id']);
    $curr_mission=getMissionByUser($_SESSION['name']); //Get new curr mission
    $completed_tasks=getCompletedTasks($_SESSION['name'],$curr_mission['id']);
    $incompleted_tasks=getIncompleteTasks($_SESSION['name'],$curr_mission['id']);
} 

$badges=getBadgesInMission($curr_mission['id']);
$latest_badge=getLatestBadges($_SESSION['name'])[0];
?>

<html lang="en-US">

<head>
    <title>RecycleABit - Homepagex</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,800" rel="stylesheet">

    <link href="css/navbar.css" rel="stylesheet" type="text/css">
    <link href="css/tasks.css" rel="stylesheet" type="text/css">

</head>

<body>

    <header class="header-container">
        <!-- Header content -->
        <?php include('templates/navbar.php'); ?> 

    </header>

    <section id="user-info">

        <img alt="avatar" src="img/avatar_1.jpg">
        <div id="first_row">
            <h1> <?php echo $_SESSION['name'] ?>  <p id="level">Nível N</p></h1> 

            <h2>Experience points</h2>
            <div id="skillbar">
                <div class="skills" style="height: 100%; width:80%; background-color: rgb(189, 189, 74);">80%</div>
            </div>

        </div>


        <div class="past-rewards">
            <h1>Última recompensa</h2>
                <ul>
                    <li><i class="fa fa-arrow-right"></i><?=$latest_badge['name']?></li>
                </ul>
            </div>

    </section>

    <div id="second-row">

    <section id="missions">
        <form class="todoList" action="action_update_task_list.php" method="POST">
            <h1>Missão #<?= $curr_mission['id'] ?> </h1>
            <div class="items">
        <?php 
        foreach ($completed_tasks as $completed_task) { 
        ?> 
              
    <input checked value='<?= $completed_task['id'] ?>' name="tasks[]" id='item.<?=$completed_task['id']?>' type="checkbox">
    <label for='item.<?=$completed_task['id']?>'><?= $completed_task['description'] ?> </label>

     <?php } ?> 

         <?php 
        foreach ($incompleted_tasks as $incompleted_task) { 
        ?> 
              
    <input value='<?= $incompleted_task['id'] ?>' name="tasks[]" id='item.<?=$incompleted_task['id']?>' type="checkbox">
    <label for='item.<?=$incompleted_task['id']?>'><?= $incompleted_task['description'] ?> </label>

     <?php } ?> 

                <h2 class="done">Done</h2>
                <h2 class="pending">Pending</h2>

                <button type="submit">Submit</button>

            </div>
        </form>
    </section>

    <section id="reward">

        <h1>Recompensa da missão</h1>
        <div class="rewards">
            <ul>
                <li><?= $curr_mission['score'] ?> pontos de experiência</li>
                <?php foreach($badges as $badge) { ?> 
                     <li><img alt="badge" src='img/<?=$badge['path_img']?>'> <?=$badge['name']  ?> Badge</li>
                <?php } ?>
            </ul>
        </div>

    </section>
</div>


</body>