<?php

namespace LaravelCreative\JqueryAction;


use Illuminate\Support\Facades\Blade;
use LaravelCreative\JqueryAction\Helpers\JqueryHelper;

trait JqueryActionBladesTrait
{


    /**
     * Register Directives
     */
    public function registerDirective()
    {
        $this->registerIntScripts();
    }

    /**
     * Register init scripts
     */
    public function registerIntScripts()
    {
        /** Init Scripts */
        Blade::directive('jqueryScripts', function () {
            return "<?php JqueryAction::initScripts() ?>";
        });
    }


}
