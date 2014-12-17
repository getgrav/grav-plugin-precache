<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;

class PreCachePlugin extends Plugin
{
    /** @var Config $config */
    protected $config;

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
        $config = $this->grav['config']->get('plugins.precache');

        if (!$config['enabled_admin'] && $this->isAdmin()) {
            $this->active = false;
            return;
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

            /** @var Pages $pages */
            $pages = $this->grav['pages'];
            $routes = $pages->routes();

            foreach ($routes as $route => $path) {
                // Log our progress
                $this->grav['log']->addWarning('precache: '.$route);
                try {
                    $page = $pages->get($path);
                    // call the content to load/cache it
                    $page->content();
                } catch (\Exception $e) {
                    // do nothing on error
                }
            }

            $cache->save($cache_id, true);
        }
    }
}
