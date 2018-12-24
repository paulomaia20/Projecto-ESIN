<?php
include('config/init.php');
include('config/checkLogin.php');

include('database/event.php');
include('templates/header.php');

$event_types=getAllEventTypes();
?>
    <title>RecycleABit - Criar Evento</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style_withoutgridlayout.css">
</head>

<body>

        <header class="header-container">
            <!-- Header content -->
            <?php include('templates/navbar.php'); ?> 
        </header>

        <div class="form-box form-login">

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
                    <option value='<?= $type['id'] ?>'> <?= $type['type']."+".$type['score']."XP";  ?>   </option>
                    <?php } ?> 
                    </select> <br>
                </div>

                    <input type="submit" value="Send">

            </form>
        </div>

<div class="error_message">
<?php  	
 if(isset($_ERROR_MESSAGE))
    {
        echo $_ERROR_MESSAGE; 
	}  
	?> 
</div>

</body>


</html>