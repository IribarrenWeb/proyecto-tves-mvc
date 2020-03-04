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
        <div class="col-md-8 jcc col-xs-12">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Crear usuario</h2>
                <hr>
                <form class="form-horizontal form-material validate-form" m="registro" c="user" id="form-login">
                    <div class="form-group validate-input">
                        <label class="col-md-12">Nombre</label>
                        <div class="col-md-12" data-validate="El nombre es requerido">
                            <input type="text" placeholder="Johnathan Doe" name="nombre" class="form-control form-control-line input100">
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-md-12">Apellido</label>
                        <div class="col-md-12" data-validate="El apellido es requerido">
                            <input type="text" placeholder="Johnathan Doe" name="apellido" class="form-control form-control-line input100">
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label for="example-email" class="col-md-12">Documento</label>
                        <div class="col-md-12" data-validate="El documento es requerido">
                            <input type="number" placeholder="V-11223355" class="form-control form-control-line input100" name="documento">
                        </div>
                    </div>
                    <!-- <div class="form-group validate-input">
                        <label class="col-md-12">Password</label>
                        <div class="col-md-12" data-validate="El password es requerido">
                            <input type="password" placeholder="*******" name="password" class="form-control form-control-line input100">
                        </div>
                    </div> -->
                    <div class="form-group validate-input">
                        <label class="col-sm-12">Rol</label>
                        <div class="col-sm-12" data-validate="El rol es requerido">
                            <select class="form-control form-control-line input100" name="rol">
                                <option value="">-- Elige el rol del usuario --</option>
                                <?php
                                    foreach ($roles as $rol) :
                                ?>
                                        <option value="<?= $rol['id'] ?>"><?= $rol['rolname']['name']?></option>
                                <?php
                                    endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">CREAR USUARIO</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<!-- END MAIN CONTENT -->