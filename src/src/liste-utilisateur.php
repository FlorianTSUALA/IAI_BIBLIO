<?php 

require('../include/admin/header-admin.php');
require("../include/admin/nav-admin.php");
require("../include/admin/aside-admin.php");
require("../config/config.php");

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
                    <th>N°</th>
                    <th>Nom et Prenom</th>
                    <th>login</th>

                  </tr>
                  </thead>
                  <tbody>
                    <?php

                      $sql = "select * from utilisateur";
                      $requete = $connexion->prepare($sql);
                      $requete->execute();
                      $listes = $requete->fetchAll();
                      $i = 0;
                      foreach($listes as $liste) {
                        //var_dump($listes);
                        $i++;
                        $id = $liste['id'];
                        echo '<tr>';
                        echo "<td>".$i."</td>";
                        echo "<td>{$liste['nom_prenom']}</td>";
                        echo "<td>{$liste['login']}</td>";
                        echo "<td><a  href='modifier-utilisateur.php? id=$id'>
                                    <i class='fa fa-edit'></i></a></td>";
                        echo "<td><a  href='gerer-utilisateur.php? id=$id'
                        onclick=\"return confirm('VOULEZ VOUS SUPPRIMER CETTE LIGNE?')\"
                        ><i class='fa fa-trash'></i></a></td>";

                        echo "</tr>";
                      
                      }
                      

                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th> N°</th>
                    <th>Nom & Prenom </th>
                    <th>Departement</th>
                  </tr>
                  
                  </tfoot>

                </table>
                </br>
                <a class="btn btn-primary" href="ajouter-utilisateur.php">Ajouter un utilisateur</a>
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