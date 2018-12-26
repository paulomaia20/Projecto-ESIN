
<?php
  include ('config/init.php');
  include ('database/user.php');
  
  if(isset($_GET['name']))
  {
  $name = $_GET['name'];
  $user=getUserInfo($name);

  }
 
  else{
    header('Location: homepage.php');
    }
include('templates/header.php');

?> 

<head>
    <title>RecycleABit - Edit profile</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style_withoutgridlayout.css">
</head>

<body>

        <header class="header-container">
            <!-- Header content -->
            <?php include('templates/navbar.php'); ?> 
        </header>

        <div class="form-box form-login">

            <form action='action_edit_profile.php?name=<?=($user['name'])?>' method="POST" enctype="multipart/form-data"> 
                <div class="form-top">
                    <div class="form-top-left">
                        <h1> Editar perfil </h1>
                        <h2>Preenche o formulário abaixo</h2>
                        <h3> * - Campos obrigatórios</h3>
                    </div>

                    <div class="form-top-right">
                        *
                    </div>
                </div>

                <div class="form-bottom">
                    <label for="email">Email*:</label>
                    <input type="text" name="email" value="<?=$user['email']?>" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" title="Please input a valid email (example@email.com)!">
						
                    <label for="password">Password*:</label>
                    <input type="password" placeholder="Nova senha" name="password" required pattern="[^s?]{6,}" title="Six or more characters">
						  
                    <label for="avatar"><p>Avatar:</p></label><br>
					<input type="file" name="image">
                    <input type="hidden" name="path_img" value='<?=$user['path_photo']?>'> 

                </div>

                  

                <div class="form-end">
                    <input type="submit" value="Send">
                </div>

            </form>
        </div>


</body>


</html>