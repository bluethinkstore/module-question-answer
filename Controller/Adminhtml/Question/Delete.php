<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Bluethinkinc\QuestionAnswer\Model\QuestionFactory;

class Delete extends Action
{
    /**
     * @var QuestionFactory
     */
    public $questionFactory;
    
    /**
     * @param Context $context
     * @param QuestionFactory $questionFactory
     */

    public function __construct(
        Context $context,
        QuestionFactory $questionFactory
    ) {
        $this->questionFactory = $questionFactory;
        parent::__construct($context);
    }
    
    /**
     * Execute method.
     *
     * @return resultRedirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $question_id = $this->getRequest()->getParam('question_id');
        try {
            $questionModel = $this->questionFactory->create();
            $questionModel->load($question_id);
            $questionModel->delete();
            $this->messageManager->addSuccessMessage(__('Record deleted Successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
