<?php
//Download files
$message = "Downloading...";
$error = "";
if(!empty($QB->PAGE->get_content()) && $QB->PAGE->get_content() != $QB->PAGE->get_page(true) && isset($_GET['v'])){
    //Get params
    $content = $QB->PAGE->get_content();
	$file_ext = 'zip';
	$version = $_GET['v'];
    $filepath = $QUICKBROWSE->TEMPLATE_ROOT . "/downloads/" . strtolower($content) . "/" . $version . "/" . $content . "." . $file_ext;
    
	//Check if user is logged in
	if($QB->USER->is_logged_in()){
		//Process download
		if(!headers_sent()){
			if(file_exists($filepath)){
				header('Content-Description: File Transfer');
				header('Content-Type: application/' . $file_ext);
				header("Content-Transfer-Encoding: Binary");
				header('Content-Length: ' . filesize($filepath));
				header('Content-Disposition: attachment; filename="'. strtolower($content) . '.' . $version . '.' . $file_ext . '"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				
				ob_clean();
				flush();
				
				readfile($filepath);
				exit;
			}else{
				$message = "Download doesn't exist...";
				$error = "Can't find the file: " . $filepath . '.';
			}
		}else{
			$message = "Couldn't start download...";
			$error = "HTTP headers already sent.";
		}
	}else{
		$QB->PAGE->redirect('/403/');
	}
	
}
?>