<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Bluethinkinc\QuestionAnswer\Model\ResourceModel\Question\CollectionFactory;
use Bluethinkinc\QuestionAnswer\Model\QuestionFactory;

class MassApproved extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Bluethinkinc_QuestionAnswer::question_id';

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param QuestionFactory $questionFactory
     * @param Context $context
     */
    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        QuestionFactory $questionFactory,
        Context $context
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->questionFactory = $questionFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collections = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collections->getSize();
        foreach ($collections as $collection) {
            $result = $this->questionFactory->create()->load($collection->getQuestionId());
            $status=0;
            $result->setStatus($status);
            $result->save();
        }
        $this->messageManager->addSuccessMessage(__(
            'A total of %1 record(s) have been Approved.',
            $collectionSize
        ));
        /* @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
