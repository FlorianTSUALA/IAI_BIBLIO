<?php 

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php") 

?>


  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        

            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                 
                  <tr>
                    <th></th>
                    <th>Nom et Prenom</th>
                    <th>Departement</th>
                    <th></th>
                    <th></th>

                  </tr>
                  </thead>
                  <tbody>
                    <?php

                      require("../config/config.php");
                      $sql = "select * from enseignant";
                      $requete = $connexion->prepare($sql);
                      $requete->execute();
                      $listes = $requete->fetchAll();

                      foreach($listes as $liste) {
                        //var_dump($listes);
                        $id = $liste['id'];
                        echo '<tr>';
                        echo "<td>{$liste['id']}</td>";
                        echo "<td>{$liste['nom_prenom']}</td>";
                        echo "<td>{$liste['departement']}</td>";
                        echo "<td><a  href='modifier-enseignant.php? id=$id'>
                                    <i class='fa fa-edit'></i></a></td>";
                        echo "<td><a  href='gerer-enseignant.php? id=$id'
                        onclick=\"return confirm('VOULEZ VOUS SUPPRIMER CETTE LIGNE?')\"
                        ><i class='fa fa-trash'></i></a></td>";

                        echo "</tr>";
                      
                      }
                      

                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th> </th>
                    <th>Nom & Prenom </th>
                    <th>Departement</th>
                    
                  </tr>
                  
                  </tfoot>

                </table>
                </br>
                <a class="btn btn-primary" href="ajouter-enseignant.php">Ajouter un enseignant</a>
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
  
  


  <?php require('../include/admin/footer-admin.php')?>