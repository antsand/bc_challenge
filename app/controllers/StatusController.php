<?php
declare(strict_types=1);
/*
  This controller file help display and modify the status of the boats. 
  There are four main actions. 
	Create -> Add a new boat 
	Update -> Changes the status of the boat
	Read -> Views the boat
	Delete -> Removes a boat

	The model is where the logic is stored. 
	The model file is under the folder app/models/Status.php. 
	Every action in this controller call the getdata() and putdata() function.

	getdata() fetches the saved API file
	putdata() saves the updated API file

	The API file is stored under public/data/data.json 

	Currently, there is no database attached to this application. Hence the data, for now, is stored in a file. 
 */

class StatusController extends ControllerBase
{
    /* This action adds a new boat */	
    public function createAction()
    {
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
 	    $this->view->disable();
	    $request = $this->request;
	    $response = new \Phalcon\Http\Response();
	    $response->setContent(json_encode('Error'));
	    if ($request->isPost() && $request->isAjax()) {
		$boat_selected = $request->getPost('boat_selected');
		$guide_selected = $request->getPost('guide_selected');
		/* Using the Status model to fetch the API data. */
		$status = new Status();
		$data_read = $status->getdata();
		if (!$data_read) {
			$response->setContent(json_encode("Error reading file"));
			return $response;
		}	
		/* Using the Status model to add a new boat. */
		$status->adddata($data_read, $boat_selected, $guide_selected);
		/* Using the Status model to save the API data. */
		$status->putdata($data_read);
		$response->setContent(json_encode($data_read));
	    }
	    return $response;
    }

    /* This action changes the status of the boat */  
    public function updateAction()
    {
 	    $this->view->disable();
	    $request = $this->request;
	    $response = new \Phalcon\Http\Response();
	    $response->_isJsonResponse = true;
	    $response->setContentType('application/json', 'UTF-8');
	    $response->setContent(json_encode('Error'));
	    if ($request->isPost() && $request->isAjax()) {
		$boat_num = $request->getPost('boat_num');
		$status_update = $request->getPost('status_update');
		/* using the Status model to fetch the API data. */
		$status = new Status();
		$data_read = $status->getdata();
		if (!$data_read) {
			$response->setContent(json_encode("Error reading file"));
			return $response;
		}	
		$data_read->boats[intval($boat_num)]->status = $status_update;
		$status->putdata($data_read);
		$response->setContent(json_encode($data_read));
	    }
	    return $response;
    }

    /* This action deletes one boat */
    public function deleteAction()
    {
 	    $this->view->disable();
	    $request = $this->request;
	    $response = new \Phalcon\Http\Response();
	    $response->_isJsonResponse = true;
	    $response->setContentType('application/json', 'UTF-8');
	    $response->setContent(json_encode('Error'));
	    if ($request->isPost() && $request->isAjax()) {
		$boat_num = $request->getPost('boat_num');
		$status = new Status();
		$data_read = $status->getdata();
		if (!$data_read) {
			$response->setContent(json_encode("Error reading file"));
			return $response;
		}
		$status->removedata($data_read, $boat_num);	
		$status->putdata($data_read);
		$response->setContent(json_encode($data_read));
	    }
	    return $response;

    }

    /* This action reads the data from the data.json API file */
    public function readAction()
    {
	$this->view->disable();
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$status = new Status();
	$data_read = $status->getdata();
	if (!$data_read) {
		$response->setContent(json_encode("Error reading file"));
		return $response;
	}
	$response->setContent(json_encode($data_read));
	return $response;
    }
}

