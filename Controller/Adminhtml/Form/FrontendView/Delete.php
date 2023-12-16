<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\Form\FrontendView;

use Alekseon\CustomFormsFrontend\Controller\Adminhtml\Form\FrontendView;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Delete extends FrontendView implements HttpGetActionInterface
{
    public function execute()
    {
        $frontendView = $this->initFrontendView();
        $frontendView->delete();
    }
}
