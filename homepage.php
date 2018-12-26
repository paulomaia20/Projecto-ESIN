<?php
include('config/init.php');
include('config/checkLogin.php');
include('database/missions.php');
include('database/user.php');

// Get current mission for the logged user
$user = getUserInfo($_SESSION['name']);
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

if(isset(getLatestBadges($_SESSION['name'])[0]))
    $latest_badge=getLatestBadges($_SESSION['name'])[0];

$score=getTotalScore($_SESSION['name']);
$level=getLevelFromTotalScore($score);

include('templates/header.php');

?>

    <title>RecycleABit - Homepage</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/tasks.css" rel="stylesheet" type="text/css">

</head>

<body>


    <header class="header-container">
        <!-- Header content -->
        <?php include('templates/navbar.php'); ?> 

    </header>

<div class="wrapper"> 
    <section id="user-info">

        <img alt="avatar" src="img/thumbs_small/<?=$user['path_photo']?>">
        <div id="first_row">
            <h1> <?php echo $_SESSION['name'] ?>  <p id="level">Nível <?=$level[0]?> </p></h1> 

            <h2>Experience points  - <?=$score ?> </h2>
            <div id="skillbar">
            <div class="skills" style='height: 100%; width:<?=100*round($score/$level[1],2)?>%; background-color: rgb(189, 189, 74);'><?=100*round($score/$level[1],2).'%'?></div>
            </div>

        </div>

        <div class="past-rewards">
            <h1>Última recompensa</h2>
                <ul>
                <?php if(isset($latest_badge)) {?>
                    <li><i class="fa fa-arrow-right"></i><?=$latest_badge['name']?></li>
                    <?php } ?> 
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
               <?php if(!empty($incompleted_task)) { ?>
    <input value='<?= $incompleted_task['id'] ?>' name="tasks[]" id='item.<?=$incompleted_task['id']?>' type="checkbox">
    <label for='item.<?=$incompleted_task['id']?>'><?= $incompleted_task['description'] ?> </label>
  
     <?php  } } ?> 

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
                </div>


</body>