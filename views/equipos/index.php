<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Equipos</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="https://wrappixel.com/templates/ampleadmin/" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light logout">Salir</a>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Equipos</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Listado de equipos</h2>
                <hr>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Numero de bien</th>
                                <th>Marca</th>
                                <th>Departamento asignado</th>
                                <th>Estatus</th>
                                <th>Fecha de incorporacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($equipos as $equipo) :
                                ?>
                                <tr class="text-center">
                                    <td class="font-bold"><a href="<?=url_base?>equipo/detalle&pc=<?=$equipo['id']?>"><?= $equipo['num_bien'] ?></a></td>
                                    <td class="font-bold"><?= $equipo['marca'] ?></td>
                                    <td class="font-bold"><?= $equipo['departamento'] ?></td>
                                    <td>
                                        <span class="badge badge-pill badge-<?= $equipo['estatus'] == 1 ? 'info' : 'danger' ?>">
                                            <?= $equipo['estatus'] == 1 ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($equipo['fecha_incorporacion'])) ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Numero de bien</th>
                                <th>Marca</th>
                                <th>Departamento asignado</th>
                                <th>Estatus</th>
                                <th>Fecha de incorporacion</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END MAIN CONTENT -->