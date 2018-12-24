<?php
  include ('config/init.php');
  include('config/checkLogin.php');
  include ('database/event.php');
  
  if(isset($_GET['id']))
  {
  $id = $_GET['id'];
  
  if(isset($_GET['cmt_page']))
    $comment_page=$_GET['cmt_page'];
  else
      $comment_page=1;
  
  $event = getEventById($id);
  $comments=getCommentsByEventId($id, $comment_page);
  $nr_comments=getNrCommentsInEvent($id);
  $nr_participants=getNrParticipantsInEvent($id);
  $participants=selectAllParticipants($id);
  $participant_in_event=checkIfParticipantInEvent($_SESSION['name'],$id);

}
else{
    header('Location: homepage.php');
}

include('templates/header.php');
?> 
    <title>RecycleABit - Event Page</title>
    <link rel="stylesheet" href="css/style_withoutgridlayout.css">
    <link rel="stylesheet" href="css/event_page.css">
</head>

<body>
        <header class="header-container">
                <!-- Header content -->
                <?php include('templates/navbar.php'); ?> 
        </header>                       
        
        <div class="left-bar">
            <div class="wrapper">
            <h3 class="event-info">Number of participants - </h3> <h5 class="event-info"> <?= $nr_participants['part_nr'] ?> </h5> <img src="img/man-user.png" alt="user" class="icon-right">
            <br>
            <h3 class="event-info">Number of comments - </h3> <h5 class="event-info"> <?=$nr_comments['cmt_nr']?> </h5><img src="img/chat.png" alt="comment" class="icon-right">
            <br>
            <h3 class="event-info">Venue -  </h3><h5 class="event-info"> <?=  $event['place'] ?> </h5><img src="img/localization.png" alt="venue" class="icon-right">
          
            <div class="wrapper-button">
            <form action = "action_participate_event.php" method = "POST">
                <input type="hidden" name="eventID" value='<?=$event['id']?>'>
               <?php if($participant_in_event==false) { ?> 
                <button type="submit" class="button"> Participate</button>
                <?php } ?> 
            </form>     
            <button class="button" type="button"><a href='edit_event.php?id=<?=$event['id']?>'>Editar evento</a></button><br>

            </div>
            </div>
            
            <div class="wrapper">
                <h3>Participants</h3>
                <div class="list-participants">
                    <?php foreach($participants as $participant) { ?>
                <div class="participant">
                    <img src="img/avatar_1.jpg" alt="avatar_1"> <h6> <a href='user_profile.php?name=<?=$participant['name']?>'> <?=$participant['name']?> </a> </h6>
                </div>
          <?php } ?> 
                </div>
            </div>
                
        </div>
        <div class="middle-bar">
            <article class="wrapper">
            <h1><?=$event['title']?></h1>
            <h5>Created by <i> <a href='user_profile.php?name=<?=$event['name_creator']?>'> <?=$event['name_creator']?> </a></i></h5>
            <hr>
            <p> 
                <?=$event['description']?>
            </p>
            </article>
        </div>
        
        <aside class="right-bar">
            <div class="wrapper">
            <div>
                <h3>Comment Section</h3>
                <div class="status-upload">
                    <form action="action_submit_comment.php" method="POST">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <img src="img/left-quote.png" alt="left quote mark" class="icon-left">
                        <textarea name="description" class="text-input" placeholder="Write a comment here..."></textarea>
                        <img src="img/right-quote.png" alt="right quote mark" class="icon-right">
                        <button type="submit" class="button"> Comment</button>
                    </form>
                </div>

       <div id="pagination">
       <?php if($comment_page!=1) { ?> 
            <a href='event_page.php?cmt_page=<?=($comment_page-1)."&id=".$event['id']?>'>&lt;</a>
       <?php } ?> 
             <?=$comment_page?> 
             <a href='event_page.php?cmt_page=<?=($comment_page+1)."&id=".$event['id']?>'>&gt;</a>
    </div>


            </div>
            <hr>

            <?php foreach($comments as $comment) { ?> 
            <div class="post">
                <h5><i><a href='user_profile.php?name=<?=$comment['name_user']?>'> <?=$comment['name_user']?></a> </i> commented:</h5>
                <div class="post-description">
                    <p><?=$comment['description']?></p>
                </div>
                <div class="stats">
                    <h6 class="text-muted-time"><?=$comment['date']  //colocar em min ?></h6>
                    <!-- Tornar visível apenas se for o criador ou o proprio user --> 
                    <?php if($comment['name_user']===$_SESSION['name'] || $comment['name_user']===$event['name_creator'] ) { ?>
                    <a class="delete" href='action_delete_comment.php?id=<?=$comment['id']."&creator_name=".$event['name_creator']."&user_name=".$comment['name_user']."&event_id=".$event['id']?>'> <i class="fa fa-close"> Remove </i> </a>
                    <?php } ?>  
                </div>
            </div>
            <?php } ?> 
        </aside>
    </div>
</body>
                                   
