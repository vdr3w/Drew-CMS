<?php
require_once("./includes/DB.php");
require_once("./includes/Functions.php");
require_once("./includes/Sessions.php");


if (isset($_POST["Submit"])) {
 $Category = $_POST["CategoryTitle"];
 $Admin = "Drew";
 date_default_timezone_set('America/Sao_Paulo');
 $DateTime = new DateTime();
 $DateTimeString = $DateTime->format('Y-m-d H:i:s');


 if (empty($Category)) {
  $_SESSION["ErrorMessage"] = "Todos os campos devem ser preenchidos!";
 } elseif (strlen($Category) < 3) {
  $_SESSION["ErrorMessage"] = "A categoria deve ter mais de 3 letras.";
 } elseif (strlen($Category) > 49) {
  $_SESSION["ErrorMessage"] = "A categoria deve ter menos de 50 letras.";
 } else {
  $sql = "INSERT INTO category(title,author,datetime)";
  $sql .= "VALUES(:categoryName,:adminName, :dateTime)";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':categoryName', $Category);
  $stmt->bindValue(':adminName', $Admin);
  $stmt->bindValue(':dateTime', $DateTimeString);
  $Execute = $stmt->execute();

  if ($Execute) {
   $_SESSION["SuccessMessage"] = "Categoria de ID " . $ConnectingDB->lastInsertId() . " adicionada com sucesso!";
   Redirect_to("Categories.php");
  } else {
   $_SESSION["ErrorMessage"] = "Algo deu errado! Tente novamente!";
   Redirect_to("Categories.php");
  }
 }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Categorias</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
 <link rel="stylesheet" href="/css/style.css" />
 <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet" />
</head>

<body>
 <!-- NAVBAR -->
 <div style="height: 10px; background: #27aae1"></div>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
   <a href="#" class="navbar-brand">Drew.com</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarcollapseCMS"
    aria-controls="navbarcollapseCMS">
    <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse" id="navbarcollapseCMS">
    <ul class="navbar-nav mx-auto">
     <li class="nav-item">
      <a href="MyProfile.php" class="nav-link"><i class="mdi mdi-account"></i> Meu Perfil</a>
     </li>
     <li class="nav-item">
      <a href="Dashboard.php" class="nav-link"><i class="mdi mdi-view-dashboard"></i> Painel de Controle</a>
     </li>
     <li class="nav-item">
      <a href="Posts.php" class="nav-link"><i class="mdi mdi-post-outline"></i> Postagens</a>
     </li>
     <li class="nav-item">
      <a href="Categories.php" class="nav-link"><i class="mdi mdi-tag-multiple"></i> Categorias</a>
     </li>
     <li class="nav-item">
      <a href="Admins.php" class="nav-link"><i class="mdi mdi-account-supervisor-circle"></i> Gerenciar
       Admins</a>
     </li>
     <li class="nav-item">
      <a href="Comments.php" class="nav-link"><i class="mdi mdi-comment-multiple-outline"></i> Comentários</a>
     </li>
     <li class="nav-item">
      <a href="Blog.php?page=1" class="nav-link"><i class="mdi mdi-earth"></i> Blog</a>
     </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     <li class="nav-item">
      <a href="Logout.php" class="nav-link"><i class="mdi mdi-logout"></i> Sair</a>
     </li>
    </ul>
   </div>
  </div>
 </nav>
 <div style="height: 10px; background: #27aae1"></div>

 <header class="bg-dark text-white py-3">
  <div class="container">
   <div class="row">
    <div class="col-md-12">
     <h1><i class="mdi mdi-text" style="color: #27aae1"></i> Gerenciar Categorias</h1>
    </div>
   </div>
  </div>
 </header>
 <!--  -->

 <section class="container py-2 mb-4">
  <div class="row">
   <div class="offset-lg-1 col-lg-10">

    <?php

    echo ErrorMessage();
    echo SuccessMessage();
    ?>
    <form class="" action="Categories.php" method="post">
     <div class="card bg-secondary text-light mb-3">
      <div class="card-header">
       <h1>Adicionar Nova Categoria</h1>
      </div>
      <div class="card-body bg-dark">
       <div class="form-group mb-2">
        <label for="title" class="form-label">
         <span
          style="color: rgb(251, 174, 44); font-family: Georgia, 'Times New Roman', Times, serif; font-size: 1.2em;">Título
          da Categoria</span>
        </label>

        <input class="form-control mb-2" type="text" name="CategoryTitle" placeholder="Digite aqui o título" id="title">
       </div>
       <div class="row mb-2">
        <div class="col-lg-6 d-grid gap-2 mb-2">
         <a class="btn btn-warning" href="Dashboard.php"><i class="mdi mdi-arrow-left"></i> Voltar ao Painel</a>
        </div>
        <div class="col-lg-6 d-grid gap-2 mb-2">
         <button type="submit" name="Submit" class="btn btn-success"><i class="mdi mdi-check"></i> Publicar</button>
        </div>
       </div>
      </div>
     </div>
    </form>
   </div>
  </div>
 </section>

 <!--  -->
 <footer class="bg-dark text-white py-4 fixed-bottom">
  <div class="container">
   <div class="row">
    <div class="col">
     <p class="lead text-center mb-2">
      Site feito por Drew &copy; <span id="year"></span> | Todos os Direitos Reservados
     </p>
     <p class="text-center small mb-0">
      Apenas para fins educacionais. A cópia não autorizada é proibida.
     </p>
     <p class="text-center small">
      Basta pedir para mim no
      <a href="https://github.com/vdr3w" target="_blank" style="color: white; text-decoration: none; cursor: pointer">
       GitHub (clique aqui) </a>.
     </p>
    </div>
   </div>
  </div>
 </footer>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 <script>
 document.getElementById("year").textContent = new Date().getFullYear();
 </script>
</body>

</html>