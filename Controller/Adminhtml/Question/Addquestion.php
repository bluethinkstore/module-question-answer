<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Controller\Adminhtml\Question;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Bluethinkinc\QuestionAnswer\Model\QuestionFactory;
use Magento\Backend\App\Action;

class Addquestion extends Action
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
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $coreRegistry
     * @param QuestionFactory $questionFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        $this->questionFactory = $questionFactory;
    }

    /**
     * Execute method.
     *
     * @return Page|ResponseInterface|ResultInterface|FrameworkPage|void
     */
    public function execute()
    {
        $questionId = (int) $this->getRequest()->getParam('question_id');
        $questionData = $this->questionFactory->create();

        if ($questionId) {
            $questionData = $questionData->load($questionId);
            $faqTitle = $questionData->getTitle();
            if (!$questionData->getQuestionId()) {
                $this->messageManager->addError(__('Question no longer exist.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('adminquestionanswer/question/index');
            }
        }

        $this->coreRegistry->register('question_data', $questionData);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("New Questions"));
        $title = $questionId ? __('Edit Question ') . $faqTitle : __('Add New Question');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
