<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Model\Question;

use Bluethinkinc\QuestionAnswer\Model\ResourceModel\Question\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var loadedData
     */
    protected $_loadedData;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get Data.
     *
     * @return mixed
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $itemData) {
            $data = $itemData->getData();
            $this->_loadedData[$itemData->getQuestionId()] = $data;
        }
        return $this->_loadedData;
    }
}
