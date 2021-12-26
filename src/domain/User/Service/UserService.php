<?php


namespace Dailymotion\domain\User\Service;


use Dailymotion\domain\User\Entity\UserEntity;
use Dailymotion\domain\User\Entity\UserEntityInterface;
use Dailymotion\domain\User\Repository\Exception\UserRepositoryNotFoundException;
use Dailymotion\domain\User\Repository\UserRepositoryInterface;
use Dailymotion\domain\User\Service\Exception\UserServiceNotFoundException;
use Exception;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(UserEntityInterface $userEntity) : UserEntityInterface
    {
        try {
            return $this->userRepository->create($userEntity);
        } catch (UserRepositoryNotFoundException $exception) {
            throw new UserServiceNotFoundException(
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $userId
     * @return UserEntity
     */
    public function fetch(string $userId): UserEntityInterface
    {
        try {
            return $this->userRepository->fetch($userId);
        } catch (UserRepositoryNotFoundException $exception) {
            throw new UserServiceNotFoundException(
                $exception->getMessage()
            );
        }
    }

    /**
     * @param string $email
     * @return bool
     * @throws Exception
     */
    public function isRegistered(string $email): bool
    {
        try {
            return $this
                ->userRepository
                ->isRegistered(
                    $email
                );
        } catch (UserRepositoryNotFoundException $e) {
            throw new UserServiceNotFoundException(
                $e->getMessage()
            );
        } catch (Exception $e) {
            throw new Exception(
                $e->getMessage()
            );
        }
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function confirmationCode(string $email, int $code): UserEntityInterface
    {

        try {
            return $this
                ->userRepository
                ->confirmationCode(
                    $email,
                    $code
                );
        } catch (UserRepositoryNotFoundException $e) {
            throw new UserServiceNotFoundException(
                $e->getMessage()
            );
        }
    }

}
