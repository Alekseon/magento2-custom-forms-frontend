<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView;

use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Delete
 * @package Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView
 */
class Delete extends \Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView implements HttpPostActionInterface
{
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $frontendView = $this->initFrontendView();
        if ($frontendView->getId()) {
            try {
                $frontendView->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the Frontend View.'));
                return $this->returnResult('*/*/', ['form_id' => $frontendView->getFormId()]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $this->returnResult('*/*/', ['form_id' => $frontendView->getFormId()]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find an Frontend View to delete.'));
        return $this->returnResult('*/*/');
    }
}
