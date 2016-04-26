<?php

class api{

	public function getName() : string{
		return $this->name;
	}

	public function setName(string $name){
		$this->name = $name;
	}

	public function getVersion() : string{
		return $this->version;
	}

	public function setVersion(string $version){
		$this->version = $version;
	}

	public function getAuthor() : string{
		return $this->author;
	}

	public function setAuthor(string $author){
		$this->author = $author;
	}
}