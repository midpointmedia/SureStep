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
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class AgencyController extends AppController
{
    //public $layout = 'WeePee';

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
   


    public function SignUp()
    {
        $this->viewBuilder()->layout('WeePee');
        $appStatus = "PendingSubmission";

        try{
           $poc_email          = $this->request->data['poc_email']; 
        }
        catch(Exception $e){
            $poc_email = "";
        }

        if (!empty($poc_email))
        {
            $poc_name           = $this->request->data['poc_name'];
            $poc_phone          = $this->request->data['poc_phone'];
            $agency_name        = $this->request->data['agency_name'];
            $program_name       = $this->request->data['program_name'];
            $participant_count  = $this->request->data['participant_count'];
            $program_location   = $this->request->data['program_location'];
            $program_desc       = $this->request->data['program_desc'];
            $leadId             = "null"; 
            $verifyCode = uniqid();
        
            if(!is_int($participant_count)){
                $participant_count = 0;
            }

            $sql = "CALL weepee.SaveAgencyLead(".$leadId.",'".$agency_name."','".$program_name."','".$program_location."',".$participant_count.",'".$poc_name."','".$poc_email."','".$poc_phone."','".$program_desc."','".$verifyCode."',1,'website')";

            $conn = ConnectionManager::get('default');
            $sp_result = $conn->execute($sql)->fetchAll('assoc');
            
            //TODO:
            /// Send email to verify email address. Should contain verification code. 

            $appStatus = "PendingApproval";

        }
        else
        {

        }

        $this->set('formStatus', $appStatus);
    }
    
}
