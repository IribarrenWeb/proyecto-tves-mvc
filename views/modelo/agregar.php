<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Departamentos</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
             
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Agregar</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- .row -->
    <div class="row dis-flex jcc">
        <div class="col-md-8 jcc col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material validate-form" m="save" c="modelo" id="form-login">
                    <div class="form-group validate-input">
                        <label class="col-sm-12">Marca</label>
                        <div class="col-md-12" data-validate="La marca es requerida">
                            <select name="marca_id" class="form-control form-control-line input100 text-capitalize">
                                <option value="">-- Elige la marca del modelo --</option>
                            <?php
                                $marcas = Utils::All('marcas');
                                foreach ($marcas as $marca) :
                            ?>
                                <option value="<?= $marca['id'] ?>"><?= $marca['nombre'] ?></option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-md-12">Modelo</label>
                        <div class="col-md-12" data-validate="El modelo es requerido">
                            <input type="text" name="nombre" class="form-control form-control-line input100 text-capitalize">
                        </div>
                    </div>
                    <div class="form-group validate-input row">
                        <label class="col-md-12 dis-block">Memoria Ram</label>
                        <div class="col-sm-8" data-validate="La memoria ram es requerida">
                            <input type="text" name="ram" class="form-control form-control-line input100 text-capitalize">
                        </div>
                        <div class="col-sm-4" data-validate="El tipo de dato es requerido">
                            <select name="tipo" class="form-control form-control-line input100 text-capitalize">
                                <option value="">-- Tipo de dato --</option>
                                <option value="GB">GB</option>
                                <option value="MB">MB</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group validate-input">
                        <label class="col-md-12">CPU del modelo</label>
                        <div class="col-md-12" data-validate="El cpu es requerido">
                            <input type="text" name="cpu" class="form-control form-control-line input100 text-capitalize">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-primary">CREAR MODELO</button>
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