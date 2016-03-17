<?php

namespace App\Services\Access\Traits;

use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use Laravel\Socialite\Facades\Socialite;
use App\Events\Frontend\Auth\UserLoggedIn;
use Log;

/**
 * Class UseSocialite.
 */
trait UseSocialite
{
    /**
     * @param Request $request
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|mixed
     * @throws GeneralException
     */
    public function loginThirdParty(Request $request, $provider)
    {
        //If the provider is not an acceptable third party than kick back
        if (! in_array($provider, $this->getAcceptedProviders())) {
            return redirect()->route('frontend.index')->withFlashDanger(trans('auth.socialite.unacceptable', ['provider' => $provider]));
        }

        /*
         * The first time this is hit, request is empty
         * It's redirected to the provider and then back here, where request is populated
         * So it then continues creating the user
         */
        if (! $request->all()) {
            return $this->getAuthorizationFirst($provider);
        }

        $socialUser = $this->getSocialUser($provider);

        $accessConfig = config('socialite-login.limit-access', []);
        foreach ($accessConfig as $property => $regex) {
            $value = object_get($socialUser, $property);
            if (is_string($value) and preg_match($regex, $value)) {
                continue;
            }
            Log::alert('Invalid login for company domain - Attempted: '.$value);

            return redirect()->route('frontend.index')->withFlashDanger(trans('exceptions.frontend.auth.invalid-domain', ['provider' => $provider]));
        }

        /*
         * Create the user if this is a new social account or find the one that is already there
         */
        $user = $this->user->findOrCreateSocial($socialUser, $provider);

        /*
         * User has been successfully created or already exists
         * Log the user in
         */
        auth()->login($user, true);

        /*
         * User authenticated, check to see if they are active.
         */
        if (! access()->user()->isActive()) {
            auth()->logout();

            Log::alert('Login attempted for deactivated account: '.$value);

            return redirect()->route('frontend.index')->withFlashDanger(trans('exceptions.frontend.auth.deactivated'));
//            throw new GeneralException(trans('exceptions.frontend.auth.deactivated'));
        }

        /*
         * Throw an event in case you want to do anything when the user logs in
         */
        event(new UserLoggedIn($user));

        /*
         * Set session variable so we know which provider user is logged in as, if ever needed
         */
        session([config('access.socialite_session_name') => $provider]);

        /*
         * Return to the intended url or default to the class property
         */
        return redirect()->intended($this->redirectPath());
    }

    /**
     * @param  $provider
     * @return mixed
     */
    public function getAuthorizationFirst($provider)
    {
        /*
         * Both scopes and with are set
         */
        if (count(config("services.{$provider}.scopes")) && count(config("services.{$provider}.with"))) {
            return Socialite::driver($provider)
                ->scopes(config("services.{$provider}.scopes"))
                ->with(config("services.{$provider}.with"))
                ->redirect();
        }

        /*
         * Just scopes are set
         */
        if (count(config("services.{$provider}.scopes")) && ! count(config("services.{$provider}.with"))) {
            return Socialite::driver($provider)
                ->scopes(config("services.{$provider}.scopes"))
                ->redirect();
        }

        /*
         * Just with is set
         */
        if (! count(config("services.{$provider}.scopes")) && count(config("services.{$provider}.with"))) {
            return Socialite::driver($provider)
                ->with(config("services.{$provider}.with"))
                ->redirect();
        }

        /*
         * Neither scopes or with are set
         */
        return Socialite::driver($provider)
            ->redirect();
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function getSocialUser($provider)
    {
        return Socialite::driver($provider)->user();
    }

    /**
     * Generates social login links based on what is enabled.
     *
     * @return string
     */
    protected function getSocialLinks()
    {
        $socialite_enable = [];
        $socialite_links = '';

        if (strlen(getenv('BITBUCKET_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.provider', trans('labels.frontend.auth.login_with', ['social_media' => 'Bit Bucket']), 'bitbucket');
        }

        if (strlen(getenv('FACEBOOK_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.provider', trans('labels.frontend.auth.login_with', ['social_media' => 'Facebook']), 'facebook');
        }

        if (strlen(getenv('GOOGLE_CLIENT_ID'))) {
            //            $socialite_enable[] = link_to_route('auth.provider', trans('labels.frontend.auth.login_with', ['social_media' => 'Google']), 'google');
            $socialite_enable[] = '<a href="'.route('auth.provider', 'google').'"><img src="/btn_google.png" /></a>';
        }

        if (strlen(getenv('GITHUB_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.provider', trans('labels.frontend.auth.login_with', ['social_media' => 'Github']), 'github');
        }

        if (strlen(getenv('LINKEDIN_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.provider', trans('labels.frontend.auth.login_with', ['social_media' => 'Linked In']), 'linkedin');
        }

        if (strlen(getenv('TWITTER_CLIENT_ID'))) {
            $socialite_enable[] = link_to_route('auth.provider', trans('labels.frontend.auth.login_with', ['social_media' => 'Twitter']), 'twitter');
        }

        for ($i = 0; $i < count($socialite_enable); $i++) {
            $socialite_links .= ($socialite_links != '' ? '&nbsp;|&nbsp;' : '').$socialite_enable[$i];
        }

        return $socialite_links;
    }

    /**
     * List of the accepted third party provider types to login with.
     *
     * @return array
     */
    private function getAcceptedProviders()
    {
        return [
            'bitbucket',
            'facebook',
            'google',
            'github',
            'linkedin',
            'twitter',
        ];
    }
}
