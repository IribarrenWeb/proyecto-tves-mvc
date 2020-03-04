<!-- Signup modal content -->
<div id="pass-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header h3 font-bold">
                ¡Cambia la contraseña!
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3 validate-form" id="pass-form" method="changePass" cont="user">

                    <div class="form-group">
                        <label for="password">Contraseña nueva</label>
                        <input class="form-control" type="password" required name="password" placeholder="Intoduce tu contraseña">
                    </div>

                    <div class="form-group">
                        <label for="conf_password">Confirmar contraseña</label>
                        <input class="form-control" type="password" required name="conf_password" placeholder="Confirma tu contraseña">
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-block btn-primary" type="submit">Guardar cambios</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
