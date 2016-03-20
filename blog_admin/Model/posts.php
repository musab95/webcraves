<?php
	include('conn.php');

	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$content = mysqli_real_escape_string($conn, $_POST['content']);
	$img = $_FILES["img"]["name"];
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $title);
	$date = date("Y/m/d");

	$sql = "INSERT INTO posts (title, content, img, slug, date) VALUES ('$title', '$content', '$img', '$slug', '$date')";

	if(mysqli_query($conn, $sql)){
		if(isset($_FILES['img'])){
	      $errors= array();
	      $file_name = $_FILES['image']['name'];
	      $file_size =$_FILES['image']['size'];
	      $file_tmp =$_FILES['image']['tmp_name'];
	      $file_type=$_FILES['image']['type'];
	      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	      
	      $expensions= array("jpeg","jpg","png");
	      
	      if(in_array($file_ext,$expensions)=== false){
	         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
	      }
	      
	      if($file_size > 2097152){
	         $errors[]='File size must be excately 2 MB';
	      }
	      
	      if(empty($errors)==true){
	         move_uploaded_file($file_tmp,"images/".$file_name);
	         echo "Success";
	      }else{
	         print_r($errors);
	      }
	    }
		
    	header("location:http://localhost/dev/blog_admin/post.php?success=1");
	} else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
 
// close connection
mysqli_close($conn);
?>