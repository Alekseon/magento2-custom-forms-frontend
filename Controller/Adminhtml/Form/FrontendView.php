<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\Form;

use Magento\Framework\App\Action\HttpGetActionInterface;

class FrontendView extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    private $resultLayoutFactory;

    /**
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
    )
    {
        $this->resultLayoutFactory = $resultLayoutFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultLayoutFactory->create();
    }
}
