<!-- Signup modal content -->
<div id="registro-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl w-100">
        <div class="modal-content">

            <div class="modal-body table-responsive">
                <div class="text-center mt-2 mb-4">
                    <h4 class="h2">Registros de cambios</h4>
                </div>

                <table class="table table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col" class="text-center text-white">#</th>
                            <th scope="col" class="text-center text-white">Usuario</th>
                            <th scope="col" class="text-center text-white">Descripcion</th>
                            <th scope="col" class="text-center text-white">Fecha</th>
                            <th scope="col" class="text-center text-white">Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (COUNT($registros) >= 1) :
                            $cont = 1;
                            foreach ($registros as $m) :
                        ?>
                                <tr>
                                    <th scope="row"><?= $cont ?></th>
                                    <td class="text-capitalize font-bold">
                                        <a href="<?= url_base ?>user/detalle&u_id=<?= $m['usuario']['id'] ?>">
                                            <?= $m['usuario']['nombre'] . ' ' . $m['usuario']['apellido'] ?>
                                        </a>
                                    </td>
                                    <td><?= $m['descripcion'] ?></td>
                                    <td><?= date_format(date_create($m['fecha']), 'd-m-Y') ?></td>
                                    <td><?= date_format(date_create($m['fecha']), 'h:i a') ?></td>
                                </tr>
                            <?php
                                $cont++;
                            endforeach;
                        else :
                            ?>
                            <tr class="text-center">
                                <td colspan="4">No hay registros de modificaciones para este equipo</td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button class="btn btn-block btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->