<?php 
sleep(3);
if (empty($_FILES)) {
	exit('no file');
}
$error = $_FILES['pic']['error'] == 0 ? 'success' : 'fail';

echo "<script>parent.document.getElementById('progress').innerHTML = '$error'</script>";


 ?>