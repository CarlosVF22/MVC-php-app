<?php

class TechnicianModel {
    public function getAllTechnicians() {
        global $conn;
        $sql = "
            SELECT 
                Technician.code, 
                Technician.name, 
                Technician.base_salary, 
                Branch.name AS branch_name,
                GROUP_CONCAT(CONCAT(Element.name, ' (', Technician_Element.quantity, ')') SEPARATOR ', ') AS elements 
            FROM Technician
            LEFT JOIN Branch ON Technician.branch_code = Branch.code
            LEFT JOIN Technician_Element ON Technician.code = Technician_Element.technician_code
            LEFT JOIN Element ON Technician_Element.element_code = Element.code
            GROUP BY Technician.code, Technician.name, Technician.base_salary, Branch.name
        ";

        $result = $conn->query($sql);

        $technicians = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $elementsArray = [];
                if ($row['elements'] !== null) { // Verifica si 'elements' no es nulo antes de procesar
                    $elementsPairs = explode(', ', $row['elements']);
                    foreach ($elementsPairs as $pair) {
                        $pairArray = explode(' (', rtrim($pair, ')'));
                        if (isset($pairArray[1])) { // Verifica que el array tenga al menos 2 elementos
                            $element = $pairArray[0];
                            $quantity = $pairArray[1];
                            $elementsArray[$element] = $quantity;
                        }
                    }
                }
                $row['elements'] = $elementsArray;
                $technicians[] = $row;
            }
        }
        

        return $technicians;
    }


    public function createTechnician($name, $base_salary, $branch_code, $elements, $quantities) {
        global $conn; 
        
        // Primero, insertamos el Technician
        $stmt = $conn->prepare("INSERT INTO Technician (name, base_salary, branch_code) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $base_salary, $branch_code); 
        
        if (!$stmt->execute()) {
            echo "Error al insertar el técnico";
            return false;
        }
        
        $stmt->close();
        
        // Obtenemos el ID del técnico recién insertado
        $technician_id = $conn->insert_id;
    
        // Insertamos los elementos en la tabla Technician_Element
        $stmt = $conn->prepare("INSERT INTO Technician_Element (technician_code, element_code, quantity) VALUES (?, ?, ?)");
        
        foreach ($elements as $index => $element_code) {
            $quantity = $quantities[$index];
            $stmt->bind_param("iii", $technician_id, $element_code, $quantity);
            
            if (!$stmt->execute()) {

                echo "Error al insertar el elemento para el técnico";
                return false;
            }
        }
        
        $stmt->close();
        return true;
    }

    public function deleteTechnician($technician_code) {
        global $conn;
    
        // Primero, eliminamos las entradas relacionadas en la tabla Technician_Element
        $stmt = $conn->prepare("DELETE FROM Technician_Element WHERE technician_code = ?");
        $stmt->bind_param("i", $technician_code);
    
        if (!$stmt->execute()) {
            return false;
        }
    
        $stmt->close();
    
        // Luego, eliminamos el técnico de la tabla Technician
        $stmt = $conn->prepare("DELETE FROM Technician WHERE code = ?");
        $stmt->bind_param("i", $technician_code);
    
        if (!$stmt->execute()) {
            return false;
        }
    
        $stmt->close();
        
        return true;
    }
}






