<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Utils;

class PreCachePlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        $this->config = $this->grav['config'];

        // don't continue if this is admin and plugin is disabled for admin
        if (!$this->config->get('plugins.precache.enabled_admin') && $this->isAdmin()) {
            return;
        }

        // don't continue if Grav cache is not enabled
        if (!$this->config->get('system.cache.enabled')) {
            return false;
        }

        $this->enable([
            'onShutdown' => ['onShutdown', 0]
        ]);
    }


    public function onShutdown()
    {
        /** @var Cache $cache */
        $cache = $this->grav['cache'];
        $cache_id = md5('preacache'.$cache->getKey());
        $precached = $cache->fetch($cache_id);

        if (!$precached) {

            // Acquire the guard *before* doing any work. If a page render
            // aborts the request (exit, timeout, or a FPM request timeout),
            // the old code never reached the save() at the end, so the next
            // request started over again and the site could re-render every
            // page on every hit. It also acts as a lock so parallel requests
            // don't all start a full run.
            $cache->save($cache_id, true);

            $log_pages = $this->config->get('plugins.precache.log_pages', true);

            // check if this function is available, if so use it to stop any timeouts
            try {
                if (!Utils::isFunctionDisabled('set_time_limit') && !ini_get('safe_mode') && function_exists('set_time_limit')) {
                    set_time_limit(0);
                }
            } catch (\Exception $e) {}

            /** @var Pages $pages */
            $pages = $this->grav['pages'];
            $routes = $pages->routes();

            foreach ($routes as $route => $path) {
                // Log our progress
                if ($log_pages) {
                    $this->grav['log']->info('precache: '.$route);
                }

                try {
                    $page = $pages->get($path);
                    unset($this->grav['page']);
                    $this->grav['page'] = $page;
                    
                    // call the content to load/cache it
                    $page->content();
                } catch (\Exception $e) {
                    // do nothing on error
                }
            }
        }
    }
}
