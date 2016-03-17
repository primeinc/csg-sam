<?php

namespace App\Providers;

use App\Services\Macros\Macros;
use Collective\Html\HtmlServiceProvider;
use Form;

/**
 * Class MacroServiceProvider.
 */
class MacroServiceProvider extends HtmlServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsTextArea', 'components.form.textArea', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('dateRange', 'components.form.dateRange', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('select2', 'components.form.select2', ['name', 'label' => null, 'list' => [], 'selected' => null, 'attributes' => []]);
        Form::component('currencyText', 'components.form.currencyText', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsFile', 'components.form.file', ['name', 'label' => null, 'attributes' => []]);
        Form::component('bsCheckbox', 'components.form.checkbox', ['name', 'label' => null, 'value' => null, 'checked' => null, 'attributes' => []]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->singleton('form', function ($app) {
            $form = new Macros($app['html'], $app['url'], $app['view'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }
}
