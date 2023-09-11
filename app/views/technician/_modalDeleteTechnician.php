<div class="modal fade" id="deleteTechnicianModal" tabindex="-1" role="dialog" aria-labelledby="deleteTechnicianModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/eliminar-tecnico" method="post" id="deleteTechnicianForm">
                <div class="modal-body d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                    <p class="ml-3 mb-0">¿Estás seguro de que deseas eliminar al técnico con el ID <span id="technicianIdToDelete"></span>?</p>
                    <!-- Campo oculto para el ID del técnico -->
                    <input type="hidden" name="technician_id" id="hiddenTechnicianId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>