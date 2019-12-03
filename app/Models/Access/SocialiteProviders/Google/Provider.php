<?php

namespace App\Models\Access\SocialiteProviders\Google;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'GOOGLE';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [
		'openid',
		'profile',
		'email',
	];

    /**
     * {@inheritdoc}
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://accounts.google.com/o/oauth2/auth', $state
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://accounts.google.com/o/oauth2/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        //fixing legacy google+ api
		$response = $this->getHttpClient()->get('https://www.googleapis.com/oauth2/v3/userinfo?', [
			'query' => [
				'prettyPrint' => 'false',
			],
			'headers' => [
				'Accept' => 'application/json',
				'Authorization' => 'Bearer '.$token,
			],
		]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
		//fixing legacy google+ api
        $user['id'] = array_get($user, 'sub');
		$user['verified_email'] = array_get($user, 'email_verified');
		$user['link'] = array_get($user, 'profile');

		$avatarUrl = array_get($user, 'image.url');
		return (new User)->setRaw($user)->map([
			'id' => array_get($user, 'sub'),
			'nickname' => array_get($user, 'nickname'),
			'name' => array_get($user, 'name'),
			'email' => array_get($user, 'email'),
			'avatar' => $avatarUrl = array_get($user, 'picture'),
			'avatar_original' => $avatarUrl,
		]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
