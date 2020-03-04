<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Profile page</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade
                to Pro</a>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Profile Page</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- .row -->
    <div class="row dis-flex jcc">
        <div class="col-md-12">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Listado de usuarios</h2>
                <hr>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Indice</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Documento</th>
                                <th>Rol</th>
                                <th>Fecha de creacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($usuarios as $usuario) :
                            ?>
                                <tr class="text-center">
                                    <td class="font-bold"><?= $usuario['id'] ?></td>
                                    <td class="font-bold text-capitalize"><?= $usuario['nombre'] ?></td>
                                    <td class="font-bold text-capitalize"><?= $usuario['apellido'] ?></td>
                                    <td class="font-bold font-weight-bold"><a href="<?=url_base . 'user/detalle&u_id=' . $usuario['id']?>"><?= $usuario['documento'] ?></a></td>
                                    <td>
                                        <span class="badge badge-pill badge-<?= $usuario['role_color'] ?>">
                                            <?= $usuario['rolname']['name'] ?>
                                        </span>
                                    </td>
                                    <td><?= date('d / m / Y', strtotime($usuario['fecha_creacion'])) ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Indice</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Documento</th>
                                <th>Rol</th>
                                <th>Fecha de creacion</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!-- END MAIN CONTENT -->