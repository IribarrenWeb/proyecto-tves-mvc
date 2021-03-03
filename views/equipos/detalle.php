<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Equipos</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <!--   -->
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Pagina de equipos</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- .row -->
    <div class="row dis-flex jcc">
        <div class="col-lg-8 col-md-10">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Detalle del equipo</h2>
                <hr>
                <div class="row px-5">
                    <div class="form-group col-md-6">
                        <label for="num_bien" class="mr-3">Numero de bien Nacional:  </label>
                        <input type="text" class="form-control" value="<?= $equipo['num_bien'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="num_bien" class="mr-3">Marca:  </label>
                        <input type="text" class="form-control" value="<?= $equipo['marca'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_bien" class="mr-3">Modelo:  </label>
                        <input type="text" class="form-control text-uppercase" value="<?= $equipo['modelo'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_bien" class="mr-3">Memoria RAM:  </label>
                        <input type="text" class="form-control text-uppercase" value="<?= $equipo['ram'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 ">
                        <label for="num_bien" class="mr-3">CPU:  </label>
                        <input type="text" class="form-control text-uppercase" value="<?= $equipo['cpu'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-7">
                        <label for="num_bien" class="mr-3">Departamento:  </label>
                        <input type="text" class="form-control" value="<?= ucfirst($equipo['departamento']) ?>" disabled>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="num_bien" class="mr-3">Fecha de incorporacion:  </label>
                        <input type="text" class="form-control" value="<?= date('d-m-Y', strtotime($equipo['fecha_incorporacion'])) ?>" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="num_bien">Descripcion del departamento:  </label>
                        <textarea class="form-control" disabled><?= ucfirst($equipo['descripcion']) ?></textarea>
                    </div>
                    <div class="form-group col-md-12 form-inline">
                        <label for="num_bien" class="mr-3 font-weight-bold">Estatus del equipo:  </label>
                        <span class="badge badge-pill badge-<?= $equipo['estatus'] == 1 ? 'info' : 'danger' ?>">
                            <?= $equipo['estatus'] == 1 ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Acciones</h2>
                <hr>
                <a class="btn text-white btn-block btn-primary" data-toggle="modal" data-target="#departamento-modal">
                    Asignar a otro departamento
                </a>
                <a class="btn text-white btn-block btn-primary" data-toggle="modal" data-target="#estatus-modal">
                    Cambiar estatus
                </a>
                <a class="btn text-white btn-block btn-primary" data-toggle="modal" data-target="#reporte-modal">
                    Emitir reporte del equipo
                </a>
                <?php
                    if(Utils::isAdmin(true)):
                ?>
                    <a class="btn text-white btn-block btn-primary" data-toggle="modal" data-target="#registro-modal">
                        Ver registro de modificaciones
                    </a>
                    <?php if(!$equipo['estatus']):?>
                    <a class="btn text-white btn-block btn-danger" data-toggle="modal" data-target=".alert-modal">
                        Eliminar registro
                    </a>
                <?php
                        endif;
                    endif;
                ?>
                
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!-- END MAIN CONTENT -->

<?php 

require_once './views/equipos/modals/editar.php';
if(Utils::isAdmin(true)){
    require_once './views/equipos/modals/registros.php';
    require_once './views/equipos/modals/delete.php';
}
require_once './views/equipos/modals/reporte.php';
require_once './views/equipos/modals/estatus.php';