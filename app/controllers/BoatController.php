<?php
declare(strict_types=1);
/*
 * This controller helps store, update, read and 
 * delete the boat information.
 * Curreently only the read part of the application 
 * is enabled.
 *
 * The core logic is stored under the Boats.php model file. 
 * Currently this file reads the data and saves boat data.
 */


class BoatController extends ControllerBase
{

    /*
     * This action would allow the operator
     * to add a new boat to the system.
     */		
    public function createAction()
    {
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$this->view->disable();
    }

    /* This action would allow the operator
     * to update the boat information. 
     * Things like:
     * Date of purchace
     * Knots travelled
     * Maintenance done
     * Current issues
     * Next date for maintenance
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

    /* This action would delete the boat
     * from the system. IF the boat is sold
     * or no longer in use, the operator could
     * delete the boat.
     */
    public function deleteAction()
    {

    }

    /* This function reads all the boats
     * stored in the system
     */
    public function readAction()
    {
	$this->view->disable();
        $response = new \Phalcon\Http\Response();
        $response->_isJsonResponse = true;
        $response->setContentType('application/json', 'UTF-8');
	$status = new Boat();
	$data_read = $status->getdata();
	if (!$data_read) {
		$response->setContent(json_encode("Error reading file"));
		return $response;
	}
	$response->setContent(json_encode($data_read));
	return $response;
    }
}

