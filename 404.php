<?php
  include ('config/init.php');
  include ('templates/header.php');
  ?> 
<head>
   <title>RecycleABit - Page not found!</title>
   <link href="css/404.css" rel="stylesheet" type="text/css">

</head>

<header>
    <h1>Erro 404  </h1>
    <h2>A página a que tentaste aceder não existe :(</h2>
<form action="homepage.php">
    <button type="submit"> VOLTAR </button>
</form>
</header>

<?php
include('templates/footer.php');
?> 
</html>