<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\FrontendView;

use Alekseon\AlekseonEav\Block\Adminhtml\Entity\Grid as EavGrid;
use Alekseon\CustomFormsBuilder\Model\Form;

class Grid extends EavGrid
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
    /**
     * @var \Alekseon\CustomFormsFrontend\Model\FrontendViewFactory
     */
    protected $frontendViewFactory;

    /**
     * Grid constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Framework\Registry $coreRegistry,
        \Alekseon\CustomFormsFrontend\Model\FrontendViewFactory $frontendViewFactory,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->frontendViewFactory = $frontendViewFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setUseAjax(true);
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->frontendViewFactory->create()->getCollection();
        $collection->addFieldToFilter('form_id', $this->getCurrentForm()->getId());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return Form
     */
    private function getCurrentForm()
    {
        return $this->coreRegistry->registry('current_form');
    }

    /**
     * @return $this|Grid
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addAttributeColumns();
        return $this;
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit',
            [
                'id' => $row->getEntityId(),
                'form_id' => $row->getFormId(),
            ]
        );
    }
}
