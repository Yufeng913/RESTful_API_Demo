<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Agent.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new agent object
    $post = new Agent($db);

    // Get raw agent data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $post->id = $data->id;

    // Delete agent
    if ($post->delete()) {
        echo json_encode(
            array('message' => 'Agent Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Agent Not Deleted')
            );
    }
    
    
