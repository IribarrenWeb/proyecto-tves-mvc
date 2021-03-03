<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Departamentos</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="https://wrappixel.com/templates/ampleadmin/" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light logout">Salir</a>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Departamentos</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row dis-flex jcc">
        <div class="col-md-12 col-lg-8">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Listado de Departamentos</h2>
                <hr>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($departamentos as $departamento) :
                            ?>
                                <tr class="text-center">
                                    <td class="font-bold"><?= $departamento['id'] ?></td>
                                    <td class="text-capitalize"><?= $departamento['nombre'] ?></td>
                                    <td><?= ucfirst($departamento['descripcion']) ?></td>
                                    <td><button class="btn btn-block btn-info mod-dep" data-id="<?= $departamento['id'] ?>">Modificar</button></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Index</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-dept" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <h4 class="h2">Editar departamento</h4>
                    </div>

                    <form class="pl-3 pr-3 validate-form" m="update" c="departamento" data-type="departamento">
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END MAIN CONTENT -->