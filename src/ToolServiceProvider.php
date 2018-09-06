<?php

namespace AlexBowers\NovaPrepopulateSearchable;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Fields\BelongsTo;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            BelongsTo::macro('prepopulate', function ($query = null) {
                $this->meta['prepopulate'] = true;
                $this->meta['prepopulate_query'] = $query;

                return $this;
            });

            Nova::script('nova-prepopulate-searchable', __DIR__ . '/../dist/js/tool.js');
        });
    }
}
