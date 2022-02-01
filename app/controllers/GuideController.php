<?php
declare(strict_types=1);

class GuideController extends ControllerBase
{
    /* This action would allow the operator
     * to add a new guide to the system. The full
     * functionality is not implemented.
     */	
    public function createAction()
    {
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$response->setContent("this is it");
	$this->view->disable();
    }
    
    /* This controller action would allow users to update guide information..
     * Things like the guides, Age, interest, years of service, experience,
     * Resume, etc.  
     */
    public function updateAction()
    {
 	    $this->view->disable();
	    $request = $this->request;
	    $response = new \Phalcon\Http\Response();
	    $response->setContent(json_encode('Error'));
	    if ($request->isPost() && $request->isAjax()) {
	    }
	    return $response;
    }

    /* This action would deletre a guide. 
     * If the guide left the company or was fired
     * FishFry might want to remove this guide from
     * their system. 
     */
    public function deleteAction()
    {

    }

    /* This function reads all the guides 
     * that are active at FishFry
     */
    public function readAction()
    {
	$this->view->disable();
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$guides = new Guide();
	$data_read = $guides->getdata();
	if (!$data_read) {
		$response->setContent(json_encode("Error reading file"));
		return $response;
	}
	$response->setContent(json_encode($data_read));
	return $response;
    }
}

