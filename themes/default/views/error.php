<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="container">
		<h1><?php echo $heading; ?></h1>
		<?php
			$pretty_json = json_encode($json, JSON_PRETTY_PRINT);
			echo '<pre>'.$pretty_json.'</pre>'; ?>
	</div>
