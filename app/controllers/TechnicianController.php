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

    public function delete() {
        $technician_id = $_POST['technician_id'] ?? null;
    
        if ($technician_id) {
            $technicianModel = new TechnicianModel();
            if ($technicianModel->deleteTechnician($technician_id)) {
                // Si se elimina con éxito el técnico, redirigir a la ruta raíz
                header('Location: /');
                exit;
            } else {
                // Manejar el error si no se puede eliminar el técnico
                echo "Error al eliminar técnico.";
            }
        } else {
            // Maneja el error de datos faltantes
            echo "Faltan datos en el formulario";
        }
    }

    public function update() {
        $technician_id = $_POST['technician_id'] ?? null;
        $name = $_POST['name'] ?? null;
        $base_salary = $_POST['base_salary'] ?? null;
        $branch_code = $_POST['branch_code'] ?? null;
        $elements = $_POST['elements'] ?? [];
        
        // Asumiendo que la cantidad de elementos sigue el mismo patrón que la creación
        $quantities = [];
        foreach ($elements as $element_code) {
            if (isset($_POST['quantity_' . $element_code]) && !empty($_POST['quantity_' . $element_code])) {
                $quantities[] = $_POST['quantity_' . $element_code];
            } else {
                $quantities[] = 1;  // valor por defecto 1
            }
        }
    
        if (isset($technician_id, $name, $base_salary, $branch_code, $elements) && !empty($quantities)) {
            $technicianModel = new TechnicianModel();
            if ($technicianModel->updateTechnician($technician_id, $name, $base_salary, $branch_code, $elements, $quantities)) {
                header('Location: /');
                exit;
            } else {
                echo "Error al actualizar técnico.";
            }
        } else {
            echo "Faltan datos en el formulario";
        }
    }
}
