<?php

namespace Perspective\FirstTask\Plugin;

use \Perspective\FirstTask\Block\Index;

Class NamePlugin {

    /**
     * @var Index
     */
    protected $blockFirstTask;

    /**
     * @param Index $blockFirstTask
     */
    public function __construct(
        Index $blockFirstTask)
    {
        $this->blockFirstTask = $blockFirstTask;
    }

    /**
     * @param \Magento\Theme\Block\Html\Title $pageTitle
     * @param $name
     * @return mixed|string
     */
    public function afterGetPageHeading(\Magento\Theme\Block\Html\Title $pageTitle, $name)
    {
        if (!is_null($this->blockFirstTask->getCurrentProduct()))
            if ($this->blockFirstTask->getEnableModule()) {
                $categoryProducts = $this->blockFirstTask->getProductCollectionByCategories();
                foreach ($categoryProducts as $product) {
                    if ($this->blockFirstTask->getCurrentProduct()->getID() == $product->getID()) {
                        $name .= " " . $this->blockFirstTask->getCategoryName() . "_" . $product->getID() . "_" . $product->getSku();
                    }
                }
                return $name;
            }
            else {
                return $name;
            }
        else {
            return $name;
        }
    }
}
