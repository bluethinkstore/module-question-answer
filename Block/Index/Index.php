<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Block\Index;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Bluethinkinc\QuestionAnswer\Helper\Data;
use Magento\Framework\View\Element\Template\Context;
use Bluethinkinc\QuestionAnswer\Model\ResourceModel\Answer\CollectionFactory as AnswerCollectionFactory;
use Bluethinkinc\QuestionAnswer\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Index extends Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var \Bluethinkinc\QuestionAnswer\Helper\Data
     */
    protected $helperData;

    /**
     * @var AnswerCollectionFactory
     */
    protected $answerCollectionFactory = null;

    /**
     * @var QuestionCollectionFactory
     */
    protected $questionCollectionFactory = null;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var customerSession
     */
    protected $_customerSession;

    /**
     * @param StoreManagerInterface $storeManager
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param AnswerCollectionFactory $answerCollectionFactory
     * @param customerSession $_customerSession
     * @param Registry $registry
     * @param Data $helperData
     * @param Context $context
     * @param array $data
     */

    public function __construct(
        StoreManagerInterface $storeManager,
        QuestionCollectionFactory $questionCollectionFactory,
        AnswerCollectionFactory $answerCollectionFactory,
        \Magento\Customer\Model\SessionFactory  $_customerSession,
        Registry $registry,
        Data $helperData,
        Context $context,
        array $data = []
    ) {
        $this->storeManager  = $storeManager;
        $this->questionCollectionFactory  = $questionCollectionFactory;
        $this->answerCollectionFactory  = $answerCollectionFactory;
        $this->_customerSession = $_customerSession;
        $this->registry  = $registry;
        $this->helperData = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * ModuleQuestionAnswerEnable Method Check Module Enable
     *
     * @return int
     */
    public function moduleQuestionAnswerEnable()
    {
        return $this->helperData->isModuleEnable();
    }

    /**
     * ModuleQuestionConfigure Method
     *
     * @return int
     */
    public function moduleQuestionConfigure()
    {
        return $this->helperData->questionConfigure();
    }

    /**
     * ModuleAnswerConfigure Method
     *
     * @return int
     */
    public function moduleAnswerConfigure()
    {
        return $this->helperData->answerConfigure();
    }

    /**
     * IsLoggedInCustomer Method Check Module Enable
     *
     * @return int
     */
    public function isLoggedInCustomer()
    {
        return $this->helperData->checkIsLoggedInCustomer();
    }

    /**
     * GetProductSkuByCollection Method
     *
     * @return Sku
     */
    public function getProductSkuByCollection()
    {
        $currentProduct = $this->registry->registry('current_product');
        return $currentProduct->getSku();
    }

    /**
     * IsLoggedInCustomerStatus Method
     *
     * @return int
     */
    public function isLoggedInCustomerStatus()
    {
        return (int)true;
    }

    /**
     * GetSkuQuestionCollection Method
     */
    public function getSkuQuestionCollection()
    {
        $currentProductSku = $this->getProductSkuByCollection();
        $questionCollection = $this->questionCollectionFactory
        ->create()
        ->addFieldToSelect('*')
        ->addFieldToFilter('status', ['in' => '0'])
        ->addFieldToFilter('sku', ['like' => '%'.$currentProductSku.'%'])
        /*->setPageSize($this->checkQuestionAvilablity())*/;
        return $questionCollection;
    }

    /**
     * CheckQuestionAvilablity Method
     */
    public function checkQuestionAvilablity()
    {
        $currentProductSku = $this->getProductSkuByCollection();
        $dataFromQuestionConfigure = $this->moduleQuestionConfigure();
        $questionCollection = $this->questionCollectionFactory
        ->create()->addFieldToFilter('sku', ['like' => '%'.$currentProductSku.'%'])
        ->addFieldToSelect('question_id');
        $countOfQuestionCollection = count($questionCollection);
        if ($dataFromQuestionConfigure>$countOfQuestionCollection) {
            return $countOfQuestionCollection;
        } else {
            return $dataFromQuestionConfigure;
        }
    }

    /**
     * GetAnswerCollection method.
     *
     * @param AnswerCollectionFactory $id
     */
    public function getAnswerCollection($id)
    {
        $answerCollection = $this->answerCollectionFactory->create()->addFieldToSelect('*')
        ->addFieldToFilter('status', ['in' => '0'])
        ->addFieldToFilter('question_id', ['in' => $id]);
        return $answerCollection;
    }

    /**
     * GetAnswerCollection method.
     *
     * @param AnswerCollectionFactory $id
     */
    public function getAnswerByAnswerId($id)
    {
        $answerCollection = $this->answerCollectionFactory->create()->addFieldToSelect('*')
        ->addFieldToFilter('status', ['in' => '0'])
        ->addFieldToFilter('answer_id', ['in' => $id])->getData();
        return $answerCollection;
    }

    /**
     * GetAnswerCollection method.
     *
     * @param AnswerCollectionFactory $id
     */

    /**
     * GetQuestionIds Method
     */
    public function getQuestionIds()
    {
        $questionDataCollection = $this->getSkuQuestionCollection();
        foreach ($questionDataCollection as $questionCollection) {
            $questionCollectionIds[] = $questionCollection->getQuestionId();
        }
        return $questionCollectionIds;
    }

    /**
     * JoinTablesQuestionAnswer Method
     */
    public function joinTablesQuestionAnswer()
    {
        $collection = $this->answerCollectionFactory->create();
        $select = $collection->getSelect()->joinLeft(
            ["bluethink_question" => $collection->getTable("bluethink_question")],
            'main_table.question_id = bluethink_question.question_id'
        )->group('question');
        return $collection;
    }

    /**
     * GetFormAction Method
     */
    public function getFormAction()
    {
        return $this->getUrl('questionanswer/index/save', ['_secure' => true]);
    }

    /**
     * GetAnswerFormAction Method
     */
    public function getAnswerFormAction()
    {
        return $this->getUrl('questionanswer/index/answersave', ['_secure' => true]);
    }

    /**
     * Get Store Id Method
     */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }
    /**
     * Get Current Customer
     */
    public function getCustomer()
    {
     
        $customer = $this->_customerSession->create();
        $data=['name'=>$customer->getCustomer()->getFirstname(),'email'=>$customer->getCustomer()->getEmail()];
        return $data;
    }
    /**
     * Get Section Title
     */
    public function getSectionTitle()
    {
        $data=$this->helperData->getTitleConfigure();
        return $data;
    }
}
