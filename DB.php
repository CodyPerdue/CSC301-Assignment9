<?php

class DB {
	public static function connect() {
		$settings=[
			'host'=>'localhost',
			'db'=>'csc301_database',
			'user'=>'root',
			'pass'=>''
		];
		$opt=[
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES=>FALSE,
		];
		$pdo=new PDO('mysql:host='.$settings['host'].';dbname='.$settings['db'].';charset=utf8mb4',$settings['user'],$settings['pass'],$opt);	// CONNECT TO DATABASE
		return $pdo;
	}
}

class User {
	public $name;
	public $email;
	public $password;
	
	public function signup() {
		$pdo=DB::connect();
		$q=$pdo->prepare('SELECT ID FROM users WHERE email=?');
		$q->execute([$this->email]);
		if($q->rowCount()>0) die('The user already exists.');
		$q=$pdo->prepare('INSERT INTO users (name, email, password) VALUES (?,?,?)');
		$q->execute([$this->name, $this->email, password_hash($this->password, PASSWORD_DEFAULT)]);
	}
	
	public function signin() {
		$pdo=DB::connect();
		$q=$pdo->prepare('SELECT ID FROM users WHERE email=? AND password=?');
		$q->execute([$this->email, $this->password]);
		if($q->rowCount()==0) die('The user does not exist or the password is incorrect.');
	}
}

class Pet {
	public $name;
	public $location;
	public $age;
	public $bio;
	public $picture;
	public $ID;
	
	public function create() {
		$pdo=DB::connect();
		$q=$pdo->prepare('SELECT ID FROM pets WHERE name=? AND location=? AND age=?');
		$q->execute([$this->name, $this->location, $this->age]);
		if($q->rowCount()>0) die('This pet is already registered.');
		$q=$pdo->prepare('INSERT INTO pets (name, location, age, bio, picture) VALUES (?,?,?,?,?)');
		$q->execute([$this->name, $this->location, $this->age, $this->bio, $this->picture]);
	}
	
	public function edit() {
		$pdo=DB::connect();
		$q=$pdo->prepare('SELECT ID FROM pets WHERE name=? AND location=? AND age=?');
		$q->execute([$this->name, $this->location, $this->age]);
		if($q->rowCount()==0) die('This pet does not exist.');
		$q=$pdo->prepare('UPDATE pets SET name=?, location=?, age=?, bio=?, picture=? WHERE name=? AND location=? AND age=?');
		$q->execute([$this->name, $this->location, $this->age, $this->bio, $this->picture, $this->name, $this->location, $this->age]);
	}
	
	public function read() {
		// READ FROM DATABASE, STORE INTO VARIABLES
	}
	
	public function remove() {
		$pdo=DB::connect();
		$q=$pdo->prepare('SELECT ID FROM pets WHERE name=? AND location=? AND age=?');
		$q->execute([$this->name, $this->location, $this->age]);
		if($q->rowCount()==0) die('This pet does not exist.');
		$q=$pdo->prepare('DELETE FROM pets WHERE name=? AND location=? AND age=?');
		$q->execute([$this->name, $this->location, $this->age]);
	}
}