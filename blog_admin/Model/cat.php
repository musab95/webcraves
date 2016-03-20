<?php
	include('conn.php');

	$category = mysqli_real_escape_string($conn, $_POST['category']);
	
	$sql = "INSERT INTO category (category) VALUES ('$category')";
	
	if(mysqli_query($conn, $sql)){
		
    	header("location:http://localhost/dev/blog_admin/category.php?success=1");
	} else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
 
// close connection
mysqli_close($conn);
?>