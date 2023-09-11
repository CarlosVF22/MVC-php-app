<?php

require_once 'models/TechnicianModel.php';

class TechnicianController {
    public function save() {

        $name = $_POST['name'] ?? null;
        $branch_code = $_POST['branch_code'] ?? null;
        $base_salary = $_POST['base_salary'] ?? null;
        $elements = $_POST['elements'] ?? [];
        
        $quantities = [];
        foreach ($elements as $element_code) {
            if (isset($_POST['quantity_' . $element_code]) && !empty($_POST['quantity_' . $element_code])) {
                $quantities[] = $_POST['quantity_' . $element_code];
            } else {
                $quantities[] = 1;  // valor por defecto 1
            }
        }
        
        if (isset($name, $branch_code, $base_salary, $elements) && !empty($quantities)) {

            $technicianModel = new TechnicianModel();
            
            if ($technicianModel->createTechnician($name, $base_salary, $branch_code, $elements, $quantities)) {
                // Si se crea con éxito el técnico, redirigir a la ruta raíz
                header('Location: /');
                exit;
            } else {
                // Manejar el error si no se puede crear el técnico
                echo "Error al crear técnico.";
            }
        } else {
            // Maneja el error de datos faltantes
            echo "Faltan datos en el formulario";
        }
    }
}
