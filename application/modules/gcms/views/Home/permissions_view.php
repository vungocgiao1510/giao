<?php 
if($error){
	echo '<div class="alert alert-danger" role="alert">' . $error. '</div>';
	if($descriptionerr){
		echo '<div class="alert alert-danger" role="alert">' . $descriptionerr. '</div>';
	}
}
?>