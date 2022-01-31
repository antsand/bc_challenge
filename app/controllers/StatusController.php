<?php
declare(strict_types=1);

class StatusController extends ControllerBase
{

    public function createAction()
    {
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$response->setContent("this is it");
 	    $this->view->disable();
	    $request = $this->request;
	    $response = new \Phalcon\Http\Response();
	    $response->setContent(json_encode('Error'));
	    if ($request->isPost() && $request->isAjax()) {
		$boat_selected = $request->getPost('boat_selected');
		$guide_selected = $request->getPost('guide_selected');
		$data_read = file_get_contents(__DIR__ . '/../../public/data/data.json');
		$data_read = json_decode($data_read);
		$boat_add = new StdClass();
		$boat_add->status = 'docked';
		$boat_add->name = $boat_selected;
		$boat_add->guide = $guide_selected;
		array_push($data_read->boats, $boat_add);
		file_put_contents(__DIR__ . '/../../public/data/data.json', json_encode($data_read));
		$response = new \Phalcon\Http\Response();
		$response->_isJsonResponse = true;
		$response->setContentType('application/json', 'UTF-8');
		$response->setContent(json_encode($data_read));
	    }
	    return $response;
    }
    
    public function updateAction()
    {
 	    $this->view->disable();
	    $request = $this->request;
	    $response = new \Phalcon\Http\Response();
	    $response->setContent(json_encode('Error'));
	    if ($request->isPost() && $request->isAjax()) {
		$boat_num = $request->getPost('boat_num');
		$status_update = $request->getPost('status_update');
		$data_read = file_get_contents(__DIR__ . '/../../public/data/data.json');
		$data_read = json_decode($data_read);
		$data_read->boats[intval($boat_num)]->status = $status_update;
		file_put_contents(__DIR__ . '/../../public/data/data.json', json_encode($data_read));
		$response = new \Phalcon\Http\Response();
		$response->_isJsonResponse = true;
		$response->setContentType('application/json', 'UTF-8');
		$response->setContent(json_encode($data_read));
	    }
	    return $response;
    }

    public function deleteAction()
    {
 	    $this->view->disable();
	    $request = $this->request;
	    $response = new \Phalcon\Http\Response();
	    $response->setContent(json_encode('Error'));
	    if ($request->isPost() && $request->isAjax()) {
		$boat_num = $request->getPost('boat_num');
		$data_read = file_get_contents(__DIR__ . '/../../public/data/data.json');
		$data_read = json_decode($data_read);
		array_splice($data_read->boats, intval($boat_num), 1);
		file_put_contents(__DIR__ . '/../../public/data/data.json', json_encode($data_read));
		$response = new \Phalcon\Http\Response();
		$response->_isJsonResponse = true;
		$response->setContentType('application/json', 'UTF-8');
		$response->setContent(json_encode($data_read));
	    }
	    return $response;

    }

    public function readAction()
    {
	$this->view->disable();
	$data_read = file_get_contents(__DIR__ . '/../../public/data/data.json');
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$response->setContent($data_read);
	return $response;
    }
}

