<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\ResourceModel;

class Answer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Abstract Resource Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bluethink_answer', 'answer_id');
    }
}
