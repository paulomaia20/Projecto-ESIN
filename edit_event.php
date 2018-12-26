
<?php
  include ('config/init.php');
  include ('database/event.php');
  
  $event_types=getAllEventTypes();

  if(isset($_GET['id']))
  {
  $id = $_GET['id'];
  $event = getEventById($id);
}
else{
    header('Location: homepage.php');
}
include('templates/header.php');

?> 

<head>
    <title>RecycleABit - Edit event</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style_withoutgridlayout.css">
</head>

<body>

        <header class="header-container">
            <!-- Header content -->
            <?php include('templates/navbar.php'); ?> 
        </header>

        <div class="form-box form-login">

            <form action='action_edit_event.php?id=<?=($event['id'])."&name_creator=".$event['name_creator']?>' method="POST"> 
                <div class="form-top">
                    <div class="form-top-left">
                        <h1> Editar evento </h1>
                        <h2>Preenche o formulário abaixo</h2>
                        <h3> * - Campos obrigatórios</h3>
                    </div>

                    <div class="form-top-right">
                        *
                    </div>
                </div>

                <div class="form-bottom">
                    <label for="title">Nome do evento*:</label>
                    <input type="text" value="<?=$event['title']?>" name="title" id="title"> <br>

                    <label for="date">Data do evento*:</label>
                    <input type="date" value="<?=$event['date']?>" name="date" id="date"> <br>

                    <label for="body">Descrição do evento:</label>
                    <textarea name="body" rows="4" cols="50"> <?=$event['description']?>  </textarea><br>

                    <label for="place">Local do evento*:</label>
                    <input type="text" value="<?=$event['place']?>" name="place" id="place"> <br> 
                    <label for="type">Tipo de evento*:</label>

                 <select name="type">
                    
                    <?php foreach ($event_types as $type) {?> 
                                     
                    <?php if($type['id']==$event['id_type']) { ?>
                        <option selected value='<?= $type['id']; ?>'> <?= $type['type']."+".$type['score']."XP"; ?> </option> <?php } ?>
                    <?php if($type['id']!=$event['id_type']) { ?>
                        <option value='<?= $type['id']; ?>'> <?= $type['type']."+".$type['score']."XP"; ?> </option> <?php } ?>
                    <?php } ?>  <br>

                </div>

                
                <div class="form-end">
                    <input type="submit" value="Send">
                </div>

            </form>
        </div>


</body>


</html>