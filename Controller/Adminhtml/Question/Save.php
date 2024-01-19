<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Adminhtml\Question;

use Magento\Backend\App\Action\Context;
use Bluethinkinc\QuestionAnswer\Model\QuestionFactory;
use Magento\Backend\App\Action;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * @var RedirectFactory
     */
    private $resultRedirect;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param QuestionFactory $questionFactory
     * @param Product $product
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        QuestionFactory $questionFactory,
        Product $product,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
        $this->questionFactory = $questionFactory;
        $this->product = $product;
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * Execute method.
     *
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        try {
            $invalidSku=[];
            $validSku=[];
            $postData = $this->getRequest()->getParams();
            $postStoreViewData = implode(',', $postData['storeview']);
            $resultRedirect = $this->resultRedirectFactory->create();
            $skuList = $postData['sku'];
            $explodeSkuList = explode(',', $skuList);
            if (!$postData) {
                return $resultRedirect->setPath('*/*/');
            }
            foreach ($explodeSkuList as $sku) {
                $productId = $this->productExistBySku($sku);
                if (!empty($productId)) {
                    $validSku[] = $sku;
                         $model = $this->questionFactory->create();
                    if ($id = (int)$this->getRequest()->getParam('question_id')) {
                        $model = $model->load($id);
                        if ($id != $model->getId()) {
                            $this->messageManager->addErrorMessage(__("Question doesn't exists."));
                            return $resultRedirect->setPath('*/*/index');
                        }
                    }
                } else {
                    $invalidSku[]=$sku;
                }
            }

            if ($invalidSku) {
                $uniqueSku = array_unique($invalidSku);
                $this->messageManager->addErrorMessage(__("SKU ". implode(",", $uniqueSku)." Doesn't Exists"));
                $this->dataPersistor->set('question_dataprovider', $postData);
                return $resultRedirect->setPath('*/*/addquestion');
            }
  
            if ($postData) {
                $allSkus = $this->getRequest()->getParam('sku');
                $allSkusExplode = explode(',', $allSkus);
                $uniqueSku = array_unique($allSkusExplode);
                $implodeSku = implode(',', $uniqueSku);
                $postData['sku'] = $implodeSku;
                $postData['storeview'] = $postStoreViewData;
                $data = $model->setData($postData);
                $model->save();
                $this->dataPersistor->clear('question_dataprovider');
            }
            $this->messageManager->addSuccessMessage(__("Record Saved Successfully"));
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('adminquestionanswer/question/addquestion', [
                    'question_id' => $model->getQuestionId(), '_current' => true]);
            }
            return $resultRedirect->setPath('*/*/index');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('question_dataprovider', $postData);
            return $resultRedirect->setPath('*/*/addquestion');
        }
    }

    /**
     * ProductExistBySku method.
     *
     * @param Poduct $sku
     * @return $sku
     */
    public function productExistBySku($sku)
    {
        if ($this->product->getIdBySku($sku)) {
            return $this->product->getIdBySku($sku);
        }
    }
}
