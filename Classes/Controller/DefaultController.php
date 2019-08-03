<?php
namespace DanielGoerz\DiExamples\Controller;


use DanielGoerz\DiExamples\Functionality\A;
use DanielGoerz\DiExamples\Functionality\B;
use DanielGoerz\DiExamples\Functionality\FunctionalityInterface;
use DanielGoerz\DiExamples\Service\VeryGoodService;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class DefaultController extends ActionController
{

    /**
     * @Inject
     * @var \DanielGoerz\DiExamples\Functionality\A
     */
    protected $protectedFunctionality;

    /**
     * @Inject
     * @var \DanielGoerz\DiExamples\Functionality\B
     */
    public $publicFunctionality;

    /**
     * @var FunctionalityInterface
     */
    protected $protectedFunctionalityInterface;

    /**
     * @param FunctionalityInterface $functionality
     */
    public function injectFunctionalityInterface(FunctionalityInterface $functionality)
    {
        $this->protectedFunctionalityInterface = $functionality;
    }

    /**
     * @var VeryGoodService
     */
    protected $service;

    /**
     * @var FrontendUserRepository
     */
    protected $frontendUserRepository;

    /**
     * @param VeryGoodService $service
     * @param FrontendUserRepository $frontendUserRepository
     */
    public function __construct(VeryGoodService $service, FrontendUserRepository $frontendUserRepository)
    {
        $this->service = $service;
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $messages = [];
        $messages[] = 'Service: ' . ($this->service instanceof VeryGoodService ? 'DI worked.' : 'DI did not work');
        $messages[] = 'Service Logger: ' . ($this->service->hasLogger() ? 'DI worked.' : 'DI did not work');
        $messages[] = 'FrontendUserRepository: ' . ($this->frontendUserRepository instanceof FrontendUserRepository ? 'DI worked.' : 'DI did not work');
        $messages[] = 'Protected Functionality (Property Injection): ' . ($this->protectedFunctionality instanceof A ? 'DI worked.' : 'DI did not work');
        $messages[] = 'Public Functionality (Property Injection): ' . ($this->publicFunctionality instanceof B ? 'DI worked.' : 'DI did not work');
        $messages[] = 'Protected Functionality (inject() method Injection): ' . ($this->protectedFunctionalityInterface instanceof A ? 'DI worked.' : 'DI did not work');
        $this->view->assign('messages', $messages);
    }
}
