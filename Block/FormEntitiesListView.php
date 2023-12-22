<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block;
use Alekseon\CustomFormsBuilder\Model\FormRecord;
use Alekseon\CustomFormsBuilder\Model\FormRepository;

class FormEntitiesListView extends \Magento\Framework\View\Element\Template
    implements \Magento\Widget\Block\BlockInterface, \Magento\Framework\DataObject\IdentityInterface
{
    protected $_template = 'Alekseon_CustomFormsFrontend::formEntitiesListView.phtml';

    /**
     * @var FormRepository
     */
    private $formRepository;

    /**
     * @var \Alekseon\CustomFormsFrontend\Model\Template\Filter
     */
    private $templateFilter;
    /**
     * @var
     */
    private $form;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param FormRepository $formRepository
     * @param \Alekseon\CustomFormsFrontend\Model\Template\Filter $templateFilter
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        FormRepository $formRepository,
        \Alekseon\CustomFormsFrontend\Model\Template\Filter $templateFilter,
        array $data = []
    ) {
        $this->formRepository = $formRepository;
        $this->templateFilter = $templateFilter;
        parent::__construct($context, $data);
    }

    /**
     * @return \Alekseon\CustomFormsBuilder\Model\Form
     */
    public function getForm()
    {
        if ($this->form === null) {
            $identifier = $this->getData('form_identifier');
            if ($identifier) {
                try {
                    $this->form = $this->formRepository->getByIdentifier($identifier, null, true);
                } catch (\Exception $e) {}
            } else {
                $formId = (int)$this->getData('form_id');
                if ($formId) {
                    try {
                        $this->form = $this->formRepository->getById($formId, null, true);
                    } catch (\Exception $e) {}
                }
            }
        }

        return $this->form;
    }

    /**
     * @param FormRecord $row
     * @return string
     */
    public function getRowContent(FormRecord $row)
    {
        $this->templateFilter->setFormRecord($row);
        return $this->templateFilter->filter($this->getForm()->getFrontendViewListRowContent());
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
