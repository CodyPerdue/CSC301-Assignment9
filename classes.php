<?php
require_once('json.php');
require_once('functions.php');

// readWriteFile::read(~~~, ~~~);
// readWriteFile::name = "name";
class readWriteFile {
	static public function read($file, $index=null) {
		readJSON($file, $index);
	}
	static public function write($file, $data) {
		writeJSON($file, $data);
	}
}

// $userOperation = new UserOperations;
// $userOperation->name = "name";
// $userOperation->function();
class userOperations {
	public function create($file, $data) {
		writeJSON($file, $data);
	}
	public function edit($file, $data, $index) { // add data to file
		modifyJSON($file, $data, $index);
	}
	public function edit($file, $index=null) { // read data, fill boxes
		readJSON($file, $index);
	}
	public function del($file, $index) {
		deleteJSON($file, $index);
	}
}

class mainApplication {
	public function item($id, $heading, $picture='https://via.placeholder.com/140x100', $body=null) {
		showItem($id, $heading, $picture, $body);
	}
	public function detail($name, $location, $age, $picture, $bio) {
		showDetail($name, $location, $age, $picture, $bio);
	}
}