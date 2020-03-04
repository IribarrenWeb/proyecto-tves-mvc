<page style="font-size: 14px">
    <div class="head">
        <div style="margin-bottom: 20px;text-align:center">
            <img src="<?= assets ?>images/TVes_logo.png" style="width: 70px; height: 70px;" alt="">
            <span style="font-weight: bold; font-size: 20px">Reporte</span>
        </div>

        <div style="border-bottom: 1px solid lightgrey; width: 95%; height: 1px; margin:auto;"></div>

        <div style="padding-left: 10px;">
            <!-- <strong>Datos del equipo:</strong><br><br> -->

            <strong>Marca: </strong> <?= $equipo['marca'] ?><br>
            <strong>Modelo: </strong> <?= strtoupper($equipo['modelo']) ?><br>
            <strong>Num. Bien Nacional: </strong> <span style="color:blue"><?= $equipo['num_bien'] ?></span><br>
            <strong>CPU: </strong> <?= $equipo['cpu'] ?><br>
            <strong>RAM: </strong> <?= $equipo['ram'] ?><br>
            <strong>Departamento asignado: </strong> <?= strtoupper($equipo['departamento']) ?><br>
            <strong>Socicitado por:</strong>
            <span style="background-color: lightblue; margin-left: 3px">
                <?=strtoupper($_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'])?>
            </span><br>
            <strong>Fecha de reporte:</strong> <span style="background-color: yellow"><?=date('d/m/Y', strtotime($query_fecha))?></span>
            
        </div>
    </div>

    <div class="main">
        <h4 style="text-align: center; font-weight: lighter; margin-bottom: 20px;">
            Reporte de modificaciones del periodo
            <strong>
                (<?= date('d/m/Y', strtotime($query_fecha)) . ' -- ' . date('d/m/Y', strtotime($fecha)) ?>)
            </strong>
        </h4>

        <table border="1" style="max-width: 100%;">
            <thead class="thead">
                <tr>
                    <th>#</th>
                    <th>Modificacion</th>
                    <th>Documento usuario</th>
                    <th>Nombre de usuario</th>
                    <th>Fecha Mod.</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <?php
                if (COUNT($modificaciones) >= 1) :
                    $contador = 1;
                    foreach ($modificaciones as $modificacion) :
                ?>
                        <tr style="text-align: center">
                            <td style="width: 8% ; padding: 10px 15px; vertical-align: middle;"><?= $contador ?></td>
                            <td style="width: 30%; padding: 10px 15px; vertical-align: middle;line-height: 1.3; text-align: justify">
                                <?= wordwrap($modificacion['descripcion'], 55, '<br/ >') ?>
                            </td>
                            <td style="width: 10%; padding: 10px 15px; vertical-align: middle;"><?= $modificacion['documento'] ?></td>
                            <td style="width: 10%; padding: 10px 15px; vertical-align: middle;"><?=strtoupper( $modificacion['nombre'] . ' ' . $modificacion['apellido'] )?></td>
                            <td style="width: 10%; padding: 10px 15px; vertical-align: middle;"><?= date('d-m-Y h:i a', strtotime($modificacion['fecha'])) ?></td>
                        </tr>
                <?php
                        $contador++;
                    endforeach;
                else :
                ?>
                    <tr style="text-align: center">
                        <td colspan="5">No hay modificaciones en el periodo seleccionado.</td>
                    </tr>
                <?php
                endif
                ?>
            </tbody>
        </table>
    </div>

    <div class="foot">

    </div>


</page>


<style type="text/Css">

table{
    margin: auto;
    border-collapse: collapse;
}
.main{
    width: 100%;
}

.head{
    border: 1px solid red; 
    border-radius: 5px;
    width: 92%;
    padding: 10px 20px;
}

table thead th{
    color: #fff;
    font-weight: bold;
    font-size: 13px;
    background-color: #343a40;
    border-color: #454d55;
    padding: 15px 18px;
}

table tbody td{
    max-width: 30px;
    word-wrap: break-word;
}

hr{
    border: 0.5px solid grey;
    margin:auto;
}
</style>