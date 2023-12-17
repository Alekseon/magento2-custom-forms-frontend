<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block;

use Alekseon\CustomFormsBuilder\Model\FormRecord;
use Alekseon\CustomFormsBuilder\Model\FormRepository;
use Alekseon\CustomFormsFrontend\Model\Form\FrontendViewFactory;
use Magento\Framework\View\Element\Template;

class FormEntitiesView extends \Magento\Framework\View\Element\Template
    implements \Magento\Widget\Block\BlockInterface, \Magento\Framework\DataObject\IdentityInterface
{
    protected $_template = 'Alekseon_CustomFormsFrontend::form_entities_view/default.phtml';
    /**
     * @var
     */
    protected $frontendView;
    /**
     * @var FormRepository
     */
    protected $frontendViewFactory;
    /**
     * @var \Alekseon\CustomFormsFrontend\Model\Template\Filter
     */
    private $templateFilter;

    public function __construct(
        Template\Context $context,
        FrontendViewFactory $frontendViewFactory,
        \Alekseon\CustomFormsFrontend\Model\Template\Filter $templateFilter,
        array $data = []
    ) {
        $this->frontendViewFactory = $frontendViewFactory;
        $this->templateFilter = $templateFilter;
        parent::__construct($context, $data);
    }

    public function getFrontendView()
    {
        if ($this->frontendView == null) {
            $viewId = (int)$this->getData('frontend_view_id');
            $this->frontendView = $this->frontendViewFactory->create();
            $this->frontendView->load($viewId);
        }
        return $this->frontendView;
    }

    /**
     * @return \Alekseon\CustomFormsBuilder\Model\Form
     */
    public function getForm()
    {
        return $this->getFrontendView()->getForm();
    }

    /**
     * @param FormRecord $row
     * @return string
     */
    public function getRowContent(FormRecord $row)
    {
        $this->templateFilter->setFormRecord($row);
        return $this->templateFilter->filter($this->getFrontendView()->getRowContent());
    }

    /**
     * @return \Alekseon\CustomFormsBuilder\Model\ResourceModel\FormRecord\Collection|array
     */
    public function getFormEntities()
    {
        if ($this->getForm()) {
            return $this->getForm()->getRecordCollection()->addAttributeToSelect("*");
        }
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getIdentities(): array
    {
        return []; // @todo;
    }
}
