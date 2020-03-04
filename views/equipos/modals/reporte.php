<!-- Signup modal content -->
<div id="reporte-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <h4 class="h2">Tipo de reporte</h4>
                </div>

                <form class="pl-3 pr-3" action="reporte" method="POST" target="_blank">

                    <div class="form-group">
                        <label for="tipo">Seleccionar tipo de reporte</label>
                        <select class="form-control mt-2" name="tipo">
                            <option class="" value="month">Mensual</option>
                            <option class="" value="year">Anual</option> 
                        </select>
                        <small class="text-secondary h6">Selecciona el tipo de reporte que quieres generar.</small>
                        <input type="hidden" name="id" value="<?=$equipo['id']?>">
                    </div>

                    <div class="form-group d-flex w-100">
                        <button type="button" class="btn btn-block mr-1 btn-danger" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-block ml-1 mt-0 btn-primary" type="submit">Generar reporte</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->