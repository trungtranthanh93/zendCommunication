<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Entity\Uploads;
use Users\Entity\User;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        /*
         * $view = new ViewModel();
         * return $view;
         */
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');     
        $upload = new Uploads();
        $upload->setFilename("abc");
        $upload->setUserId(15);
        $objectManager->persist($upload);
        $objectManager->flush();
    }
}
