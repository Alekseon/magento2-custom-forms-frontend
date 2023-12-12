<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block;

use Alekseon\CustomFormsBuilder\Model\FormRepository;
use Magento\Framework\View\Element\Template;

class FormEntitiesView extends \Magento\Framework\View\Element\Template
    implements \Magento\Widget\Block\BlockInterface, \Magento\Framework\DataObject\IdentityInterface
{
    protected $_template = 'Alekseon_CustomFormsFrontend::form_entities_view/default.phtml';
    /**
     * @var
     */
    protected $form;
    /**
     * @var FormRepository
     */
    protected $formRepository;

    public function __construct(
        Template\Context $context,
        FormRepository $formRepository,
        array $data = []
    ) {
        $this->formRepository = $formRepository;
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
     * @return \Alekseon\CustomFormsBuilder\Model\ResourceModel\FormRecord\Collection|array
     */
    public function getFormEntities()
    {
        return $this->getForm() ? $this->getForm()->getRecordCollection() : [];
    }

    /**
     * @return array|string[]
     */
    public function getIdentities(): array
    {
        return []; // @todo;
    }
}
