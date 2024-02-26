<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView;

use Alekseon\CustomFormsBuilder\Model\Form;
use Alekseon\CustomFormsBuilder\Model\FormTab;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Save
 * @package Alekseon\CustomFormsBuilder\Controller\Adminhtml\Form
 */
class Save extends \Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView implements HttpPostActionInterface
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $returnToEdit = false;
        if ($this->getRequest()->getParam('back', false)) {
            $returnToEdit = true;
        }

        $frontendView = false;
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $frontendView = $this->initFrontendView();
            $frontendView->addData($data);

            try {
                $frontendView->save();
                $this->messageManager->addSuccessMessage(__('You saved the Frontend View.'));
            } catch (\Exception $e) {
                $this->dataPersistor->set('current_frontend_view_data', $data);
                $this->messageManager->addErrorMessage($e->getMessage());
                $returnToEdit = true;
            }
        }

        if ($returnToEdit && $frontendView) {
            return $this->returnResult('*/*/edit', [
                '_current' => true,
                'id' => $frontendView->getId(),
                'form_id' => $frontendView->getFormId()
            ]);
        } else {
            return $this->returnResult('*/*/');
        }
    }
}
