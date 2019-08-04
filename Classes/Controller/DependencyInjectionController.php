<?php
namespace DanielGoerz\DiExamples\Controller;


use DanielGoerz\DiExamples\Functionality\A;
use DanielGoerz\DiExamples\Functionality\B;
use DanielGoerz\DiExamples\Functionality\FunctionalityInterface;
use DanielGoerz\DiExamples\Service\EvenBetterService;
use DanielGoerz\DiExamples\Service\VeryGoodService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Fluid\View\StandaloneView;

class DependencyInjectionController
{

    /**
     * ModuleTemplate object
     *
     * @var ModuleTemplate
     */
    protected $moduleTemplate;

    /**
     * @var StandaloneView
     */
    protected $view;

    /**
     * @var VeryGoodService
     */
    protected $service;

    /**
     * @var FunctionalityInterface
     */
    protected $functionality;

    /**
     * @var FunctionalityInterface
     */
    protected $alternativeFunctionality;

    /**
     * @var EvenBetterService
     */
    protected $betterService;

    /**
     * @param StandaloneView $view
     * @param VeryGoodService $service
     * @param FunctionalityInterface $functionality
     * @param FunctionalityInterface $alternativeFunctionality
     */
    public function __construct(
        StandaloneView $view,
        VeryGoodService $service,
        FunctionalityInterface $functionality,
        FunctionalityInterface $alternativeFunctionality)
    {
        $this->view = $view;
        $this->service = $service;
        $this->functionality = $functionality;
        $this->alternativeFunctionality = $alternativeFunctionality;
        $this->initializeView('index');
    }

    /**
     * @param EvenBetterService $service
     * @required
     */
    public function setBetterService(EvenBetterService $service)
    {
        $this->betterService = $service;
    }

    /**
     * @param ModuleTemplate $moduleTemplate
     */
    public function injectModuleTemplate(ModuleTemplate $moduleTemplate)
    {
        $this->moduleTemplate = $moduleTemplate;
    }

    /**
     * @param string $templateName
     */
    protected function initializeView(string $templateName)
    {
        $this->view->setTemplate($templateName);
        $this->view->setTemplateRootPaths(['EXT:di_examples/Resources/Private/Templates/DependencyInjection']);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface the response with the content
     */
    public function indexAction(ServerRequestInterface $request): ResponseInterface
    {
        $messages = [];
        $messages[] = 'Service: ' . ($this->service instanceof VeryGoodService ? 'DI worked in constrcutor.' : 'DI did not work');
        $messages[] = 'Service Logger: ' . ($this->service->hasLogger() ? 'DI worked down the chain.' : 'DI did not work');
        $messages[] = 'Functionality: ' . ($this->functionality instanceof A ? 'DI worked through interface.' : 'DI did not work');
        $messages[] = 'Alternative Functionality: ' . ($this->alternativeFunctionality instanceof B ? 'DI worked through interface and argument name.' : 'DI did not work');
        $messages[] = 'Better Service: ' . ($this->betterService instanceof EvenBetterService ? 'DI worked through setBetterService().' : 'DI did not work');
        $messages[] = 'Module Template: ' . ($this->moduleTemplate instanceof ModuleTemplate ? 'DI worked through injectModuleTemplate().' : 'DI did not work');
        $this->view->assign('messages', $messages);
        $this->moduleTemplate->setContent($this->view->render());
        return new HtmlResponse($this->moduleTemplate->renderContent());
    }
}
