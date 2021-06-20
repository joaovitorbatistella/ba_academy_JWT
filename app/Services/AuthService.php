<?php

namespace App\Services;

use App\Models\User;
use App\Exceptions\UserHasBeenTakenException;
use App\Exceptions\LoginInvalidEsception;
use Illuminate\Support\Str;

/**
 * Class used to handle situations
 */
class AuthService
{

  /**
   * Handle registration
   * @param $first_name
   * @param $last_name
   * @param $email
   * @param $password
   * @return App\Models\User
   * @throws App\Exceptions\UserHasBeenTakenException
   */
  public function register(
    string $first_name,
    string $last_name,
    string $email,
    string $password
    )
  {
    $user = User::where('email', $email)->exists();

    if(!empty($user))
    {
      throw new UserHasBeenTakenException();
    }

    $user_password = bcrypt($password ?? Str::random(10));

    $user = User::create([
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'password' => $user_password,
      'confirmation_token' => Str::random(60),
    ]);

    return $user;
  }

  /**
   * Handle login
   * @param $email
   * @param $password
   * @return array
   * @throws App\Exceptions\LoginInvalidEsception
   */
  public function login(
    string $email,
    string $password
    )
  {
    $login = [
      'email'    => $email,
      'password' => $password,
    ];

    if(!$token = auth()->attempt($login))
    {
      throw new LoginInvalidEsception;
    }

    return [
      'access_token' => $token,
      'token_type'   => 'Bearer',
      'expire_in'    => auth()->factory()->getTTL(),
    ];
  }

  /**
   * Refresh auth_token
   * @return array
   */
  public function refresh()
  {
    $token = auth()->refresh();
    return [
      'access_token' => $token,
      'token_type'   => 'Bearer',
      'expire_in'    => auth()->factory()->getTTL(),
    ];
  }
}