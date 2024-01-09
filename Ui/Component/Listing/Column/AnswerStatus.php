<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class AnswerStatus extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            $fieldName = $this->getData("name");
            foreach ($dataSource["data"]["items"] as $key => $items) {
                if ($items['status'] == 0) {
                    $items['status'] = 'Approved';
                } elseif ($items['status'] == 1) {
                    $items['status'] = 'Not-Approved';
                } else {
                    $items['status'] = 'Pending';
                }
                $dataSource["data"]["items"][$key][$fieldName] = $items['status'];
            }
        }
        return $dataSource;
    }
}
