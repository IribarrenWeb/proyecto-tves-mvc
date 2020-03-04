<!-- Signup modal content -->
<div id="departamento-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <h4 class="h2">Editar departamento</h4>
                </div>

                <form class="pl-3 pr-3 validate-form" m="editar" c="equipo" data-id="<?=$equipo['id']?>" data-type="departamento">

                    <div class="form-group">
                        <label for="username">Departamento</label>
                        <select class="form-control" name="valor" id="departamentoModal">
                            <option class="" value="<?=$equipo['d_id']?>"><?=ucfirst($equipo['departamento'])?></option>
                    <?php
                        $departamentos = Utils::Where('departamentos',$equipo['d_id'],'id !=');
                        foreach ($departamentos as $departamento) :
                    ?>
                            <option class="" value="<?=$departamento['id']?>"><?=ucfirst($departamento['nombre'])?></option> 
                    <?php
                        endforeach;
                    ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="emailaddress">Descripcion del departamento</label>
                        <textarea class="form-control" cols="30" rows="10" disabled id="m-d-descript"><?= ucfirst($equipo['descripcion']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" required name="password" placeholder="Enter your password">
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-block btn-primary" type="submit">Guardar cambio</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->