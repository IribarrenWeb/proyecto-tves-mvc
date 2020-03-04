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
                <h2 class="text-center h1 mb-4">Editar usuario</h2>
                <hr>
                <form class="form-horizontal form-material validate-form" oninput="change(this)" m="update" c="user" data-option="datos" id="form-datos">
                    <div class="form-group validate-input">
                        <label class="col-md-12">Nombre</label>
                        <div class="col-md-12" data-validate="El nombre es requerido">
                            <input type="text" value="<?= $usuario['nombre'] ?>" name="nombre" class="form-control form-control-line input100">
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-md-12">Apellido</label>
                        <div class="col-md-12" data-validate="El apellido es requerido">
                            <input type="text" value="<?= $usuario['apellido'] ?>" name="apellido" class="form-control form-control-line input100">
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label for="example-email" class="col-md-12">Documento</label>
                        <div class="col-md-12" data-validate="El documento es requerido">
                            <input type="number" value="<?= $usuario['documento'] ?>" class="form-control form-control-line input100" name="documento">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success disabled" disabled='true'>ACTUALIZAR DATOS</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="white-box">
                <form class="form-horizontal form-material validate-form" m="update" c="user" data-option="pass" id="form-login">
                    <div class="form-group validate-input">
                        <label class="col-md-12">Contraseña</label>
                        <div class="col-md-12" data-validate="Este campo es requerido">
                            <input type="password" name="password" class="form-control form-control-line input100">
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-md-12">Contraseña nueva</label>
                        <div class="col-md-12" data-validate="Este campo es requerido">
                            <input type="password" name="password1" class="form-control form-control-line input100">
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label for="example-email" class="col-md-12">Confirmar contraseña</label>
                        <div class="col-md-12" data-validate="Este campo es requerido">
                            <input type="password" name="password2" class="form-control form-control-line input100" name="documento">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">ACTUALIZAR PASSWORD</button>
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