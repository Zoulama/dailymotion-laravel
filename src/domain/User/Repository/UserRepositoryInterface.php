<?php


namespace Dailymotion\domain\User\Repository;

use Dailymotion\domain\User\Entity\UserEntity;
use Dailymotion\domain\User\Entity\UserEntityInterface;

interface UserRepositoryInterface
{
    /**
     * @param UserEntityInterface $userEntity
     * @return UserEntity
     */
    public function create(UserEntityInterface $userEntity) : UserEntityInterface;

    /**
     * @param string $userId
     * @return UserEntity
     */
    public function fetch(string $userId): UserEntityInterface;

    /**
     * @param string $email
     * @return bool
     */
    public function isRegistered(string $email): bool;

    /**
     * @param string $email
     * @param int $code
     * @return UserEntityInterface
     */
    public function confirmationCode(string $email, int $code): UserEntityInterface;


}
