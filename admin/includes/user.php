<?php


Class User extends Db_object {

	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;
	public $upload_directory = "../images";
	public $image_placeholder = "https://via.placeholder.com/300.png/09f/fff";
	public $errors = array();
	public $upload_errors_array = array(


	UPLOAD_ERR_OK           => "There is no error",
	UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
	UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
	UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
	UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
	UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
	UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
	UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
												

);




public function image_path_and_placeholder(){

	return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . '/' .  $this->user_image;
}


public static function verify_user($username,$password) {
	global $database;

$username = $database->escape_string($username);
$password = $database->escape_string($password);



$sql = "SELECT * FROM " . self::$db_table . " WHERE ";
$sql .= "username = '{$username}'";
$sql .= "AND password = '{$password}' ";
$sql .= "LIMIT 1";

$the_result_array = self::find_by_query($sql);

return !empty($the_result_array) ? array_shift($the_result_array) : false;


}


public function set_file_image($file) {

		if(empty($file) || !$file || !is_array($file)){
			$this->errors[] = "There was no file uploaded here";
			return false;
		} elseif ($file['error'] !=0) {

			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;
		} else {

			$this->filename = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type = $file['type'];
			$this->size = $file['size'];
			$this->user_image =$file['name']; 
		}


	}


public function save_user() {

		

			if (!empty($this->errors)){
				return false;
			} 

			if(empty($this->filename) || empty($this->tmp_path)) {
				$this->errors[] = "the file was not available";
				return false;
			}

			$target_path = "../images/" . $this->filename;


			if(file_exists($target_path)) {
				$this->errors[] = "The file {$this->filename} already exists";
				return false;
			}


			if(move_uploaded_file($this->tmp_path, $target_path)){

				if($this->update()) {

					unset($this->tmp_path);
					return true;
				}
			} else {

				$this->errors[] = "the file directory probably does not have permission ";
				return false;

			}

	}


	public function ajax_save_user_image($user_image, $user_id) {
		global $database;

		$user_image = $database->escape_string($user_image);
		$user_id    = $database->escape_string($user_id);


		$this->user_image = $user_image;
		$this->id = $user_id;


		$sql  = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
		$sql .= " WHERE id = {$this->id} ";
		$update_image = $database->query($sql);
	}



	

	


	




}



?>