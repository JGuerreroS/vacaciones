<!-- Modal ver detalles de vacaciones -->
<div class="modal fade" id="delV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Estás segura que deseas eliminar este registro?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="frmDelVac">

                    <label>Indique la causa de la eliminación de este registro</label>

                    <input type="hidden" name="valVac" id="valVac">

                    <select name="motivo" id="motivo" class="form-control">
                        <option value="1">Error de transcipción</option>
                        <option value="2">Duplicado en la relación</option>
                        <option value="3">Servicio equivocado</option>
                    </select>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No borrar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteVac">Confirmar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>