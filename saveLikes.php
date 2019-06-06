<?php
    $server = 'localhost';
    //$user = 'heikalbc_peppy';
    $user = 'heikalb2_admin';
    //$password = 'sifre';
    $password = 'wasspord';
    //$database = 'heikalbc_db';
    $database = 'heikalb2_db';
    $table = 'likes';
    
    //Connect to server
    $connect = new mysqli($server, $user, $password, $database);

    if($connect->connect_error)
        echo 'Connection failed';

    //Prepared statement
    $stmt = $connect->prepare("INSERT INTO " . $table. " (image_name, image_caption, ip_address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $imgName, $imgCap, $ip_address);
    
    //Get information
    $imgName = $_POST['image_name'];
    $imgCap = $_POST['image_caption'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    //Send data
    $stmt->execute();
    $stmt->close();

	//Email data
	$to = "heikal93@gmail.com";
	$email_subject = "A like on heikalb.com";
	$info = "You've received a 'like' on heikalb.com:\nImage file name: $imgName\nCaption: $imgCap\nIP address: $ip_address";
	mail($to, $email_subject, $info);

    $connect-close();
    exit(0);
?>