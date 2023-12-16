<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\Form;
use Alekseon\CustomFormsFrontend\Model\Form\FrontendViewFactory;

abstract class FrontendView extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;
    /**
     * @var FrontendViewFactory
     */
    private $frontendViewFactory;
    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        FrontendViewFactory $frontendViewFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->frontendViewFactory = $frontendViewFactory;
        $this->resultLayoutFactory = $resultLayoutFactory;
        parent::__construct($context);
    }

    protected function initFrontendView($formIdParam = 'form_id', $frontendViewIdParam = 'view_id')
    {
        $frontendView = $this->frontendViewFactory->create();
        $frontendView->load((int)$this->getRequest()->getParam($frontendViewIdParam));

        if (!$frontendView->getId()) {
            $frontendView->setFormId((int)$this->getRequest()->getParam($formIdParam));
        }

        $this->coreRegistry->register('current_frontend_view', $frontendView);

        return $frontendView;
    }
}
