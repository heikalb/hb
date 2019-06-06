<?php
    $server = 'localhost';
    //$user = 'heikalbc_peppy';
    $user = 'heikalb2_admin';
    //$password = 'sifre';
    $password = 'wasspord';
    //$database = 'heikalbc_db';
    $database = 'heikalb2_db';
    $table = 'comments';

	//Get information
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

	//Quit if comment has no characters
	if(trim($comment) == '')
		exit(0);
    
    //Connect to server
    $connect = new mysqli($server, $user, $password, $database);

    if($connect->connect_error)
        echo 'Connection failed';

    //Prepared statement
    $stmt = $connect->prepare("INSERT INTO " . $table. " (name, email, comment, ip_address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $comment, $ip_address);
    
    //Send data
    $stmt->execute();

    $stmt->close();
    $connect->close();

	//Email data
	$to = "heikal93@gmail.com";
	$email_subject = "Comment on heikalb.com";
	$info = "You've received this comment on heikalb.com:\nFrom: $name\nEmail: $email\nComment: $comment\nIP address: $ip_address";
	mail($to, $email_subject, $info);

    header("Refresh: 0; url = index.html");
    exit(0);
?>