<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml\Form\FrontendView;

use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
class Grid extends \Alekseon\CustomFormsBuilder\Controller\Adminhtml\Form implements HttpPostActionInterface
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->initForm('form_id');
        $this->getResponse()->setBody(
            $this->_view->getLayout()->createBlock(
                \Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews::class,
                'grid'
            )->toHtml()
        );
    }
}
