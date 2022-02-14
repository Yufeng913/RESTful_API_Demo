<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Property.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new property object
    $property = new Property($db);

    // Get raw property data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $property->id = $data->id;
    
    $property->price = $data->price;
    $property->address = $data->address;
    $property->area = $data->area;
    $property->agent = $data->agent;

    // Update property
    if ($property->update()) {
        echo json_encode(
            array('message' => 'Property Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Property Not Updated')
            );
    }
    
    
