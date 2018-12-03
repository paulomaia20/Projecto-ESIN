<?php
include('config/init.php');
echo $_SESSION['name'];
?>

<html lang="en-US">

<head>
    <title>RecycleABit - Profile</title>
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
        <div class="main-navbar">
            <a class="navbar-brand" href="#"><b>Recycle</b>ABit</a>
            <ul>

                <li>
                    <input type="text" placeholder="Pesquisa de eventos">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </li>

                <li><a href="#" title="New event">Novo evento</a></li>
                <li><a href="#" class="active" title="My profile">Meu perfil</a></li>
                <li><a href="action_logout.php" title="Log out">Sair</a></li>
            </ul>
        </div>
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
            <h1>Últimas recompensas</h2>
                <ul>
                    <li><i class="fa fa-arrow-right"></i>Fire badge</li>
                    <li><i class="fa fa-arrow-right"></i>Earth badge</li>
                </ul>
            </div>

    </section>

    <div id="second-row">

    <section id="missions">
        <form class="todoList">
            <h1>Missão #1</h1>
            <div class="items">

                <input id="item1" type="checkbox" checked>
                <label for="item1">Recolher 10kg de papel</label>

                <input id="item2" type="checkbox">
                <label for="item2">Levar o papel ao Banco Alimentar</label>

                <input id="item3" type="checkbox">
                <label for="item3">Netflix and chill</label>

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
                <li>500 pontos de experiência</li>
                <li>Badge Rock</li>
            </ul>
        </div>

    </section>
</div>


</body>