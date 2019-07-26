<!-- Modal ver detalles de vacaciones -->
<div class="modal fade" id="susV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Estás segura que deseas suspender estas vacaciones?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmSusVac">

                    <label>Indique la causa de la suspención.</label>

                    <input type="hidden" name="id_Vac" id="id_Vac">

                    <select name="motivo_sus" id="motivo_sus" class="form-control">
                        <option value="Necesidad de servicio">Necesidad de servicio</option>
                    </select>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No suspender</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="susVac">Confirmar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>