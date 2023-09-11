<div class="modal fade" id="updateTechnicianModal" tabindex="-1" role="dialog" aria-labelledby="updateTechnicianModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTechnicianModalLabel">Actualizar Técnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/actualizar-tecnico" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="updateTechnicianId" name="technician_id">
                    <div class="form-group">
                        <label for="updateName">Nombre</label>
                        <input type="text" class="form-control" id="updateName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="updateBaseSalary">Sueldo Base</label>
                        <input type="number" class="form-control" id="updateBaseSalary" name="base_salary" required>
                    </div>
                    <div class="form-group">
                        <label for="updateBranch">Sucursal</label>
                        <select class="form-control" id="updateBranch" name="branch_code" required>
                        </select>
                        <small class="form-text text-muted">Selecciona la sucursal del tecnico</small>
                    </div>
                    <div class="form-group">
                        <label>Elementos</label>
                        <table class="table" id="elementContainer">
                            <thead>
                                <tr>
                                    <th scope="col">Seleccionar</th>
                                    <th scope="col">Nombre del Elemento</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán los elementos dinámicamente desde JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
