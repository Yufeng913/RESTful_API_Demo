<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Agent.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new agent object
    $post = new Agent($db);

    // Get ID
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get agent
    $post->read_single();

    // Create array
    $post_arr = array(
      'id' => $post->id,
      'agent_name' => $post->agent_name,
      'age' => $post->age,
      'email' => $post->email,
      'category_id' => $post->category_id
    );

    //Make JSON
    print_r(json_encode($post_arr));
