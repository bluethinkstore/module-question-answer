<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Bluethinkinc\QuestionAnswer\Model\AnswerFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
 
class AnswerSave extends Action
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var AnswerFactory
     */
    protected $questionFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param AnswerFactory $answerFactory
     */
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        AnswerFactory $answerFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->answerFactory = $answerFactory;
        parent::__construct($context);
    }

    /**
     * Execute method.
     *
     * @return ResultFactory
     */
    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            if ($data) {
                $model = $this->answerFactory->create();
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Your Answer Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererUrl();
        return $resultRedirect;
    }
}
