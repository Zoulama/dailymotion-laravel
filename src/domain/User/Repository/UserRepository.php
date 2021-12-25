<?php


namespace Dailymotion\domain\User\Repository;


use Exception;
use Illuminate\Support\Arr;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;
use Dailymotion\domain\User\Entity\UserEntity;
use Dailymotion\domain\User\Entity\UserEntityInterface;
use Dailymotion\domain\User\Repository\Exception\UserRepositoryNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var Collection
     */
    private Collection $userCollection;

    /**
     * ProjectRepository constructor.
     * @param Collection $userCollection
     */
    public function __construct(
        Collection $userCollection
    )
    {
        $this->userCollection = $userCollection;
    }


    /**
     * @inheritDoc
     */
    public function create(UserEntityInterface $userEntity) : UserEntityInterface
    {
        try {
            $insertOneResult = $this
                ->userCollection
                ->insertOne(
                    [
                        'email' => urldecode($userEntity->getEmail()),
                        'password' => $userEntity->getPassword(),
                        'code' => $userEntity->getCode(),
                        'verifiedEmail' => $userEntity->getVerifiedEmail(),
                    ]
                );

            return $userEntity->setUserId(
                $insertOneResult->getInsertedId()
            );
        } catch (Exception $exception) {
            throw new UserRepositoryNotFoundException (
                $exception->getMessage()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $userId): UserEntityInterface
    {
        try {
            $document = $this
                ->userCollection
                ->findOne(
                    [
                        '_id' => new ObjectId($userId),
                    ]
                );
        } catch (Exception $e) {
            throw new UserRepositoryNotFoundException(
                $e->getMessage()
            );
        }

        return UserEntity::fromStdClass(
            $document
        );
    }

    /**
     * @inheritDoc
     */
    public function isRegistered(string $email): bool
    {
        try {
            $document = $this
                ->userCollection
                ->findOne(
                    [
                        'email' => $email,
                    ]
                );
        } catch (Exception $e) {
            throw new UserRepositoryNotFoundException(
                $e->getMessage()
            );
        }

        return !is_null($document);
    }

    /**
     * @inheritDoc
     */
    public function confirmationCode(string $email, int $code): UserEntityInterface
    {

        try {
            $document = $this
                ->userCollection
                ->findOne(
                    [
                        'email' => $email,
                    ]
                );

            $userEntity = UserEntity::fromStdClass(
                $document
            );

            if (intval($userEntity->getCode()) === $code) {

                $updateResult = $this
                    ->userCollection
                    ->updateOne(
                        ['_id' => new ObjectId($userEntity->getUserId())],
                        ['$set' => [
                            'code' => 0,
                            'verifiedEmail' => true
                        ]]
                    );

                if ($updateResult->getMatchedCount()) {
                    return $this->fetch(
                        $userEntity->getUserId()
                    );
                }
            }

            throw new UserRepositoryNotFoundException(
                "Email déjà verifié"
            );

        } catch (Exception $e) {
            throw new UserRepositoryNotFoundException(
                $e->getMessage()
            );
        }


    }


}
