<?php

namespace Perspective\FirstTask\Block;

use Magento\Framework\View\Element\Template\Context;
use Perspective\FirstTask\Helper\Data;
use Magento\Framework\Registry;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\App\Http\Context as HttpContext;

class Index extends \Magento\Framework\View\Element\Template
{
    /** @var Data  */
    protected $_helperData;

    /** @var Registry  */
    protected $_registry;

    /** @var CollectionFactory  */
    protected $_productCollectionFactory;

    /** @var CategoryFactory  */
    protected $_categoryFactory;

    /** @var DateTime  */
    protected $_date;

    /**
     * @var HttpContext
     */
    protected $_httpContext;

    /**
     * @param Context $context
     * @param Data $helperData
     * @param Registry $registry
     * @param CollectionFactory $productCollectionFactory
     * @param CategoryFactory $categoryFactory
     * @param DateTime $date
     * @param HttpContext $httpContext
     * @param array $data
     */

    public function __construct(
        Context $context,
        Data $helperData,
        Registry $registry,
        CollectionFactory $productCollectionFactory,
        CategoryFactory $categoryFactory,
        DateTime $date,
        HttpContext $httpContext,
        array $data = [])

    {
        parent::__construct($context, $data);

        $this->_helperData = $helperData;
        $this->_registry = $registry;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_categoryFactory = $categoryFactory;
        $this->_date = $date;
        $this->_httpContext = $httpContext;
    }

    /**
     * @return object
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    /**
     * @return bool
     */
    public function getEnableModule()
    {
        return $this->_helperData->getGeneralConfig('enable');
    }

    /**
     * @return int
     */
    public function getCategoryID()
    {
        return $this->_helperData->getGeneralConfig('multiselect_field');
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        $category = $this->_categoryFactory->create()->load($this->getCategoryID());
        return $category->getName();
    }

    /**
     * @return object
     */
    public function getProductCollectionByCategories()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $this->getCategoryID()]);
        return $collection;
    }

    /**
     * @return false|string
     */
    public function getCurrentDate()
    {
        return $currentDate = $this->_date->gmtDate('Y-m-d');
    }

    /**
     * @return mixed
     */
    public function getDaysBefore()
    {
        return $daysBefore = $this->_helperData->getGeneralConfig('days');
    }

    /**
     * @return mixed
     */
    public function getDiscountDate()
    {
        return $discountDate = $this->_helperData->getGeneralConfig('date');
    }

    /**
     * @return false|string
     */
    public function getDiscount()
    {
        $discount = date_create($this->getDiscountDate());
        $discount = date_modify($discount, '-' . $this->getDaysBefore() . ' days');
        $discount = date_format($discount, 'Y-m-d');
        return $discount;
    }

    /**
     * @return mixed
     */
    public function getCron()
    {
        return $this->_helperData->getCronConfig('enable_cron');
    }

    /**
     * @return bool
     */
    public function getSaleEnabled()
    {
        return $this->_helperData->getCronConfig('enable_discount');
    }

    /**
     * @return mixed|null
     */
    public function getCustomGroup()
    {
        return $this->_httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP);
    }
}
