<?php

include_once("api.php");
defined("DS") || define("DS", DIRECTORY_SEPARATOR);

class plugin extends api{

	public function __construct(string $name, string $version, string $author){
		$this->name = $name;
		$this->version = $version;
		$this->author = $author;

		$this->dir = DS."plugins".DS;
		file_exists($this->dir) || mkdir($this->dir);

		$this->make();
	}

	public function make(){
		$next = $this->dir . DS . $this->name . "_v" . $this->version;
		file_exists($next) ? exit("すでに存在します\n") : mkdir($next);
		$data = <<<EOM
name: {$this->name}
main: {$this->name}\\Main
version: {$this->version}
author: {$this->author}
EOM;
		file_put_contents($next . DS . "plugin.yml", $data);
		$next .= DS . "src";
		mkdir($next);
		$next .= DS . $this->name;
		mkdir($next);
		$data = <<<EOM
<?php

namespace {$this->name};

use pocketmine\\math\\Vector3;
use pocketmine\\plugin\\PluginBase;

use pocketmine\\{Player, Server};

use pocketmine\\event\\{Listener, Cancellable};

class Main extends PluginBase implements Listener{

	public function onLoad(){
		\$this->server = Server::getInstance();
	}

	public function onEnable(){
		\$this->server->getPluginManager()->registerEvents(\$this, \$this);
	}
}
EOM;
		file_put_contents($next . DS . "Main.php", $data);
	}
}

new plugin(readline("Name: "), readline("Version: "), readline("Author: "));