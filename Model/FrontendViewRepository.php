<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model;

use Alekseon\CustomFormsBuilder\Model\Form;
use Magento\Framework\Exception\NoSuchEntityException;

class FrontendViewRepository
{
    /**
     * @var array
     */
    private $loadedFrontendViewsByIds = [];
    /**
     * @var FrontendViewFactory
     */
    private $frontendViewFactory;

    /**
     * FrontendViewRepository constructor.
     * @param \Alekseon\CustomFormsFrontend\Model\FrontendViewFactory $formFactory
     */
    public function __construct(
        \Alekseon\CustomFormsFrontend\Model\FrontendViewFactory $frontendViewFactory
    ) {
        $this->frontendViewFactory = $frontendViewFactory;
    }

    /**
     * @param $formId
     * @return Form
     * @throws NoSuchEntityException
     */
    public function getById($formId, $storeId = null, $graceful = false)
    {
        $storeKey = $storeId ?? 'null';
        if (!isset($this->loadedFrontendViewsByIds[$formId][$storeKey])) {
            $frontendView = $this->frontendViewFactory->create();
            $frontendView->setStoreId($storeId);
            $frontendView->getResource()->load($frontendView, $formId);
            if (!$frontendView->getId()) {
                if ($graceful) {
                    return $frontendView;
                } else {
                    throw new NoSuchEntityException(__('Form with id "%1" does not exist.', $formId));
                }
            }
            $this->loadedFrontendViewsByIds[$formId][$storeKey] =$frontendView;
        }

        return $this->loadedFrontendViewsByIds[$formId][$storeKey];
    }
}
