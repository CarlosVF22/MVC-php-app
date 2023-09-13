<?php
// Configuración de la conexión a la base de datos

$databaseConfig = [
    'host' => 'laraveldb.c5b7jfvplena.us-east-1.rds.amazonaws.com',       
    'username' => 'admin',  
    'password' => 'cihijMB8T0QDQ6ZpF1CX', 
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