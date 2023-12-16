<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews;

use Alekseon\CustomFormsBuilder\Model\Form;

/**
 * Class Grid
 * @package Alekseon\CustomFormsBuilder\Block\Adminhtml\Form
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\CollectionFactory
     */
    private $_collectionFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magento\Framework\Registry $coreRegistry,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('frontend_views_grid');
        $this->setUseAjax(true);
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create();
        $collection->addFieldToFilter('form_id', $this->getCurrentForm()->getId());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'frontend_views_grid_title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );

        $this->addColumn(
            'frontend_views_grid_actions',
            [
                'header' => __('Actions'),
                'sortable' => false,
                'filter' => false,
                'renderer' => \Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews\Grid\Renderer\Actions::class,
                'header_css_class' => 'col-actions',
                'column_css_class' => 'col-actions'
            ]
        );

        return parent::_prepareColumns();;
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getRowUrl($row)
    {
        return false;
    }

    /**
     * @return Form
     */
    public function getCurrentForm()
    {
        return $this->coreRegistry->registry('current_form');
    }

    public function getGridUrl()
    {
        return $this->getUrl('alekseon_customFormsFrontend/form_frontendView/grid', ['form_id' => $this->getCurrentForm()->getId()]);
    }
}
