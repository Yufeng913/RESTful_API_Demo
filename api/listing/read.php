<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Listing.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate new listing object
    $listing = new Listing($db);

    // listing query
    $result = $listing->read();
    //Get row count
    $num = $result->rowCount();

    //Check if any listings
    if ($num > 0) {
        // listing Array
        $list_arr = array();
        $list_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $list_item = array(
                'id' => $id,
                'price' => $price,
                'address' => $address,
                'area' => $area,
                'agent' => $agent,
                'available' => $available                
            );
            
            // Push to "data"
            array_push($list_arr['data'], $list_item);
        }

        // Turn to JSON & output
        echo json_encode($list_arr);

    } else {
        // No Listings
        echo json_encode(
            array('message' => 'No Listings Found')
        );
    }

    