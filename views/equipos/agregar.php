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
        <div class="col-md-8 jcc col-xs-12">
            <div class="white-box">
                <h2 class="text-center h1 mb-4">Registrar equipo</h2>
                <hr>
                <form class="form-horizontal form-material validate-form" m="save" c="equipo" id="form-login">
                    <div class="form-group validate-input">
                        <label class="col-md-12">Numero de bien</label>
                        <div class="col-md-12" data-validate="El numero de bien es requerido">
                            <input type="text" placeholder="ABC123456CDE" name="num_bien" class="form-control form-control-line input100 text-uppercase">
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-sm-12">Departamento</label>
                        <div class="col-sm-12" data-validate="El departamento es requerido">
                            <select class="form-control form-control-line input100 text-capitalize" name="departamento">
                                <option value="">-- Departamento donde esta el equipo --</option>
                            <?php 
                                $departamentos =  Utils::All('departamentos');
                                
                                foreach ($departamentos as $departamento) :
                            ?>
                                <option value="<?= $departamento['id'] ?>" class="text-capitalize"><?= $departamento['nombre']?></option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-sm-12">Marca</label>
                        <div class="col-sm-12" data-validate="La marca es requerida">
                            <select class="form-control form-control-line input100" name="marca" id="marca">
                                <option value="">-- Marca del equipo --</option>
                            <?php 
                                $marcas =  Utils::All('marcas');
                                
                                foreach ($marcas as $marca) :
                            ?>
                                <option value="<?= $marca['id'] ?>" class="text-capitalize"><?= $marca['nombre']?></option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-sm-12">Modelo</label>
                        <div class="col-sm-12" data-validate="El modelo es requerido">
                            <select class="form-control form-control-line input100" name="modelo" id="modelos">
                                <option value="">-- Modelo del equipo --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">CREAR EQUIPO</button>
                            <input class="btn btn-danger" type="reset" value="CANCELAR">
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