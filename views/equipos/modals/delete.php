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
                <p>¿Estas seguro de querer eliminar este registro pc de la base de datos?</p>
                <p>Esta accion es irreversible</p>
            </div>
            <form class="modal-footer validate-form" m="delete" c="equipo">
                <button type="submit" class="btn btn-primary btn-block w-50">Eliminar</button>
                <button type="button" class="btn btn-danger btn-block w-50 mt-0" data-dismiss="modal">Cancelar</button>
                <input type="hidden" name="id" value="<?=$equipo['id']?>">
            </form>
        </div>
    </div>
</div>