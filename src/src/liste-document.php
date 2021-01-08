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
                  <th>N°</th>
                  <th>Theme</th>
                  <th>Cycle</th>
                  <th>Structure d'acceuil</th>
                  <th>Etudiant</th>
                  <th>Mots clés</th>
                  <th>Note</th>
                  <th>Superviseur</th>
                  <th>Année academique</th>
                  <th>image</th>
                  <th>date archive</th>
                </tr>
              </thead>
              <tbody>
                <?php

                require("../config/config.php");
                $sql = "SELECT d.id, d.theme, c.libelle AS cycle, 
                d.structure_accueil,d.etudiant, 
                d.liste_mots_cles AS mots_cles,
                d.note_obtenue AS note, e.nom_prenom, d.annee_academ,
                d.img_couv AS image, d.fichier, d.date_archive 
                FROM document d
                LEFT JOIN cycle c ON c.id = d.id_cycle
                LEFT JOIN enseignant e ON e.id = d.id_superviseur; ";
                $requete = $connexion->prepare($sql);
                $requete->execute();
                $listes = $requete->fetchAll();
                $i = 0;
                foreach ($listes as $element) {
                  $id = $element['id'];
                  $i++;
                  echo '<tr>';
                  echo "<td> ". $i . "</td>";
                  echo "<td>{$element['theme']}</td>";
                  echo "<td>{$element['cycle']}</td>";
                  echo "<td>{$element['structure_accueil']}</td>";
                  echo "<td>{$element['etudiant']}</td>";
                  echo "<td>{$element['mots_cles']}</td>";
                  echo "<td>{$element['note']}</td>";
                  echo "<td>{$element['nom_prenom']}</td>";
                  echo "<td>{$element['annee_academ']}</td>";
                  echo "<td>{$element['image']}</td>";
                  echo "<td>{$element['date_archive']}</td>";

                  echo "<td><a  href='modifier-document.php? id=$id'>
                                    <i class='fa fa-edit'></i></a></td>";
                  echo "<td><a  href='gerer-document.php? id=$id'
                        onclick=\"return confirm('Voulez-vous Supprimer cette ligne?')\"
                        ><i class='fa fa-trash'></i></a></td>";

                  echo "</tr>";
                }


                ?>
              </tbody>
              <tfoot>
                <tr>
                <th>Theme</th>
                  <th>Cycle</th>
                  <th>Structure d'acceuil</th>
                  <th>Etudiant</th>
                  <th>Mots clés</th>
                  <th>Note</th>
                  <th>Superviseur</th>
                  <th>Année academique</th>
                  <th>image</th>
                  <th>date archive</th>
                </tr>

              </tfoot>

            </table>
            </br>
            <a class="btn btn-primary" href="ajouter-document.php">Ajouter un Document</a>
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




<?php require('../include/admin/footer-admin.php') ?>