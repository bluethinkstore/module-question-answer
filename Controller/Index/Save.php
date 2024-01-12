<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Bluethinkinc\QuestionAnswer\Model\QuestionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
 
class Save extends Action
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
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param QuestionFactory $questionFactory
     */
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        QuestionFactory $questionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->questionFactory = $questionFactory;
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
            if ($data['name']=='') {
                $this->messageManager->addErrorMessage(__("Please Enter you Name."));
            } elseif ($data['email']=='') {
                $this->messageManager->addErrorMessage(__("Please Enter you Email."));
            } elseif ($data['question']=='') {
                 $this->messageManager->addErrorMessage(__("Please Enter you question."));
            } else {
                if ($data) {
                    $model = $this->questionFactory->create();
                    $model->setData($data)->save();
                    $this->messageManager->addSuccessMessage(__("Your Question Saved Successfully."));
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererUrl();
        return $resultRedirect;
    }
}
