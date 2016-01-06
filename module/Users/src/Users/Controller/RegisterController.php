<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\User;

class RegisterController extends AbstractActionController
{

    public function indexAction()
    {
        $form = $this->getServiceLocator()->get('RegisterForm');
        $viewModel = new ViewModel(array(
            'form' => $form
        ));
        return $viewModel;
        ;
    }

    public function processAction()
    {
        if (! $this->request->isPost()) {
            return $this->redirect()->toRoute('users/register');
        }
        
        $post = $this->request->getPost();
        
        $form = $this->getServiceLocator()->get('RegisterForm');
        $inputFilter = $this->getServiceLocator()->get('RegisterFilter');
        $form->setInputFilter($inputFilter);
        $form->setData($post);
        if (! $form->isValid()) {
            $model = new ViewModel(array(
                'error' => true,
                'form' => $form
            ));
            $model->setTemplate('users/register/index');
            return $model;
        }
        
        // Create user
        $this->createUser($form->getData());
        
        return $this->redirect()->toRoute('users/register', array(
            'action' => 'confirm'
        ));
    }

    public function confirmAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    protected function createUser(array $data)
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $user->setPassword($data['password']);
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $objectManager->persist($user);
        $objectManager->flush();
        
        return true;
    }
}