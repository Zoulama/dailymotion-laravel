<?php


namespace Dailymotion\domain\User\Entity;


interface UserEntityInterface
{

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @param $document
     * @return UserEntityInterface
     */
    public static function fromStdClass($document): UserEntityInterface;

    /**
     * @param array $userData
     * @return UserEntity
     */
    public static function fromArray(array $userData): UserEntityInterface;

    /**
     * @return string|null
     */
    public function getUserId(): ?string;

    /**
     * @param string $userId
     * @return UserEntityInterface
     */
    public function setUserId(string $userId): UserEntityInterface;

    /**
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * @return string
     */
    public function getCode(): ?string;

    /**
     * @return string
     */
    public function getPassword(): ?string;

    /**
     * @return mixed
     */
    public function getVerifiedEmail(): bool;

}
