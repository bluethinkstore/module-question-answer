<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Adminhtml\Answer;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Bluethinkinc\QuestionAnswer\Model\AnswerFactory;
use Magento\Backend\App\Action;

class Addanswer extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @var AnswerFactory
     */
    private $answerFactory;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry
     * @param AnswerFactory $answerFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        AnswerFactory $answerFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        $this->answerFactory = $answerFactory;
    }

    /**
     * Execute method.
     *
     * @return Page|ResponseInterface|ResultInterface|FrameworkPage|void
     */
    public function execute()
    {
        $answerId = (int) $this->getRequest()->getParam('answer_id');
        $answerData = $this->answerFactory->create();
        if ($answerId) {
            $answerData = $answerData->load($answerId);
            $answerTitle = $answerData->getTitle();
            if (!$answerData->getanswerId()) {
                $this->messageManager->addError(__('answer no longer exist.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('adminquestionanswer/answer/index');
            }
        }
        $this->coreRegistry->register('answer_data', $answerData);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("New Answer"));
        $title = $answerId ? __('Edit Answer ') . $answerTitle : __('Add Answer');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
