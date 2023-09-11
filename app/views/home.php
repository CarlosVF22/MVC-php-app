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
                </tr>
                </thead>
                <tbody>
                <?php foreach ($technicians as $technician) : ?>
                    <tr>
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
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        </main>

        <!-- Incluyendo el modal -->
        <?php include '/var/www/html/views/technician/_modalCreateTechnician.php'; ?>

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
        </script>
    </body>
</html>
