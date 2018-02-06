<div class="contentheading">Downloads</div>
<?php
	$dir = 'downloads';
	if ($_GET['dir']) $dir = 'downloads/' . $_GET['dir'];

    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($dir);

	print_r('<ul>');
	
    // open directory and walk through the filenames
    while ($file = readdir($handler)) {
		// if file isn't this directory or its parent, add it to the results
		if ($file != "." && $file != "..") {
			if (is_dir('downloads/'.$file))
				print_r('<li><em><b><a href="index.php?con=downloads&dir='.$file.'">'.$file.'</a></b></em></li>');
			else
				print_r('<li><a href="downloads/'.$file.'" target="_blank">'.$file.'</a></li>');
		}
    }
	
	print_r('</ul>');
	
    // tidy up: close the handler
    closedir($handler);
	
	if ($_GET['dir'])
		print_r('<a href="index.php?con=downloads">Back</a>');
?>