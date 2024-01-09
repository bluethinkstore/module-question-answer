<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Adminhtml\Answer;

use Magento\Backend\App\Action\Context;
use Bluethinkinc\QuestionAnswer\Model\AnswerFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    /**
     * @var AnswerFactory
     */
    protected $answerFactory;

    /**
     * @var RedirectFactory
     */
    private $resultRedirect;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param AnswerFactory $answerFactory
     */
    public function __construct(
        Context $context,
        AnswerFactory $answerFactory
    ) {
        parent::__construct($context);
        $this->answerFactory = $answerFactory;
    }

    /**
     * Execute method.
     *
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $postData = $this->getRequest()->getParams();
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$postData) {
            return $resultRedirect->setPath('*/*/');
        }
        $model = $this->answerFactory->create();
        if ($id = (int)$this->getRequest()->getParam('answer_id')) {
            $model = $model->load($id);
            if ($id != $model->getId()) {
                $this->messageManager->addErrorMessage(__("Answer doesn't exists."));
                return $resultRedirect->setPath('*/*/index');
            }
        }
        $data = $model->setData($postData);
        $model->save();
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('adminquestionanswer/answer/addanswer', [
                'answer_id' => $model->getAnswerId(), '_current' => true]);
        }
        $this->messageManager->addSuccess(__('Answer successfully saved.'));
        return $resultRedirect->setPath('*/*/index');
    }
}
