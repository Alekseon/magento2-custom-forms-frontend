<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\Form\FrontendView;

use Alekseon\CustomFormsFrontend\Controller\Adminhtml\Form\FrontendView;
use Alekseon\CustomFormsFrontend\Model\Form\FrontendViewFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Save extends FrontendView implements HttpPostActionInterface
{
    /**
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue('frontend_view');
        if ($data) {
            $frontendView = $this->initFrontendView();
            $frontendView->addData($data);

            try {
                $frontendView->save();
            } catch (\Exception $e) {
            }
        }
    }
}
