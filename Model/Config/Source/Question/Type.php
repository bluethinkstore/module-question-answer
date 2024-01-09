<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\Config\Source\Question;

use Magento\Framework\Option\ArrayInterface;

class Type implements ArrayInterface
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
                'label' => 'Admin',
                'value' => '0'
            ],
            1 => [
                'label' => 'Guest',
                'value' => '1'
            ],
            2 => [
                'label' => 'User',
                'value' => '2'
            ],
        ];

        return $options;
    }
}
