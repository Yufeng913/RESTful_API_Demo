<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Listing.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new property object
    $listing = new Listing($db);

    // Get raw listing data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $listing->id = $data->id;
    
    $listing->price = $data->price;
    $listing->address = $data->address;
    $listing->area = $data->area;
    $listing->agent = $data->agent;
    $listing->available = $data->available;

    // Update listing
    if ($listing->update()) {
        echo json_encode(
            array('message' => 'Listing Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Listing Not Updated')
            );
    }
    
    
