<div class="modal fade alert-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content rounded">
            <div class="modal-header bg-danger">
                <div class="h1 text-white text-center">
                    <i class="fa fa-exclamation-triangle"></i>
                    <h2 class="modal-title text-white">ALERTA</h5>
                </div>
            </div>
            <div class="modal-body">
                <p>¿Estas seguro de querer resetear la contrasena de este usuario?</p>
            </div>
            <form class="modal-footer validate-form" m="resetPassword" c="user">
                <button type="button" class="btn btn-danger btn-block w-50" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary btn-block w-50 mt-0">Resetear</button>
                <input type="hidden" name="u_id" value="<?=$usuario['id']?>">
            </form>
        </div>
    </div>
</div>