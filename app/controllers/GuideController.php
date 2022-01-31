<?php
declare(strict_types=1);

class GuideController extends ControllerBase
{

    public function createAction()
    {
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$response->setContent("this is it");
	$this->view->disable();
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
		$data_read->boats[$boat_num]->status = $status_update;
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

    }

    public function readAction()
    {
	$this->view->disable();
	$data_read = file_get_contents(__DIR__ . '/../../public/data/guides.json');
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$response->setContent($data_read);
	return $response;
    }
}

