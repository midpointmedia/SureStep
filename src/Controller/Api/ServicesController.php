<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ServicesController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
	public function ColorsByDate()
	{
		//http://localhost/weepee/api/services/colors_by_date/?id=C87CB1E0-E5AB-8EF3-891B877E5D4BAE67
		$id = $this->request->query['id'];
		
		//TODO: allow to pass in other dates. 

		$conn = ConnectionManager::get('default');
    	$proc_result = $conn->execute("CALL weepee.getColorsByDate('". $id ."','" . date("Y-m-d") . "')")->fetchAll('assoc');
		               
        $this->response->body(json_encode($proc_result));

    	return $this->response;
	}

	public function TodaysColors()
	{
		//http://localhost/weepee/api/services/todays_colors/?id=C87CB1E0-E5AB-8EF3-891B877E5D4BAE67
		$id = $this->request->query['id'];
		
		$conn = ConnectionManager::get('default');
    	$proc_result = $conn->execute("CALL weepee.getTodaysColors2('". $id ."')")->fetchAll('assoc');
		               
        $this->response->body(json_encode($proc_result));

    	return $this->response;
	}
	
	public function SaveSettings()
	{
		//http://localhost/weepee/api/services/save_settings/
		//file_put_contents("test.txt",$data);
		try
		{
			$data = file_get_contents('php://input');
			$json_data = json_decode($data);

			$firebaseToken 		= $json_data->firebase_token;
			$participantColor 	= $json_data->participant_color;
			$participantName 	= $json_data->participant_name;
			$programId 			= $json_data->program_id;
			$recoveryDate 		= $json_data->recovery_date;
			
			$conn = ConnectionManager::get('default');
			$proc_result = $conn->execute("CALL weepee.SaveAppInstall('". $firebaseToken ."', '".$participantColor."', '".$participantName."', '".$programId."','".$recoveryDate."')");
	  		$proc_result2 = 'saved';
	          
	        $this->response->body(json_encode($data->data));

	    	return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->body(json_encode("FAILED"));

	    	return $this->response;
		}

	}
	
	public function ProgramColors()
	{
		//http://localhost/weepee/api/services/program_colors/?id=C87CB1E0-E5AB-8EF3-891B877E5D4BAE67
		$id = $this->request->query['id'];
		
		$conn = ConnectionManager::get('default');
    	$proc_result = $conn->execute("CALL weepee.getDistinctColorsByProgram('". $id ."')")->fetchAll('assoc');
		               
        $this->response->body(json_encode($proc_result));

    	return $this->response;
	}

	public function SaveCall()
	{
		//http://floresfilms.com/api/services/save_call/

		/*
		AccountSid          The unique identifier of the Account responsible for this recording.
		CallSid             A unique identifier for the call associated with the recording. This will always refer to the parent leg of a two leg call.
		RecordingSid        The unique identifier for the recording.
		RecordingUrl        The URL of the recorded audio.
		RecordingStatus     The status of the recording. Possible values are: completed.
		RecordingDuration   The length of the recording, in seconds.
		RecordingChannels   The number of channels in the final recording file as an integer. Possible values are 1, 2.
		RecordingSource   
		*/

		//$acctSid = $this->request->getData('AccountSid');
		$callSid = $this->request->getData('CallSid','000');
		$recordingSid = $this->request->getData('RecordingSid','000');
		$recordingUrl = $this->request->getData('RecordingUrl','000');
		$recordingDuration = $this->request->getData('RecordingDuration',0);
		$recordingText = $this->request->getData('TranscriptionText',"fired....");

		$uaPhoneNumber = "9155551212";
		

		$conn = ConnectionManager::get('default');
		$call_result = $conn->execute("CALL SaveCall(null, Now(), '" . $uaPhoneNumber . "', " . $recordingDuration . ", '" . $recordingUrl . "' , '" . $recordingText . "', '" . $callSid . "', null, '" . $recordingSid . "', 0)")->fetchAll('assoc');
           
		//$proc_result = $conn->execute("CALL weepee.getRegions()")->fetchAll('assoc');
		//$proc_result = $conn->query("CALL weepee.saveUserSettings(".$id.",'".$androidId."','".$regId."','".$color."','".$programId."','".$uaProviderId."','".$counselingId."',".$baiidCount.",'".$sex."', DATE('".$sobrietyDate."'), DATE('".$programStartDate."'))");
		$proc_result2 = 'saved';
		          
        $this->response->body(json_encode($proc_result2));

    	return $this->response;
	}
	
	
}
