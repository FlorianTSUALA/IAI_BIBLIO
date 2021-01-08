

<?php



include('../../config/config.php');

    //Liste des documents de l'assocaition
  $sql = "select * from documents;";
  $req = $connexion->prepare($sql);
   $req->execute();
  $documents = $req->fetchAll();


?>





<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Listes des documents | Gestion Association</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <?php include("../include/header-include.php"); ?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include("../include/navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("../include/sidebar.php"); ?>
  <!-- Content Wrapper. Contains page content -->



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion des documents</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Documents</a></li>
              <li class="breadcrumb-item active">Liste des documents</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N°</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Nom du fichier</th>
                    <th>Date du document</th>
                    <th>Contenu</th>
                    <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $i=0;
                      foreach ($documents as  $document) {
                          $i++;
                          $id = $document["id"];
                          $date = $document["date_doc"];
                          //$date = date("l, d F o", $document["date"]);
                          echo "<tr>";
                          echo "<td>   $i </td>";
                          echo "<td> {$document["titre"]} </td>";
                          echo "<td> {$document["description"]} </td>";
                          echo "<td> {$document["fichier"]} </td>";
                          echo "<td> {$date} </td>";
                          echo "<td> {$document["contenu"]} </td>";
                          echo "<td>
                           <a href='gerer_archive.php?id=$id' onclick=\"return confirm('Voulez vous supprimer ce document?');\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>
                           &nbsp    &nbsp  &nbsp  &nbsp
                           <a href='update_archive.php?id=$id'><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></a>
                           </td>";
                          echo "</tr>";
                      }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>N°</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Nom du fichier</th>
                    <th>Date du document</th>
                    <th>Contenu</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("../include/footer.php"); ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php include("../include/footer-inculde.php"); ?>

</body>
</html>
