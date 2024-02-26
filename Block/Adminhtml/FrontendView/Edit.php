<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\FrontendView;

/**
 * Class Edit
 * @package Alekseon\CustomFormsBuilder\Block\Adminhtml\Form
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Alekseon_CustomFormsFrontend';
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_frontendView';

        parent::_construct();

        $this->addButton(
            'save_and_continue',
            [
                'label' => __('Save and Continue'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ]
            ]
        );
    }

    /**
     * Retrieve URL for save
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl(
            '*/*/save',
            ['_current' => true]
        );
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index', ['form_id' => $this->getRequest()->getParam('form_id')]);
    }
}
