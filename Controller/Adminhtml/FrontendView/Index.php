<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Index extends \Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView
    implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * @return void
     */
    public function execute()
    {
        try {
            $form = $this->initForm();
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $this->returnResult('*/form');
        }

        $this->_initAction();

        if ($this->getRequest()->getParam('isAjax')) {
            $this->getResponse()->setBody(
                $this->_view->getLayout()->getBlock('grid')->toHtml()
            );
        } else {
            $this->_view->getPage()->getConfig()->getTitle()->prepend($form->getTitle());
            $this->_view->renderLayout();
        }
    }
}
