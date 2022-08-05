<?php
namespace Perspective\FirstTask\Cron;

use Perspective\FirstTask\Helper\Data;
use Magento\Framework\App\ResourceConnection;

class Test {

    /**
     * @var Data
     */
    protected $_helper;

    /**
     * @var ResourceConnection
     */
    protected $_connect;

    /**
     * @param ResourceConnection $connect
     * @param Data $helperData
     */
    public function __construct(
        ResourceConnection $connect,
        Data $helperData
    ) {
        $this->_helper = $helperData;
        $this->_connect = $connect;
    }

    /**
     * @return void
     */

    public function execute() {
        $cron = ($this->_helper->getCronConfig('enable_cron')) ? 0 : 1;
        $this->_helper->setCronConfig($cron);
        $connection  = $this->_connect->getConnection();
        $tableName = $connection->getTableName("catalogrule");
        $data = ['is_active' => $cron, 'discount_amount' => $this->_helper->getCronConfig('discount_cron')];
        $where = ['rule_id = ?' => '2'];
        $connection->update($tableName, $data, $where);
    }
}
