<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\Config\Source\Question;

class QuestionListModel implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $options = [
            0 => ['label' => __('1'),'value' => '1'],
            1 => ['label' => __('2'),'value' => '2'],
            2 => ['label' => __('3'),'value' => '3'],
            3 => ['label' => __('5'),'value' => '5'],
            4 => ['label' => __('10'),'value' => '10'],
        ];
        return $options;
    }
}
