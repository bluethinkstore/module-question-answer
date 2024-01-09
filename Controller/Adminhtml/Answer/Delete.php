<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Adminhtml\Answer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Bluethinkinc\QuestionAnswer\Model\AnswerFactory;

class Delete extends Action
{
    /**
     * @var AnswerFactory
     */
    public $answerFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param AnswerFactory $answerFactory
     */
    
    public function __construct(
        Context $context,
        AnswerFactory $answerFactory
    ) {
        $this->answerFactory = $answerFactory;
        parent::__construct($context);
    }

    /**
     * Answer Delete page action
     *
     * @return resultRedirect
     */

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $answer_id = $this->getRequest()->getParam('answer_id');
        try {
            $answerModel = $this->answerFactory->create();
            $answerModel->load($answer_id);
            $answerModel->delete();
            $this->messageManager->addSuccessMessage(__('Record deleted Successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
