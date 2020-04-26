<?php

function jsonToArray(string $file) {
	return json_decode(file_get_contents($file), true);
}

function showItem($id, $heading, $picture='https://via.placeholder.com/140x100', $body=null) {
	if(!isset($body)) $body='<a href="details.php?id='.$id.'">Read details</a>';
	echo '<div class="media">
 <a href="details.php?id='.$id.'"> <img src="'.$picture.'" class="mr-3" alt="" width="140"></a>
  <div class="media-body">
    <h5 class="mt-0"><a href="details.php?id='.$id.'">'.$heading.'</a></h5>
    '.$body.'
  </div>
</div>';
}


function showDetail($name, $location, $age, $picture, $bio) {
	echo '<h1>'.$name.'</h1>
	<h3>'.$location.'</h3>
	<p>'.$age.'</p>
	<img src="'.$picture.'" width="500" />
	<p>'.$bio.'</p>';
}

?>