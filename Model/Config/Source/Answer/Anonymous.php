<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\Config\Source\Answer;

use Magento\Framework\Option\ArrayInterface;

class Anonymous implements ArrayInterface
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
                'label' => 'Yes',
                'value' => '1'
            ],
            1 => [
                'label' => 'No',
                'value' => '0'
            ],
        ];

        return $options;
    }
}
