<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Controller\Adminhtml;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;

abstract class FrontendView extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
    /**
     * @var \Alekseon\CustomFormsBuilder\Model\FormRepository
     */
    protected $formRepository;
    /**
     * @var \Alekseon\CustomFormsFrontend\Model\FrontendViewRepository
     */
    protected $frontendViewRepository;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * FormRecord constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Alekseon\CustomFormsBuilder\Model\FormRepository $formRepository
     * @param \Alekseon\CustomFormsFrontend\Model\FrontendViewRepository $frontendViewRepository
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Alekseon\CustomFormsBuilder\Model\FormRepository $formRepository,
        \Alekseon\CustomFormsFrontend\Model\FrontendViewRepository $frontendViewRepository,
        DataPersistorInterface $dataPersistor
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->formRepository = $formRepository;
        $this->frontendViewRepository = $frontendViewRepository;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * @return $this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Alekseon_CustomFormsBuilder::custom_form'
        );
        return $this;
    }

    /**
     * @param string $requestParam
     * @return \Alekseon\CustomFormsBuilder\Model\Form
     */
    protected function initForm(string $requestParam = 'form_id')
    {
        $form = $this->coreRegistry->registry('current_form');
        if (!$form) {
            $formId = $this->getRequest()->getParam($requestParam, false);
            $storeId = $this->getRequest()->getParam('store');
            $form = $this->formRepository->getById($formId, $storeId);
            $this->coreRegistry->register('current_form', $form);
        }
        return $form;
    }

    /**
     * @param string $requestParam
     * @param int|null $storeId
     * @return mixed|null
     */
    protected function initFrontendView(string $requestParam = 'id', string $formRequestParam = 'form_id')
    {
        $frontendView = $this->coreRegistry->registry('current_frontend_view');
        if (!$frontendView) {
            $entityId = $this->getRequest()->getParam($requestParam, false);
            $storeId = $this->getRequest()->getParam('store');
            $frontendView = $this->frontendViewRepository->getById($entityId, $storeId, true);
            if (!$frontendView->getId()) {
                $form = $this->initForm($formRequestParam);
                $frontendView->setForm($form);
                $frontendView->setFormId($form->getId());
            }

            $data = $this->dataPersistor->get('current_frontend_view_data');
            if (!empty($data)) {
                $frontendView->addData($data);
                $this->dataPersistor->clear('current_frontend_view_data');
            }

            $this->coreRegistry->register('current_frontend_view', $frontendView);
        }
        return $frontendView;
    }

    /**
     * @param string $path
     * @param array $params
     * @return mixed
     */
    protected function returnResult($path = '', array $params = [])
    {
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath($path, $params);
    }
}
