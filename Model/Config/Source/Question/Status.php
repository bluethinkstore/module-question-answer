<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\Config\Source\Question;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    /**
     * Set Array to Option
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            0 => [
                'label' => 'Approved',
                'value' => '0'
            ],
            1 => [
                'label' => 'Not-Approved',
                'value' => '1'
            ],
            2 => [
                'label' => 'Pending',
                'value' => '2'
            ],

        ];

        return $options;
    }
}
