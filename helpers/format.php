<?php
 // FORMAT CLASS

class Format{
	public function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}
// shorten out text file and move to READ MORE	
	public function textShorten($text, $limit=300){
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		 $text = substr($text, 0,strrpos($text, ' '));
					//	 strrpos can help you to get last full word....like word not wor/wo
		$text = $text. " ...";
		return $text;
	}

// LOGIN validation and security to save our website from any scripting language

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

//this function will help us to show title name
	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title =basename($path, '.php');
		if ($title == 'index') {
			$title = 'home';
		}elseif ($title =='contact') {
			$title = 'contact';
		}
		return $title = ucwords($title);
	}

}
?>