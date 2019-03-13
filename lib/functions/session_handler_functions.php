<?php
require_once(ABSPATH . 'wp-admin/includes/file.php');

class File_Session_Handler
{
	private $savePath = PIXFLOW_THEME_SESSION ;

	function open($sessionName)
	{
		if (!is_dir($this->savePath)) {
			wp_mkdir_p($this->savePath);
		}

		return true;
	}

	function close()
	{
		return true;
	}

	function read($id)
	{
		WP_Filesystem(false,false,true);
		global $wp_filesystem;
		return (string)@$wp_filesystem->get_contents("$this->savePath/sess_$id");
	}

	function write($id, $data)
	{
		WP_Filesystem(false,false,true);
		global $wp_filesystem;
		return $wp_filesystem->put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
	}

	function destroy($id)
	{
		WP_Filesystem(false,false,true);
		global $wp_filesystem;
		$file = "$this->savePath/sess_$id";
		if (file_exists($file)) {
			$wp_filesystem->delete($file);
		}

		return true;
	}

	function gc($max_life_time)
	{
		WP_Filesystem(false,false,true);
		global $wp_filesystem;
		foreach (glob("$this->savePath/sess_*") as $file) {
			if (filemtime($file) + $max_life_time < time() && file_exists($file)) {
				$wp_filesystem->delete($file);
			}
		}

		return true;
	}
}

