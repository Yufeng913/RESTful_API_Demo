<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Property.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new property object
    $property = new Property($db);

    // Property query
    $result = $property->read();
    //Get row count
    $num = $result->rowCount();

    //Check if any properties
    if ($num > 0) {
        // Property Array
        $prop_arr = array();
        $prop_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $prop_item = array(
                'id' => $id,
                'price' => $price,
                'address' => $address,
                'area' => $area,
                'agent' => $agent                
            );
            
            // Push to "data"
            array_push($prop_arr['data'], $prop_item);
        }

        // Turn to JSON & output
        echo json_encode($prop_arr);

    } else {
        // No Properties
        echo json_encode(
            array('message' => 'No Properties Found')
        );
    }

    