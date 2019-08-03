<?php
defined('TYPO3_MODE') or die('Access denied!');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
    'site',
    'di',
    '',
    '',
    [
        'routeTarget' => \DanielGoerz\DiExamples\Controller\DependencyInjectionController::class . '::indexAction',
        'access' => 'group,user',
        'name' => 'site_di',
        'icon' => 'EXT:di_examples/Resources/Public/Icons/Extension.svg',
        'labels' => 'LLL:EXT:di_examples/Resources/Private/Language/locallang_module.xlf'
    ]
);
