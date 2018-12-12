<?php
include('config/init.php');
include('config/checkLogin.php');

include('database/event.php');

$event_types=getAllEventTypes();

?>

<html lang="en-US">

<head>
    <title>RecycleABit - Profile</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style_withoutgridlayout.css">
    <link href="css/navbar.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,800" rel="stylesheet">
</head>

<body>

        <header class="header-container">
            <!-- Header content -->
            <div class="main-navbar">
                <a class="navbar-brand" href="#"><b>Recycle</b>ABit</a>
                <ul>

                    <li>
                        <input type="text" placeholder="Pesquisa de eventos">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </li>

                    <li><a href="#" title="New event">Novo evento</a></li>
                    <li><a href="#" class="active" title="My profile">Meu perfil</a></li>
                    <li><a href="#" title="Log out">Sair</a></li>
                </ul>
            </div>
        </header>

        <div class="form-box">

            <form action="action_create_event.php" method="POST">
                <div class="form-top">
                    <div class="form-top-left">
                        <h1> Novo evento </h1>
                        <h2>Preenche o formulário abaixo</h2>
                        <h3> * - Campos obrigatórios</h3>
                    </div>

                    <div class="form-top-right">
                        +
                    </div>
                </div>

                <div class="form-bottom">
                    <label for="title">Nome do evento*:</label>
                    <input type="text" placeholder="Nome do evento" name="title" id="title"> <br>

                    <label for="date">Data do evento*:</label>
                    <input type="date" name="date" id="date"> <br>

                    <label for="body">Descrição do evento:</label>
                    <textarea name="body" placeholder="Descrição" rows="4" cols="50">  </textarea><br>

                    <label for="place">Local do evento*:</label>
                    <input type="text" placeholder="Local" name="place" id="place"> <br> 
                    <label for="type">Tipo de evento*:</label>
                    <select name="type">
                    <?php foreach ($event_types as $type) {?>                  
                    <option value='<?= $type['type']; ?>'> <?= $type['type']."+".$type['score']."XP";  ?>   </option>
                    <?php } ?> 
                    </select> <br>
                </div>

                <div class="form-end">
                    <input type="submit" value="Send">
                </div>

            </form>
        </div>


</body>


</html>