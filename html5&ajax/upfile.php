<?php 

if(empty($_FILES)){
	exit('no file');
}
if($_FILES['pic']['error'] != 0) {
	exit('upload fail');
}
move_uploaded_file($_FILES['pic']['tmp_name'], 'upload/'.$_FILES['pic']['name']);
echo 'success';
 ?>