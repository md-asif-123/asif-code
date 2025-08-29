
<?php

/**
 * Update qna  
 */

 session_start();


 include('../../public/database/connection.php');
 include('srb-function.php');
 
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get the employee code from the request
$sap_code = isset($_GET['sap_code']) ? $_GET['sap_code'] : '';

// Prepare and execute the SQL query
$stmt = $connection->prepare("SELECT hq, level, region, zone FROM import_sapcode WHERE sap = ?");
$stmt->bind_param("s", $sap_code);
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $response = [
        'success' => true,
        'data' => [
            'hq' => $row['hq'],
            'level' => $row['level'],
            'region' => $row['region'],
            'zone' => $row['zone']
        ]
    ];
} else {
    $response = ['success' => false];
}

// Close the connection
$stmt->close();
$connection->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
