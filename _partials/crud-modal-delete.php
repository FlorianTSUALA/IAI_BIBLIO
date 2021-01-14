
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #001232; opacity: 0.7; border: 1px solid #2d4186;" >
                <div class="modal-header text-center" style="display: block; border-bottom: 1px solid #2d4186;" >
                    <a href="#" class="close" style="color: #fff;">&times;</a>
                    <h3>Supression d'un <?= $model ?></h3>
                </div>
                <div class="modal-body">
                    <h6 class="amount" >Voulez vous vraiment supprimer le <?= $model ?> : <b><i class="title cate"></i></b>; <br><br> Cette action est irreverssible</h6>
                    <br><p>Supprimer cet enregistrement ?</p>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #2d4186;" >
                    <button type="button" class=" custom-button transparent" data-dismiss="modal">Annuler</button>
                    <button type="button" class=" btn-ok custom-button">Supprimer</button>
                </div>
            </div>
        </div>
    </div>