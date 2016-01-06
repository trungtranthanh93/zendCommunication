<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Model\UserTable;
use Users\Model\ImageUpload;
use Users\Model\ImageUploadTable;



class MediaManagerController extends AbstractActionController
{
	protected $storage;
	protected $authservice;	
	protected $photos;

	public function getAuthService()
	{
		if (! $this->authservice) {
			$this->authservice = $this->getServiceLocator()->get('AuthService');
		}
	
		return $this->authservice;
	}
	
	public function getFileUploadLocation()
	{
		// Fetch Configuration from Module Config
    	$config  = $this->getServiceLocator()->get('config');
    	if ($config instanceof Traversable) {
    		$config = ArrayUtils::iteratorToArray($config);
    	}
    	if (!empty($config['module_config']['image_upload_location'])) {
    		return $config['module_config']['image_upload_location'];
    	} else {
    		return FALSE;
    	}
	}
	
    public function indexAction()
    {
    	$uploadTable = $this->getServiceLocator()->get('ImageUploadTable');
    	$userTable = $this->getServiceLocator()->get('UserTable');
    	$userEmail = $this->getAuthService()->getStorage()->read();
    	$user = $userTable->getUserByEmail($userEmail);
    	
    	$viewModel  = new ViewModel(
    			array(
    				'myUploads' => $uploadTable->getUploadsByUserId($user->id),
    				)
    		);
    	
    	return $viewModel;
    }

    public function processUploadAction()
    {
    	$userTable = $this->getServiceLocator()->get('UserTable');   	
    	$user_email = $this->getAuthService()->getStorage()->read();    	 
    	$user = $userTable->getUserByEmail($user_email);
		$form = $this->getServiceLocator()->get('ImageUploadForm');
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    	
    		$upload = new ImageUpload();
    		$uploadFile    = $this->params()->fromFiles('imageupload');
    		$form->setData($request->getPost());
    		
    		if ($form->isValid()) {
    			// Fetch Configuration from Module Config
    			$uploadPath    = $this->getFileUploadLocation();
    			// Save Uploaded file    	
      			$adapter = new \Zend\File\Transfer\Adapter\Http();
    			$adapter->setDestination($uploadPath);
    			
    			if ($adapter->receive($uploadFile['name'])) {
    				
    				$exchange_data = array();
    				$exchange_data['label'] = $request->getPost()->get('label');
    				$exchange_data['filename'] = $uploadFile['name'];
    				$exchange_data['thumbnail'] = $this->generateThumbnail($uploadFile['name']);
    				$exchange_data['user_id'] = $user->id;
    				
    				$upload->exchangeArray($exchange_data);
    				
    				$uploadTable = $this->getServiceLocator()->get('ImageUploadTable');
    				$uploadTable->saveUpload($upload);
    				
    				return $this->redirect()->toRoute('users/media');    				    				
    			}
    		}
    	}
    	 
    	return array('form' => $form);
    }
    
    public function generateThumbnail($imageFileName) 
    {
    	$path = $this->getFileUploadLocation();
    	$sourceImageFileName = $path . '/' . $imageFileName;
    	$thumbnailFileName = 'tn_' . $imageFileName;
    	
    	$imageThumb    = $this->getServiceLocator()->get('WebinoImageThumb');
    	$thumb          = $imageThumb->create($sourceImageFileName,$options = array());
    	$thumb->resize(75, 75);
    	$thumb->save($path . '/' . $thumbnailFileName);
    	
    	return $thumbnailFileName;
    }
    
    public function uploadAction()
    {
		$form = $this->getServiceLocator()->get('ImageUploadForm');
		$viewModel  = new ViewModel(array('form' => $form)); 
		return $viewModel; 
    }
    
    public function deleteAction()
    {
    	$uploadId = $this->params()->fromRoute('id');
    	$uploadTable = $this->getServiceLocator()
    					->get('ImageUploadTable');
    	$upload = $uploadTable->getUpload($uploadId);
    	$uploadPath    = $this->getFileUploadLocation();
    	// Remove File
   		unlink($uploadPath ."/" . $upload->filename);    	
   		unlink($uploadPath ."/" . $upload->thumbnail);
   		 
    	// Delete Records
    	$uploadTable->deleteUpload($uploadId);
    	
    	return $this->redirect()->toRoute('users/media');
    
    }
    
    public function viewAction()
    {
    	$uploadId = $this->params()->fromRoute('id');
    	$uploadTable = $this->getServiceLocator()
    	->get('ImageUploadTable');
    	$upload = $uploadTable->getUpload($uploadId);
    	
		$viewModel  = new ViewModel(array('upload' => $upload)); 
		return $viewModel; 
    
    }
    
    public function showImageAction()
    {  
    	$uploadId = $this->params()->fromRoute('id');
	    $uploadTable = $this->getServiceLocator()->get('ImageUploadTable');
	    $upload = $uploadTable->getUpload($uploadId);
	     
    	// Fetch Configuration from Module Config
    	$uploadPath    = $this->getFileUploadLocation();
    	if ($this->params()->fromRoute('subaction') == 'thumb') {
    		$filename = $uploadPath ."/" . $upload->thumbnail;
    	} else {
    		$filename = $uploadPath ."/" . $upload->filename;
    		
    	}
    	$file = file_get_contents($filename);
    	 
		// Directly return the Response 
		$response = $this->getEvent()->getResponse();
		$response->getHeaders()->addHeaders(array(
			'Content-Type' => 'application/octet-stream',
			'Content-Disposition' => 'attachment;filename="' .$upload->filename . '"',

		));
		$response->setContent($file);
		
		return $response;	    
    }

    
    
}    

