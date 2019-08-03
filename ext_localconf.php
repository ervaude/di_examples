<?php

defined('TYPO3_MODE') or die('Access denied!');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'di_examples',
    'very_good_plugin',
    [\DanielGoerz\DiExamples\Controller\DefaultController::class => 'index'],
    [\DanielGoerz\DiExamples\Controller\DefaultController::class => 'index']
);
