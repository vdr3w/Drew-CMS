<?php
require_once("./includes/DB.php");
require_once("./includes/Functions.php");
require_once("./includes/Sessions.php");


if (isset($_POST["Submit"])) {
 $PostTitle = $_POST["PostTitle"];
 $Category = $_POST["Category"];
 $Image = $_FILES["Image"]["name"];
 $TargetFolder = "uploads/".basename($_FILES["Image"]["name"]);
 $PostDescription = $_POST["PostDescription"];
 $Admin = "Drew";
 date_default_timezone_set('America/Sao_Paulo');
 $DateTime = new DateTime();
 $DateTimeString = $DateTime->format('Y-m-d H:i:s');

 if (empty($PostTitle)) {
        $_SESSION["ErrorMessage"] = "Título não deve ser vazio!";
    } elseif (strlen($PostTitle) < 5) {
        $_SESSION["ErrorMessage"] = "O título deve ter mais de 5 letras.";
    } elseif (strlen($PostTitle) > 300) {
        $_SESSION["ErrorMessage"] = "O título deve ter menos de 300 letras.";
    } elseif (strlen($Category) > 49) {
        $_SESSION["ErrorMessage"] = "A categoria deve ter menos de 50 letras.";
    } elseif (strlen($Image) > 50) {
        $_SESSION["ErrorMessage"] = "O nome da imagem deve ter menos de 50 caracteres.";
    } elseif (strlen($PostDescription) > 999) {
        $_SESSION["ErrorMessage"] = "A descrição do post deve ter menos de 1000 letras.";
    } else {if (move_uploaded_file($_FILES["Image"]["tmp_name"], $TargetFolder)) {
        $sql = "INSERT INTO posts(datetime, title, category, author, image, post) ";
        $sql .= "VALUES(:dateTime, :title, :categoryName, :adminName, :imageName, :postDescription)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':dateTime', $DateTimeString);
        $stmt->bindValue(':title', $PostTitle);
        $stmt->bindValue(':categoryName', $Category);
        $stmt->bindValue(':adminName', $Admin);
        $stmt->bindValue(':imageName', $Image);
        $stmt->bindValue(':postDescription', $PostDescription);
        $Execute = $stmt->execute();

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Post com ID " . $ConnectingDB->lastInsertId() . " adicionado com sucesso!";
            Redirect_to("AddNewPost.php");
        } else {
            $_SESSION["ErrorMessage"] = "Algo deu errado no banco de dados! Tente novamente!";
            Redirect_to("AddNewPost.php");
        }
    } else {
        $_SESSION["ErrorMessage"] = "Falha ao carregar a imagem.";
        Redirect_to("AddNewPost.php");
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
     <h1><i class="mdi mdi-text" style="color: #27aae1"></i> Adicionar Nova Postagem</h1>
    </div>
   </div>
  </div>
 </header>

 <section class="container py-2 mb-4">
  <div class="row">
   <div class="offset-lg-1 col-lg-10">

    <?php

    echo ErrorMessage();
    echo SuccessMessage();
    ?>
    <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
     <div class="card bg-secondary text-light mb-3">

      <div class="card-body bg-dark">
       <div class="form-group mb-2">
        <label for="title" class="form-label">
         <span
          style="color: rgb(251, 174, 44); font-family: Georgia, 'Times New Roman', Times, serif; font-size: 1.2em;">Título
          da Postagem</span>
        </label>

        <input class="form-control mb-2" type="text" name="PostTitle" placeholder="Digite aqui o título" id="title">
       </div>
       <div class="form-group mb-2">
        <label for="CategoryTitle" class="form-label">
         <span
          style="color: rgb(251, 174, 44); font-family: Georgia, 'Times New Roman', Times, serif; font-size: 1.2em;">Escolha
          a Categoria</span>
        </label>

        <select name="Category" id="CategoryTitle" class="form-control">
         <?php 
    global $ConnectingDB;
    $sql = "SELECT * FROM category";
    $stmt = $ConnectingDB->query($sql);
    while ($DateRows = $stmt->fetch()) {
        $Id = $DateRows["id"];
        $CategoryName = $DateRows["title"];
        echo "<option value='$Id'>$CategoryName</option>";
    }
    ?>
        </select>
       </div>

       <div class="form-group mb-2">
        <label for="imageSelect" class="form-label">
         <span
          style="color: rgb(251, 174, 44); font-family: Georgia, 'Times New Roman', Times, serif; font-size: 1.2em;">Selecione
          a Imagem</span>
        </label>
        <div class="custom-file">
         <input type="file" class="form-control" name="Image" id="imageSelect">
        </div>
       </div>

       <div class="form-group">
        <label for="Post" class="form-label"><span class="fieldInfo"
          style="color: rgb(251, 174, 44); font-family: Georgia, 'Times New Roman', Times, serif; font-size: 1.2em;">
          Post: </span></label>
        <textarea class="form-control" name="PostDescription" id="Post" cols="80" rows="4"></textarea>

       </div>


       <div class="row mb-2 mt-3">
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