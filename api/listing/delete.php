<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    // Set ID to update
    $listing->id = $data->id;

    // Delete post
    if ($listing->delete()) {
        echo json_encode(
            array('message' => 'Listing Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Listing Not Deleted')
            );
    }
    