<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\Config\Source\Answer;

use Magento\Framework\Option\ArrayInterface;
use Bluethinkinc\QuestionAnswer\Model\QuestionFactory;

class Question implements ArrayInterface
{
    /**
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * @param QuestionFactory $questionFactory
     */

    public function __construct(QuestionFactory $questionFactory)
    {
        $this->questionFactory = $questionFactory;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $options=[];
        $questionModel = $this->questionFactory->create()->getCollection();
        if ($questionModel->getSize()) {
            foreach ($questionModel as $question) {
                $options[] = [
                    'label' => $question->getData('question'),
                    'value' => $question->getData('question_id')
                ];
            }
        }
        return $options;
    }
}
