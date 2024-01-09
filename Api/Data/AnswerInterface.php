<?php
/**
 * Copyright © BluethinkInc All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bluethinkinc\QuestionAnswer\Api\Data;

interface AnswerInterface
{
    /**
     * Constants for keys of data array.
     */
    public const ANSWER_ID = 'answer_id';
    public const QUESTION_ID = 'question_id';
    public const STATUS = 'status';
    public const TYPE = 'type';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const ANONYMOUS = 'anonymous';
    public const ANSWER = 'answer';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * GetAnswerId method.
     *
     * @return mixed
     */
    public function getAnswerId();

    /**
     * SetAnswerId method.
     *
     * @param int $answerId
     * @return mixed
     */
    public function setAnswerId($answerId);

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
     * GetAnonymous method.
     *
     * @return string
     */
    public function getAnonymous();

    /**
     * SetAnonymous method.
     *
     * @param string $anonymous
     * @return void
     */
    public function setAnonymous($anonymous);

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
