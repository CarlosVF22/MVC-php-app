<?php
// Configuración de la conexión a la base de datos

$databaseConfig = [
    'host' => 'db',       
    'username' => 'admin',  
    'password' => 'admin123', 
    'database' => 'gestion-franca', 
];

// Crea una conexión a la base de datos
$conn = new mysqli(
    $databaseConfig['host'],
    $databaseConfig['username'],
    $databaseConfig['password'],
    $databaseConfig['database']
);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
?>