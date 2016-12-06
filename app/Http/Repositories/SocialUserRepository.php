<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 1/2/2015
 * Time: 12:19 AM
 */

namespace App\Repositories;

use Laravel\Passport\Bridge\User;
use RuntimeException;
use Illuminate\Contracts\Hashing\Hasher;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

class SocialUserRepository implements UserRepositoryInterface
{
	/**
	 * The hasher implementation.
	 *
	 * @var \Illuminate\Contracts\Hashing\Hasher
	 */
	protected $hasher;

	/**
	 * Create a new repository instance.
	 *
	 * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
	 * @return void
	 */
	public function __construct(Hasher $hasher)
	{
		$this->hasher = $hasher;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
	{
		if (is_null($model = config('auth.providers.users.model'))) {
			throw new RuntimeException('Unable to determine user model from configuration.');
		}

		if (method_exists($model, 'findForPassport')) {
			$user = (new $model)->findForPassport($username);
		} else {
			$user = (new $model)->where('email', $username)->first();
		}

		if (! $user || $user->provider == "internal") {
			if(! $this->hasher->check($password, $user->password))
			{
				return;
			}
		}

		return new User($user->getAuthIdentifier());
	}
}