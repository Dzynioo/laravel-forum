<?php

namespace TeamTeaTime\Forum;

use Carbon\Carbon;

use Illuminate\{
    Contracts\Auth\Access\Gate as GateContract,
    Foundation\AliasLoader,
    Routing\Router,
    Support\Facades\Auth,
    Support\Facades\Log,
    Support\Facades\View,
    Support\ServiceProvider,
    View\Compilers\BladeCompiler,
};

use TeamTeaTime\Forum\{
    Config\FrontendStack,
    Console\Commands\PresetInstall,
    Console\Commands\PresetList,
    Console\Commands\Seed,
    Console\Commands\SyncStats,
    Frontend\Presets\AbstractPreset,
    Frontend\Presets\BladeBootstrapPreset,
    Frontend\Presets\PresetRegistry,
    Frontend\Presets\LivewireTailwindPreset,
    Frontend\Presets\BladeTailwindPreset,
    Frontend\Stacks\Blade,
    Frontend\Stacks\StackInterface,
    Frontend\Stacks\Livewire,
    Http\Middleware\ResolveApiParameters,
};

class ForumServiceProvider extends ServiceProvider
{
    private const CONFIG_FILES = [
        'api',
        'frontend',
        'general',
        'integration',
    ];

    private ?StackInterface $frontendStack = null;
    private ?AbstractPreset $frontendPreset = null;

    public function __construct($app)
    {
        parent::__construct($app);

        foreach (self::CONFIG_FILES as $key) {
            $this->mergeConfigFrom(__DIR__ . "/../config/{$key}.php", "forum.{$key}");
        }

        if (!config('forum.frontend.enable')) {
            return;
        }

        $presetRegistry = new PresetRegistry;
        $presetRegistry->register(new LivewireTailwindPreset);
        $presetRegistry->register(new BladeBootstrapPreset);
        $presetRegistry->register(new BladeTailwindPreset);

        $app->instance(PresetRegistry::class, $presetRegistry);

        $this->frontendPreset = $presetRegistry->get(config('forum.frontend.preset'));

        switch ($this->frontendPreset->getRequiredStack()) {
            case FrontendStack::BLADE:
                $this->frontendStack = new Blade;
                break;
            case FrontendStack::LIVEWIRE:
                if (!class_exists(\Livewire\Livewire::class)) {
                    Log::error('The active forum preset requires Livewire, but Livewire is not installed. Please install it: composer require livewire/livewire');
                    break;
                }

                $this->frontendStack = new Livewire;
                break;
        }
    }

    public function register()
    {
        if ($this->frontendStack != null && $this->frontendStack != null) {
            $this->callAfterResolving(BladeCompiler::class, function () {
                $this->frontendStack->register();
                $this->frontendPreset->register();
            });
        }
    }

    public function boot(Router $router, GateContract $gate)
    {
        $this->publishConfig();
        $this->publishMigrations();
        $this->publishTranslations();

        if (config('forum.api.enable')) {
            $this->enableApi($router);
        }

        if ($this->frontendStack != null && $this->frontendStack != null) {
            $routerConfig = $this->frontendStack->getRouterConfig();
            $router->group($routerConfig, fn() => $this->loadRoutesFrom($this->frontendStack->getRoutesPath()));

            $viewsPath = $this->frontendPreset->getViewsPath();
            $this->loadViewsFrom($viewsPath, 'forum');

            View::composer('forum::layouts.main', function ($view) {
                if (Auth::check()) {
                    $nameAttribute = config('forum.integration.user_name');
                    $view->username = Auth::user()->{$nameAttribute};
                }
            });

            $loader = AliasLoader::getInstance();
            $loader->alias('Forum', config('forum.frontend.utility_class'));
        }

        $this->loadTranslationsFrom(__DIR__ . '/../translations', 'forum');

        $this->registerPolicies($gate);

        // Make sure Carbon's locale is set to the application locale
        Carbon::setLocale(config('app.locale'));

        if ($this->app->runningInConsole()) {
            $this->commands([
                PresetInstall::class,
                PresetList::class,
                Seed::class,
                SyncStats::class,
            ]);
        }
    }

    private function publishConfig(): void
    {
        $configPathMap = [];
        foreach (self::CONFIG_FILES as $key) {
            $configPathMap[__DIR__ . "/../config/{$key}.php"] = config_path("forum/{$key}.php");
        }

        $this->publishes($configPathMap, 'config');
    }

    private function publishMigrations(): void
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    private function publishTranslations(): void
    {
        $this->publishes([
            __DIR__ . '/../translations/' => function_exists('lang_path') ? lang_path('vendor/forum') : resource_path('lang/vendor/forum'),
        ], 'translations');
    }

    private function enableApi(Router $router): void
    {
        $config = config('forum.api.router');
        $config['middleware'][] = ResolveApiParameters::class;

        $router->group($config, function ($router) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    private function registerPolicies(GateContract $gate): void
    {
        $forumPolicy = config('forum.integration.policies.forum');
        foreach (get_class_methods(new $forumPolicy()) as $method) {
            $gate->define($method, "{$forumPolicy}@{$method}");
        }

        foreach (config('forum.integration.policies.model') as $model => $policy) {
            $gate->policy($model, $policy);
        }
    }
}
