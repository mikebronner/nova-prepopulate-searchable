<?php

namespace GeneaLabs\NovaPrepopulateSearchable;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Nova;

class ToolServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        Nova::serving(function (ServingNova $event) {
            BelongsTo::macro('prepopulate', function ($value = true, $query = null) {
                $this->meta['prepopulate'] = $value;
                $this->meta['prepopulate_query'] = $query;

                return $this;
            });

            BelongsTo::macro('previewLink', function ($value = true) {
                $this->meta['previewLink'] = $value;

                return $this;
            });

            Nova::script(
                'nova-prepopulate-searchable',
                __DIR__ . '/../dist/js/tool.js'
            );
        });
    }
}
