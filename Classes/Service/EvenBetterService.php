<?php
namespace DanielGoerz\DiExamples\Service;


use DanielGoerz\DiExamples\Functionality\FunctionalityInterface;

class EvenBetterService
{
    /**
     * @var VeryGoodService
     */
    protected $veryGoodService;

    /**
     * @var FunctionalityInterface
     */
    protected $functionality;

    /**
     * EvenBetterService constructor.
     *
     * @param VeryGoodService $veryGoodService
     * @param FunctionalityInterface $functionality
     */
    public function __construct(VeryGoodService $veryGoodService, FunctionalityInterface $functionality)
    {
        $this->veryGoodService = $veryGoodService;
        $this->functionality = $functionality;
    }
}
