<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Marcas</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="https://wrappixel.com/templates/ampleadmin/" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light logout">Salir</a>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Marcas</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row dis-flex jcc">
        <div class="col-md-12 col-lg-8">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Listado de marcas</h2>
                <hr>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Nombre</th>
                                <th>Modelos asignados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($marcas as $marca) :
                                ?>
                                <tr class="text-center">
                                    <td class="font-bold"><?= $marca['id'] ?></td>
                                    <td class="text-capitalize"><?= $marca['nombre'] ?></td>
                                    <td class="font-bold"><?= $marca['modelos'] ?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Index</th>
                                <th>Nombre</th>
                                <th>Modelos asignados</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END MAIN CONTENT -->