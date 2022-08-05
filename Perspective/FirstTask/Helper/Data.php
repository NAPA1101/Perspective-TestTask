<?php

namespace Perspective\FirstTask\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    /**
     * @var WriterInterface
     */
    protected $configWriter;

    const XML_PATH_FIRST = 'multiselect_section/';
    const XML_PATH_CRON = 'cron_section/';

    /**
     * @param Context $context
     * @param WriterInterface $configWriter
     */
    public function __construct(
        Context $context,
        WriterInterface $configWriter)
    {
        parent::__construct($context);
        $this->configWriter = $configWriter;
    }

    /**
     * @param $field
     * @param $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param $code
     * @param $storeId
     * @return mixed
     */
    public function getGeneralConfig($code, $storeId = null)
    {

        return $this->getConfigValue(self::XML_PATH_FIRST .'general/'. $code, $storeId);
    }

    /**
     * @param $code
     * @param $storeId
     * @return mixed
     */
    public function getCronConfig($code, $storeId = null)
    {

        return $this->getConfigValue(self::XML_PATH_CRON .'general_cron/'. $code, $storeId);
    }

    /**
     * @param $value
     * @return void
     */
    public function setCronConfig($value)
    {
        return $this->configWriter->save(self::XML_PATH_CRON .'general_cron/enable_cron', $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
    }

}
