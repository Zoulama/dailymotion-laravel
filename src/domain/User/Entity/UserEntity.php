<?php


namespace Dailymotion\domain\User\Entity;


class UserEntity implements UserEntityInterface
{

    /**
     * @var string
     */
    private ?string $userId;

    /**
     * @var string
     */
    private ?string $email;

    /**
     * @var string
     */
    private ?string $password;

    /**
     * @var string
     */
    private ?string $code;

    /**
     * @var bool
     */
    private bool $verifiedEmail;


    public function __construct(
        ?string $userId,
        ?string $email,
        ?string $password,
        ?string $code,
        ?string $verifiedEmail

    ){
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->code = $code;
        $this->verifiedEmail = $verifiedEmail;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
       return  [
            'userId' => $this->userId,
            'email' => $this->email,
            'password' => $this->password,
            'code' => $this->code,
            'verifiedEmail' => $this->verifiedEmail

        ];


    }

    /**
     * @inheritDoc
     */
    public static function fromStdClass($document): UserEntityInterface
    {
        return new static(
            $document->_id->__toString(),
            $document->email,
            $document->password,
            $document->code,
            $document->verifiedEmail
        );
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $userData): UserEntityInterface
    {
        return new static(
            $userData['userId'] ?? null,
            $userData['email'] ?? null,
            $userData['password'] ?? null,
            $userData['code'] ?? null,
            $userData['verifiedEmail'] ?? null,

        );
    }

    /**
     * @inheritDoc
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @inheritDoc
     */
    public function setUserId(string $userId): UserEntityInterface
    {
         $this->userId = $userId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function getVerifiedEmail(): bool
    {
        return $this->verifiedEmail;
    }
}
