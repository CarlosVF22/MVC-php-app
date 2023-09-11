<div class="modal fade" id="createTechnicianModal" tabindex="-1" role="dialog" aria-labelledby="createTechnicianModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTechnicianModalLabel">Crear Técnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/crear-tecnico" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="branch">Sucursal:</label>
                        <select class="form-control" id="branch_code" name="branch_code" required>
                            <?php 
                            foreach ($branches as $branch) {
                                echo "<option value='" . $branch['code'] . "'>" . $branch['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="elements">Elementos:</label>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Seleccionar</th>
                                    <th scope="col">Nombre del Elemento</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($elements as $element) {
                                        echo '<tr>';
                                        echo '<td><input type="checkbox" class="element-checkbox" name="elements[]" value="' . $element['code'] . '"></td>';
                                        echo '<td>' . $element['name'] . '</td>';
                                        echo '<td><input type="number" name="quantity_' . $element['code'] . '" placeholder="Cantidad" min="1" max="10" class="form-control" style="width: 70px;"></td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <small class="form-text text-muted">Seleccione el checkbox del elemento y luego ingrese la cantidad deseada. Si no especifica una cantidad, se asumirá un valor predeterminado de 1.</small>
                    </div>



                    <div class="form-group">
                        <label for="base_salary">Sueldo Base:</label>
                        <input type="number" step="0.01" class="form-control" id="base_salary" name="base_salary" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const checkboxes = document.querySelectorAll(".element-checkbox");
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            let selectedCount = 0;
            checkboxes.forEach(c => {
                if (c.checked) selectedCount++;
            });
            if (selectedCount > 10) {
                alert("Puede seleccionar un máximo de 10 elementos.");
                this.checked = false;
            }
        });
    });
</script>


