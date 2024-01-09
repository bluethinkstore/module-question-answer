<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\ResourceModel\Question;

use Bluethinkinc\QuestionAnswer\Model\Question as Model;
use Bluethinkinc\QuestionAnswer\Model\ResourceModel\Question as ResourceModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'question_id';

    /**
     * Collection _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
