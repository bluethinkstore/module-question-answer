<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Bluethinkinc\QuestionAnswer\Model\QuestionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
 
class AnswerProductName extends Column
{
    /**
     * @var QuestionFactory
     */
    protected $questionFactory;
    
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepositoryInterface;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param QuestionFactory $questionFactory
     * @param ProductRepositoryInterface $productRepositoryInterface
     * @param array $components
     * @param array $data
     */
 
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        QuestionFactory $questionFactory,
        ProductRepositoryInterface $productRepositoryInterface,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->questionFactory = $questionFactory;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

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
                $questionId = $items['question_id'];
                $questionModel = $this->questionFactory->create()->getCollection();
                $question = $questionModel->getItemById($questionId);
                $skus = explode(',', $question->getSku());
                $productName=[];
                foreach ($skus as $sku) {
                    $product = $this->productRepositoryInterface->get($sku, false);
                    $productName[] = $product->getName();
                }
                $implodeProductData = implode(',', $productName);
                $dataSource["data"]["items"][$key][$fieldName] = $implodeProductData;
            }
        }
        return $dataSource;
    }
}
