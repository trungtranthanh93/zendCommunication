<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserManagerController extends AbstractActionController
{

    public function indexAction()
    {
        $userTable = $this->getEm()->getRepository('Users\Entity\User');
        $viewModel = new ViewModel(array(
            'users' => $userTable->findAll()
        ));
        return $viewModel;
    }

    public function editAction()
    {
        $userTable = $this->getEm()->getRepository('Users\Entity\User');
        
        $user = $userTable->find($this->params()
            ->fromRoute('id'));
        $form = $this->getServiceLocator()->get('UserEditForm');
        $form->bind($user);
        $viewModel = new ViewModel(array(
            'form' => $form,
            'user_id' => $this->params()->fromRoute('id')
        ));
        return $viewModel;
    }
    public function deleteAction()
    {
        $user=$this->getEm()->find('Users\Entity\User', $this->params()->fromRoute('id'));
        $this->getEm()->remove($user);
        $this->getEm()->flush();
        return $this->redirect()
        ->toRoute('users/user-manager');
    
    }
    public function processAction(){
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('users/user-manager', array('action' => 'edit'));
        }
        $post=$this->request->getPost();
        $user=$this->getEm()->find('Users\Entity\User', $post->id);
        $form = $this->getServiceLocator()->get('UserEditForm');
        $filter=$this->getServiceLocator()->get('UserEditFilter');
        $form->setInputFilter($filter);
        $form->bind($user);
        $form->setData($post);
        if (!$form->isValid()) {
            $model = new ViewModel(array(
                'error' => true,
                'form'  => $form,
            ));
            $model->setTemplate('users/user-manager/edit');
            return $model;
        }
        $this->getEm()->persist($user);
        $this->getEm()->flush();
        return $this->redirect()->toRoute('users/user-manager');
        
    }

    public function getEm()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }
}