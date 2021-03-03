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
                <h2 class="text-center h1 mb-4">Detalle del usuario</h2>
                <hr>
                <div class="row px-5">
                    <div class="form-group col-md-6">
                        <label for="num_bien" class="mr-3">Nombre:  </label>
                        <input type="text" class="form-control text-capitalize" value="<?= $usuario['nombre'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="num_bien" class="mr-3">Apellido:  </label>
                        <input type="text" class="form-control text-capitalize" value="<?= $usuario['apellido'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_bien" class="mr-3">Documento:  </label>
                        <input type="text" class="form-control text-uppercase" value="<?= $usuario['documento'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="num_bien" class="mr-3">Identificador:  </label>
                        <input type="text" class="form-control text-uppercase" value="<?= $usuario['id'] ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 ">
                        <label for="num_bien" class="mr-3">Fecha de creacion:  </label>
                        <input type="text" class="form-control text-uppercase" value="<?= date('d-m-Y ', strtotime($usuario['fecha_creacion'])) ?>" disabled>
                    </div>
                    <div class="form-group col-md-12 form-inline">
                        <label for="num_bien" class="mr-3 font-weight-bold">Rol del usuario:  </label>
                        <span class="badge badge-pill badge-<?= $usuario['role_color']?>">
                            <?= $usuario['rolname']['name'] ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php
                if($_SESSION['usuario']['id'] != $usuario['id'] && Utils::isAdmin(true)):
            ?>
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Acciones</h2>
                <hr>
                <!-- <a class="btn text-white btn-block btn-primary" data-toggle="modal" data-target="#registro-modal">
                    Editar usuario
                </a> -->
                <a class="btn text-white btn-block btn-primary" data-toggle="modal" data-target=".alert-modal">
                    Resetear contrasena
                </a>
                <!-- <a class="btn text-white btn-block btn-primary" data-toggle="modal" data-target="#signup-modal">
                    Eliminar usuario
                </a> -->
            </div>
            <?php
                endif;
            ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!-- END MAIN CONTENT -->

<!-- Modal alert -->
<?php

require_once './views/usuarios/modals/alert_modal.php';