<?php

class Boat extends Phalcon\Mvc\Model
{
	const BOATS_PATH = __DIR__ . '/../../public/data/boats.json';

	public function getdata() {
		$api_file = file_get_contents($this::BOATS_PATH);
		if ($api_file) {
			return json_decode($api_file);
		}
		return null;
	}

	public function putdata($data, $json_true = FALSE) {
		if (!$json_true) {
			$data = json_encode($data);
		}
		return file_put_contents($this::BOATS_PATH, $data);
	}

}

?>
