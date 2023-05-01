<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Field;

/**
 * Class Image
 * @package Alekseon\CustomFormsFrontend\Block\Field
 */
class Image extends \Magento\Backend\Block\Template
{
    /**
     * @var string
     */
    protected $_template = 'Alekseon_CustomFormsFrontend::field/image.phtml';
    /**
     * @var \Alekseon\AlekseonEav\Helper\Image
     */
    protected $imageHelper;

    /**
     * Image constructor.
     * @param Template\Context $context
     * @param \Alekseon\AlekseonEav\Helper\Image $imageHelper
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Alekseon\AlekseonEav\Helper\Image $imageHelper
    ) {
        $this->imageHelper = $imageHelper;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function getImageThumbnailUrl()
    {
        $this->imageHelper->init($this->getFormRecord(), $this->getRecordAttribute()->getAttributeCode());
        $parameters = $this->getParameters();

        if (isset($parameters['width']) || isset($parameters['height'])) {
            if (isset($parameters['width'])) {
                $width = (int)$parameters['width'];
                $this->imageHelper->setWidth($width);
            }
            if (isset($parameters['height'])) {
                $height = (int)$parameters['height'];
                $this->imageHelper->setHeight($height);
            }
        } else {
            $this->imageHelper->setHeight(200);
            $this->imageHelper->setWidth(200);
        }

        return $this->imageHelper->getUrl();
    }
}

