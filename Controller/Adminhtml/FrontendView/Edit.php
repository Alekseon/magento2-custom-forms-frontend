<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Edit extends \Alekseon\CustomFormsFrontend\Controller\Adminhtml\FrontendView
    implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_initAction();
        $entity = $this->initFrontendView();

        if ($entity->getId()) {
            $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Edit Frontend View'). ' ' . $entity->getTitle());
        } else {
            $this->_view->getPage()->getConfig()->getTitle()->prepend(__('New Frontend View'));
        }

        $this->_view->renderLayout();
    }
}
