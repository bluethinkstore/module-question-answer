<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
 
class AnswerUserType extends Column
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
                if ($items['type'] == 0) {
                    $items['type'] = 'Admin';
                } elseif ($items['type'] == 1) {
                    $items['type'] = 'Guest';
                } else {
                    $items['type'] = 'User';
                }
                $dataSource["data"]["items"][$key][$fieldName] = $items['type'];
            }
        }
        return $dataSource;
    }
}
