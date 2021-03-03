<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h2 class="page-title">Dashboard</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 dis-flex justify-content-end">
            <span class="dis-flex align-self-center h4">
                Bienvenido 
                <span class="text-primary ml-2">
                    <?= ucfirst($_SESSION['usuario']['nombre']) . ' ' . ucfirst($_SESSION['usuario']['apellido']) ?>
                </span>
            </span>
        </div>
    </div>
    <div class="row m-t-25">
        <div class="col-md-6">
            <div class="card border-bottom shadow border-info">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?=$equipos?></h2>
                            <h6 class="text-info">Equipos registrados</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-info display-6"><i class="ti-notepad"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-bottom shadow border-cyan">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2><?=$usuarios?></h2>
                            <h6 class="text-cyan">Usuarios registrados</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-cyan display-6"><i class="ti-clipboard"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6">
            <div class="card border-bottom shadow border-success">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2>450</h2>
                            <h6 class="text-success">Equipos activos</h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-success display-6"><i class="ti-wallet"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-bottom shadow border-orange">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h2>100</h2>
                            <h6 class="text-orange"></h6>
                        </div>
                        <div class="ml-auto">
                            <span class="text-orange display-6"><i class="ti-stats-down"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- /.container-fluid -->
<!-- END MAIN CONTENT -->