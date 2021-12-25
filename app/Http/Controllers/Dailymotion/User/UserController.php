<?php


namespace App\Http\Controllers\Dailymotion\User;

use App\Http\Controllers\Controller;
use App\Rules\IsValidPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Dailymotion\domain\User\Entity\UserEntity;
use Dailymotion\domain\User\Service\Exception\UserServiceNotFoundException;
use Dailymotion\domain\User\Service\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Dailymotion\infrastructure\Mail\Mailtrap;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(
        UserServiceInterface $userService
    ){
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->json()->all(),
            [
                'email' => ['required', 'email'],
                'password' => [
                    'required',
                    'string',
                    new IsValidPassword(),
                ]
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => "0000",
                    'StatusDescription' => $validator->errors()
                ]
            );
        }

        $isRegistered = $this
            ->userService
            ->isRegistered(
                $request
                    ->json()
                    ->get('email')
            );


        if ($isRegistered) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => 0,
                    'StatusDescription' => 'User Already exist'
                ]
            );
        }

        try {

            $code = rand(000000, 999999);
            $userEntity = $this->userService->create(
                new UserEntity(
                    null,
                    $request->json()->get('email'),
                    Hash::make($request->json()->get('password')),
                    $code,
                    false
                )
            );

            Mail::to($request->json()->get('email'))->send(
                new Mailtrap(['code' => $code])
            );


        } catch (UserServiceNotFoundException $exception) {
            return response()->json(
                [
                    'status' => 'Error',
                    'StatusCode' => $exception->getCode(),
                    'StatusDescription' => json_decode(
                        $exception->getMessage(),
                        false
                    )
                ]
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'user' => $userEntity->toArray()
                ]
            ]
        );
    }

    /**
     * @param string $email
     * @param int $code
     * @return JsonResponse
     */
    public function confirmation(string $email, int $code)
    {

        try {
            return response()->json(
                [
                    'status' => 'success',
                    'data' => [
                        'user' => $this
                            ->userService
                            ->confirmationCode(
                               urldecode($email),
                                $code
                            )
                            ->toArray()
                    ]
                ]

            );
        } catch (UserServiceNotFoundException $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'StatusCode' => 0,
                    'StatusDescription' => json_decode(
                        $e->getMessage(),
                        true
                    )
                ]
            );
        }
    }
}
