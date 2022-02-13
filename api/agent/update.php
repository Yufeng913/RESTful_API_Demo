<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Agent.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new post object
    $post = new Agent($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $post->id = $data->id;
    
    $post->agent_name = $data->agent_name;
    $post->age = $data->age;
    $post->email = $data->email;
    $post->category_id = $data->category_id;

    // Update post
    if ($post->update()) {
        echo json_encode(
            array('message' => 'Post Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Updated')
            );
    }
    
    
