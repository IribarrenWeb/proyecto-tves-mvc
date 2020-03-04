<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Modelos</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="https://wrappixel.com/templates/ampleadmin/" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light logout">Salir</a>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Modelos</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Listado de Modelos</h2>
                <hr>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Memoria RAM</th>
                                <th>CPU</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($modelos as $modelo) :
                                ?>
                                <tr class="text-center">
                                    <td class="font-bold"><?= $modelo['id'] ?></td>
                                    <td class="font-bold text-uppercase"><?= $modelo['marca'] ?></td>
                                    <td class="text-uppercase"><?= $modelo['nombre'] ?></td>
                                    <td class="text-uppercase"><?= $modelo['ram'] ?></td>
                                    <td class="text-uppercase"><?= $modelo['cpu'] ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Index</th>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Memoria RAM</th>
                                <th>CPU</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END MAIN CONTENT -->