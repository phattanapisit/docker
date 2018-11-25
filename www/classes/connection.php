<?php
$config_file = '../config';
if(is_dir($config_file)){
	require_once $config_file.'/connection.php';
}else{
	require_once 'config/connection.php';
}

class dbConnect
{
	private $db_host;
	private $db_user;
	private $db_pass;
	public $db_connect;
	public $db_name;
	private $char;

	public function dbConnect($db = null){
		$this->db_host = _db_host;
		$this->db_user = _db_user;
		$this->db_pass = _db_pass;
		$this->db_name = ($db != null ? $db :_db_name);
		$this->char = (!defined('_db_charset')) ? 'utf8' : _db_charset;
		$this->openConnection();
	}

	public function openConnection() // เปิดการเชื่อมต่อกับ MySQL
	{
		if($this->db_connect == ''){
			$this->db_connect  = mysql_connect($this->db_host, $this->db_user, $this->db_pass) or die( mysql_error() );
		}
		$this->selectDB();
	}
	
	public function selectDB()
	{
		mysql_select_db($this->db_name) or die( mysql_error() );
		$this->setChar();
	}
	 
	public function setChar($char = NULL) // เลือกฐานข้อมูลที่ต้องการเชื่อมต่อ
	{
		$this->char = ($char == '') ? $this->char : $char;
		switch (strtolower($this->char)){
			case 'utf8' :
				mysql_query("SET character_set_results='utf8'") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET character_set_client='utf8'") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET character_set_connection='utf8'") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_connection = utf8_general_ci") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_database = utf8_general_ci") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_server = utf8_general_ci") or die($this->showError('', __FILE__, __LINE__));
				break;
			case 'tis620' :
				mysql_query("SET character_set_results=tis620") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET character_set_client = tis620") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET character_set_connection = tis620") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_connection = tis620_thai_ci") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_database = tis620_thai_ci") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_server = tis620_thai_ci") or die($this->showError('', __FILE__, __LINE__));
				break;
			default :
				mysql_query("SET character_set_results='utf8'") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET character_set_client='utf8'") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET character_set_connection='utf8'") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_connection = 'utf8_general_ci'") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_database = utf8_general_ci") or die($this->showError('', __FILE__, __LINE__));
				mysql_query("SET collation_server = utf8_general_ci") or die($this->showError('', __FILE__, __LINE__));
				break;
		}
	}
	
	function showError($title = '', $file = '', $line = ''){
		echo "<pre style='border:1px solid #cccccc; padding : 10px;'>";
		$msg = $title;
		$msg .= "<br/>". mysql_error();
		if(isset($_SESSION['user_level']) && $_SESSION['user_level'] == 'admin'){
			$msg .= "<br/> $file Line $line.";
		}
		echo $msg;
		echo "</pre>";
		exit();
	}
	
	function dbClose() // ปิดการเชื่อมต่อกับ MySQL
	{
		mysql_close($this->db_connect);
	}
}


//END OF FILE