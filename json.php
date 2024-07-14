<?php

//simple database to json conversion script
// Writen by Mohammad Hafiz bin Ismail

/***
    Copyright (c) 2021 by Mohammad Hafiz bin Ismail (mypapit@gmail.com)
    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:

    1. Redistributions of source code must retain the above copyright notice, this list
    of conditions and the following disclaimer.

    2. Redistributions in binary form must
    reproduce the above copyright notice, this list of conditions and the following
    disclaimer in the documentation and/or other materials provided with the
    distribution.

    THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
    REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND
    FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
    INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS
    OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER
    TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF
    THIS SOFTWARE.
***/





<?php
// Include the database connection file
include 'db.php';

// Initialize an array to hold the data
$foodtrucks = array();

// SQL query to fetch the data
$query = "SELECT id, operator_name, schedule, foodtruck_name, menu_items, latitude, longitude FROM foodtrucks";
$result = mysqli_query($link, $query);

if ($result) {
    // Fetch data and populate the array
    while ($row = mysqli_fetch_assoc($result)) {
        $foodtrucks[] = array(
            'id' => $row['id'],
            'operator_name' => $row['operator_name'],
            'schedule' => $row['schedule'],
            'foodtruck_name' => $row['foodtruck_name'],
            'menu_items' => $row['menu_items'],
            'lat' => $row['latitude'],
            'lng' => $row['longitude']
        );
    }
    
    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($foodtrucks);
} else {
    // If query fails, output an error
    echo json_encode(array('error' => 'Error fetching data from database'));
}

// Close the database connection
mysqli_close($link);
?>
