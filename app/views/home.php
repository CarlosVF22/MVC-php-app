<!DOCTYPE html>
<html>
    <!-- head -->
    <?php include '/var/www/html/views/layout/head.php'; ?>
    <body>
        <!-- Navbar -->
        <?php include '/var/www/html/views/layout/navbar.php'; ?>
        <main class="container mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Lista de Técnicos</h2>
                <button class="btn btn-success create-btn">Crear Técnico</button>
            </div>
            <?php if (empty($technicians)) : ?>
                <p class="mt-4">No hay técnicos inscritos.</p>
            <?php else : ?>
                <table class="table mt-4">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Sueldo Base</th>
                            <th>Sucursal</th>
                            <th>Elementos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($technicians as $technician) : ?>
                        <tr data-tech-id="<?php echo $technician['code']; ?>"
                            data-tech-name="<?php echo $technician['name']; ?>"
                            data-tech-salary="<?php echo $technician['base_salary']; ?>"
                            data-tech-branch="<?php echo $technician['branch_name']; ?>">
                            <td><?php echo $technician['code']; ?></td>
                            <td><?php echo $technician['name']; ?></td>
                            <td><?php echo $technician['base_salary']; ?></td>
                            <td><?php echo $technician['branch_name']; ?></td>
                            <td>
                                <?php 
                                foreach ($technician['elements'] as $element => $quantity) {
                                    echo $element . ': ' . $quantity . '<br>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#" title="Editar"><i class="fas fa-edit"></i></a>
                                <a href="#" title="Eliminar" data-technician-id="<?php echo $technician['code']; ?>" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </main>

        <!-- Incluyendo modales -->
        <?php include '/var/www/html/views/technician/_modalCreateTechnician.php'; ?>
        <?php include '/var/www/html/views/technician/_modalDeleteTechnician.php'; ?>
        <?php include '/var/www/html/views/technician/_modalUpdateTechnician.php'; ?>

        <footer class="mt-5">
            <!-- Información de contacto o enlaces adicionales -->
        </footer>

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.querySelector('.create-btn').addEventListener('click', function() {
                $('#createTechnicianModal').modal('show');
            });

            document.querySelectorAll('a[title="Eliminar"]').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    // Obtener el ID del técnico desde el atributo data-technician-id
                    const technicianId = this.getAttribute('data-technician-id');
                    document.getElementById('technicianIdToDelete').innerText = technicianId; // Muestra el ID en el modal
                    document.getElementById('hiddenTechnicianId').value = technicianId; // Inserta el ID en el campo oculto
                    $('#deleteTechnicianModal').modal('show'); // Muestra el modal
                });
            });

            document.querySelectorAll('a[title="Editar"]').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    const row = this.closest('tr');

                    const technicianId = row.getAttribute('data-tech-id');
                    const technicianName = row.getAttribute('data-tech-name');
                    const technicianSalary = row.getAttribute('data-tech-salary');
                    const technicianBranch = row.getAttribute('data-tech-branch');
                    
                    document.getElementById('updateTechnicianId').value = technicianId;
                    document.getElementById('updateName').value = technicianName;
                    document.getElementById('updateBaseSalary').value = technicianSalary;
                    // Aquí puedes agregar otros campos según lo requieras

                    $('#updateTechnicianModal').modal('show');
                });
            });

            $('#updateTechnicianModal').on('show.bs.modal', function (e) {
                // Podrías hacer una solicitud AJAX aquí para obtener las sucursales y elementos 
                $.ajax({
                    url: '/api/lista-sucursales',
                    method: 'GET',
                    success: function(data) {
                        const selectBranch = document.getElementById('updateBranch');
                        selectBranch.innerHTML = ""; 
                        data.sucursales.forEach(function(branch) {
                            const option = document.createElement('option');
                            option.value = branch.code;
                            option.textContent = branch.name;
                            selectBranch.appendChild(option);
                        });
                    }
                });
                $.ajax({
                    url: '/api/lista-elementos',
                    method: 'GET',
                    success: function(data) {
                        if (!data || !data.elementos) {
                            console.error('No se recibieron datos válidos de la API.');
                            return;
                        } else {
                            console.log('datos recibidos');
                            console.log(data);
                        }

                        const tableBody = document.querySelector('#elementContainer tbody');

                        // Borrar todas las filas existentes.
                        while (tableBody.firstChild) {
                            tableBody.removeChild(tableBody.firstChild);
                        }

                        data.elementos.forEach(function(element) {
                            const row = document.createElement('tr');
                            const tdCheckbox = document.createElement('td');
                            const tdName = document.createElement('td');
                            const tdQuantity = document.createElement('td');

                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.className = 'element-checkbox';
                            checkbox.name = 'elements[]';
                            checkbox.value = element.code;

                            const quantityInput = document.createElement('input');
                            quantityInput.type = 'number';
                            quantityInput.name = `quantity_${element.code}`;
                            quantityInput.placeholder = "Cantidad";
                            quantityInput.min = '1';
                            quantityInput.max = '10';
                            quantityInput.className = 'form-control';
                            quantityInput.style.width = '70px';

                            tdCheckbox.appendChild(checkbox);
                            tdName.textContent = element.name;
                            tdQuantity.appendChild(quantityInput);

                            row.appendChild(tdCheckbox);
                            row.appendChild(tdName);
                            row.appendChild(tdQuantity);

                            tableBody.appendChild(row);
                        });

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error al cargar elementos:', textStatus, errorThrown);
                    }
                });

            });
        </script>
    </body>
</html>
