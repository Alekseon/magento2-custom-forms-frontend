<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

use Alekseon\CustomFormsFrontend\Model\FrontendBlocksRepository;
use Alekseon\CustomFormsFrontend\Model\Template\Filter;

/**
 * Class TemplateFilterPlugin
 * @package Alekseon\CustomFormsFrontend\Plugin
 */
class TemplateFilterPlugin
{
    /**
     * @var FrontendBlocksRepository
     */
    private $frontendBlocksRepository;

    /**
     * TemplateFilterPlugin constructor.
     * @param FrontendBlocksRepository $frontendBlocksRepository
     */
    public function __construct(
        FrontendBlocksRepository $frontendBlocksRepository
    )
    {
        $this->frontendBlocksRepository = $frontendBlocksRepository;
    }

    /**
     * @param Filter $templateFilter
     * @return FrontendBlocksRepository
     */
    public function afterGetFrontendBlockRepository(Filter $templateFilter)
    {
        return $this->frontendBlocksRepository;
    }
}
