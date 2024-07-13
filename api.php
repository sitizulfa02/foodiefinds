<?php


//simple api for database insertion
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


require_once('db.php');

 if (!isset($_POST['name']) && !isset($_POST['comments']) ){
   die("Error incomplete HTTP request");



 }

 if (strlen($_POST['name']) < 3  || strlen($_POST['comments'])<5) {

   die("Error plese fill in the form");

 }

//kena filter semua input, bahaya kalau tak filter
$POSTV = filter_input_array(INPUT_POST,
    ['name' => FILTER_SANITIZE_STRING,
     'email' => FILTER_SANITIZE_STRING,
     'comments' => FILTER_SANITIZE_STRING,
     'lat' => FILTER_SANITIZE_STRING,
     'lng' => FILTER_SANITIZE_STRING,
    ]
);
$name = $POSTV['name'];
$email = $POSTV['email'];
$addr = $_SERVER['REMOTE_ADDR'];
$comments = $POSTV['comments'];
$lat = floatval($POSTV['lat']);
$lng = floatval($POSTV['lng']);
$agent = $_SERVER['HTTP_USER_AGENT'];


$query= "INSERT INTO comments (id, name, email, ip_address, user_agent, comments, lat, lng)
VALUES (NULL,'$name','$email','$addr','$agent', '$comments','$lat','$lng')";

$result=mysqli_query($link, $query);

if (!$result) {

  echo mysqli_error($link);

} else {

echo "Comments posted";

}


 ?>