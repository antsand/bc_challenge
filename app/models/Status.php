<?php

class Status extends Phalcon\Mvc\Model
{
	const STATUS_PATH = __DIR__ . '/../../public/data/data.json';

	public function getdata() {
		$api_file = file_get_contents($this::STATUS_PATH);
		if ($api_file) {
			return json_decode($api_file);
		}
		return null;
	}

	public function putdata($data, $json_true = FALSE) {
		if (!$json_true) {
			$data = json_encode($data);
		}
		return file_put_contents($this::STATUS_PATH, $data);
	}

	public function checkduplicateboat($data, $boat_selected, $guide_selected) {
		/* Loop through the entry and see if the boat name exist */
		if (!$data) {
			return -1;
		}
		foreach($data->boats as $boats_added) {
			if ($boats_added->name == $boat_selected) {
				return 1;
			}
		} 
		return 0;
	}
	
	public function checkduplicateguide($data, $boat_selected, $guide_selected) {
		/* Loop through the entry and see if the boat name exist */
		if (!$data) {
			return -1;
		}
		foreach($data->boats as $boats_added) {
			if ($boats_added->guide == $guide_selected) {
				return 1;
			}
		} 
		return 0;
	}

	public function adddata($data, $boat_selected, $guide_selected) {
		$boat_add = new StdClass();
		/* By default, the status will be under
		 * 'Docked'
		 */ 
		$boat_add->status = 'docked';
		$boat_add->name = $boat_selected;
		$boat_add->guide = $guide_selected;
		array_push($data->boats, $boat_add);
		return $data;
	}
	
	public function removedata($data, $index){
		array_splice($data->boats, intval($index), 1);
		return $data;

	}


}

?>
