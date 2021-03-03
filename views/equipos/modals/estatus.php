<!-- Signup modal content -->
<div id="estatus-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <h4 class="h2">Cambiar estatus</h4>
                </div>

                <form class="pl-3 pr-3 validate-form" m="editar" c="equipo" data-id="<?= $equipo['id'] ?>" data-type="estatus">

                    <div class="form-group">
                        <label for="username">Estatus</label>
                        <select class="form-control" name="valor">
                            <option class="" value="<?= $equipo['estatus'] ?>"><?= $equipo['estatus'] == 1 ? 'Activo' : 'Inactivo' ?></option>
                            <option class="" value="<?= $equipo['estatus'] == 1 ? 0 : 1 ?>"><?= $equipo['estatus'] == 1 ? 'Inactivo' : 'Activo' ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" required name="password" placeholder="Enter your password">
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-block btn-primary" type="submit">Guardar cambio</button>
                        <button class="btn btn-block btn-danger" data-dismiss="modal">Cancelar</button>

                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->