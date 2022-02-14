<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Listing.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new listing object
    $listing = new Listing($db);

    // Get raw listing data
    $data = json_decode(file_get_contents("php://input"));
    
    $listing->price = $data->price;
    $listing->address = $data->address;
    $listing->area = $data->area;
    $listing->agent = $data->agent;
    $listing->available = $data->available;

    // Create post
    if ($listing->create()) {
        echo json_encode(
            array('message' => 'Listing Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Listing Not Created')
            );
    }
    
    
