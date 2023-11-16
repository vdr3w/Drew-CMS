<?php 
require_once("./includes/DB.php");
require_once("./includes/Functions.php");
require_once("./includes/Sessions.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Postagens</title>
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
      <a href="MyProfile.php" class="nav-link"><i class="mdi mdi-account"></i> My Profile</a>
     </li>
     <li class="nav-item">
      <a href="Dashboard.php" class="nav-link"><i class="mdi mdi-view-dashboard"></i> Dashboard</a>
     </li>
     <li class="nav-item">
      <a href="Posts.php" class="nav-link"><i class="mdi mdi-post-outline"></i> Posts</a>
     </li>
     <li class="nav-item">
      <a href="Categories.php" class="nav-link"><i class="mdi mdi-tag-multiple"></i> Categories</a>
     </li>
     <li class="nav-item">
      <a href="Admins.php" class="nav-link"><i class="mdi mdi-account-supervisor-circle"></i> Manage
       Admins</a>
     </li>
     <li class="nav-item">
      <a href="Comments.php" class="nav-link"><i class="mdi mdi-comment-multiple-outline"></i> Comments</a>
     </li>
     <li class="nav-item">
      <a href="Blog.php?page=1" class="nav-link"><i class="mdi mdi-earth"></i> Live Blog</a>
     </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     <li class="nav-item">
      <a href="Logout.php" class="nav-link"><i class="mdi mdi-logout"></i> Logout</a>
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
     <h1><i class="mdi mdi-folder-plus" style="color: #27aae1"></i> Blog Posts</h1>
    </div>
    <div class="col-12 col-sm-6 col-md-3 mb-2">
     <a href="AddNewPost.php" class="btn btn-primary btn-block btn-custom">
      <i class="mdi mdi-post-outline "></i> Novo Post
     </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3 mb-2">
     <a href="Categories.php" class="btn btn-info btn-block btn-custom">
      <i class="mdi mdi-shape-plus "></i> Nova Categoria
     </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3 mb-2">
     <a href="Admins.php" class="btn btn-warning btn-block btn-custom">
      <i class="mdi mdi-account-multiple-plus"></i> Novo ADM
     </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3 mb-2">
     <a href="Comments.php" class="btn btn-success btn-block btn-custom">
      <i class="mdi mdi-check-decagram"></i> Aprovar Comentários
     </a>
    </div>
   </div>
  </div>
 </header>
 <!--  -->


 <section class="container py-2 mb-4">

  <div class="row">
   <div class="col-lg-12">
    <div class="card">
     <div class="card-header">
      <h4>Postagens do Blog</h4>
     </div>
     <div class="card-body">
      <table class="table table-striped table-hover table-bordered">
       <tr>
        <thead>
         <th>#</th>
         <th>Título</th>
         <th>Categoria</th>
         <th>Data e Hora</th>
         <th>Autor</th>
         <th>Banner</th>
         <th>Ações</th>
         <th>Pré-visualização ao Vivo</th>
       </tr>
       </thead>
       <tbody>
        <?php 
          global $ConnectingDB;
          $sql = "SELECT * FROM posts";
          $stmt = $ConnectingDB->query($sql);
          while ($DataRows = $stmt->fetch()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($DataRows["id"]) . "</td>";
              echo "<td>" . htmlspecialchars($DataRows["title"]) . "</td>";
              echo "<td>" . htmlspecialchars($DataRows["category"]) . "</td>";
              echo "<td>" . htmlspecialchars($DataRows["datetime"]) . "</td>";
              echo "<td>" . htmlspecialchars($DataRows["author"]) . "</td>";
              echo "<td><img src='uploads/" . htmlspecialchars($DataRows["image"]) . "' alt='image' style='width: 50px; height: 50px;'></td>";
              echo "<td>Editar | Excluir</td>";
              echo "<td>Ver Post</td>";
              echo "</tr>";
          }
          ?>
       </tbody>
      </table>
     </div>
    </div>
   </div>
  </div>
 </section>


 <!--  -->
 <footer class="bg-dark text-white py-4">
  <div class="container">
   <div class="row">
    <div class="col">
     <p class="lead text-center mb-2">
      Theme by Drew &copy; <span id="year"></span> | All Rights Reserved
     </p>
     <p class="text-center small mb-0">
      For educational purposes only. Unauthorized copy is prohibited.
     </p>
     <p class="text-center small">
      Connect with me on
      <a href="https://github.com/vdr3w" target="_blank" style="color: white; text-decoration: none; cursor: pointer">
       GitHub (clickhere) </a>.
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

<style>
.btn-custom {
 min-width: 200px;
 min-height: 50px;
}
</style>

</html>