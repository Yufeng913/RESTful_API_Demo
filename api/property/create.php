<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Property.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new post object
    $property = new Property($db);

    // Get raw property data
    $data = json_decode(file_get_contents("php://input"));
    
    $property->price = $data->price;
    $property->address = $data->address;
    $property->area = $data->area;
    $property->agent = $data->agent;

    // Create post
    if ($property->create()) {
        echo json_encode(
            array('message' => 'Property Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Property Not Created')
            );
    }
    
    
