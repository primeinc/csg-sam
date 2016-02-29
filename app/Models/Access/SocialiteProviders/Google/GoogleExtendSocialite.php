<?php

namespace App\Models\Access\SocialiteProviders\Google;

use SocialiteProviders\Manager\SocialiteWasCalled;

class GoogleExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'google', __NAMESPACE__.'\Provider'
        );
    }
}
