<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Http\Context as HttpContext;

class Data extends AbstractHelper
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var HttpContext
     */
    protected $httpContext;

    /**
     * @param Context $context
     * @param HttpContext $httpContext
     */

    public function __construct(
        Context $context,
        HttpContext $httpContext
    ) {
        $this->context = $context;
        $this->httpContext = $httpContext;
        parent::__construct($context);
    }

    /**
     * IsModuleEnable Method returning config value
     *
     * @return string
     */
    public function isModuleEnable()
    {
        return $this->scopeConfig->getValue('questionAnswer/general/enable', ScopeInterface::SCOPE_STORE);
    }

    /**
     * QuestionConfigure Method returning config value
     *
     * @return string
     */
    public function questionConfigure()
    {
        return $this->scopeConfig->getValue('questionAnswer/questions/question', ScopeInterface::SCOPE_STORE);
    }

    /**
     * AnswerConfigure Method returning config value
     *
     * @return string
     */
    public function answerConfigure()
    {
        return $this->scopeConfig->getValue('questionAnswer/answers/answer', ScopeInterface::SCOPE_STORE);
    }

    /**
     * CheckIsLoggedInCustomer Method
     */
    public function checkIsLoggedInCustomer()
    {
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        if (!$isLoggedIn) {
            return 0;
        } else {
            return 1;
        }
    }
    /**
     * AnswerConfigure Method returning config value
     *
     * @return string
     */
    public function getTitleConfigure()
    {
        return $this->scopeConfig->getValue(
            'questionAnswer/section_title/section_title_subject',
            ScopeInterface::SCOPE_STORE
        );
    }
}
