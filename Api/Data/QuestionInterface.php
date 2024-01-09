<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Api\Data;

interface QuestionInterface
{
    public const QUESTION_ID = 'question_id';
    public const QUESTION = 'question';
    public const STATUS = 'status';
    public const TYPE = 'type';
    public const SKU = 'sku';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const STOREVIEW = 'storeview';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * GetQuestionId method.
     *
     * @return mixed
     */
    public function getQuestionId();

    /**
     * SetQuestionId method.
     *
     * @param int $questionId
     * @return mixed
     */
    public function setQuestionId($questionId);

    /**
     * GetQuestion method.
     *
     * @return mixed
     */
    public function getQuestion();

    /**
     * SetQuestion method.
     *
     * @param string $question
     * @return void
     */
    public function setQuestion($question);

    /**
     * GetStatus method.
     *
     * @return int
     */
    public function getStatus();

    /**
     * SetStatus method.
     *
     * @param int $status
     * @return void
     */
    public function setStatus($status);

    /**
     * GetType method.
     *
     * @return int
     */
    public function getType();

    /**
     * SetType.
     *
     * @param int $type
     * @return void
     */
    public function setType($type);

    /**
     * GetSku method.
     *
     * @return string
     */
    public function getSku();

    /**
     * SetSku method.
     *
     * @param string $sku
     * @return void
     */
    public function setSku($sku);

    /**
     * GetName method.
     *
     * @return string
     */
    public function getName();

    /**
     * SetName method.
     *
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * GetEmail method.
     *
     * @return string
     */
    public function getEmail();

    /**
     * SetEmail method.
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email);

    /**
     * GetStoreview method.
     *
     * @return string
     */
    public function getStoreview();

    /**
     * SetStoreview method.
     *
     * @param string $storeview
     * @return void
     */
    public function setStoreview($storeview);

    /**
     * GetCreatedAt method.
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * SetCreatedAt method.
     *
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt($createdAt);

    /**
     * GetUpdatedAt method.
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * SetUpdatedAt method.
     *
     * @param string $updatedAt
     * @return void
     */
    public function setUpdatedAt($updatedAt);
}
