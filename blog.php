<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use Grav\Common\Twig\Twig;

class BlogPlugin extends Plugin
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
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Set needed variables to display breadcrumbs.
     */
    public function onTwigSiteVariables()
    {
        $framework = strtolower($this->config->get('plugins.blog.framework'));
        if (empty($framework)){
            throw new \InvalidArgumentException('The blog "framework" variable value must be defined. At the moment it is empty. If you are overriding the default configuration, please define the "framework" variable with a valid value.');
        }
        
        if (!preg_grep("/" . $framework . "/i", array(
            "pure",
            "bootstrap",
        ))){
            throw new \InvalidArgumentException(sprintf('The blog "framework" variable value must be one of "pure" or "bootstrap". You gave "%s"', $framework));
        }
        
        $this->grav['assets']->add(sprintf('plugin://blog/css/%s_blog.css', $framework));
        if ($this->config->get('plugins.blog.add_framework_assets')) {
            $method = 'add' . ucfirst($framework);
            $this->$method();
        }
        
        $twig = $this->grav['twig'];
        $twig->twig_vars['framework'] = $framework;
        $this->setUrls($twig);
    }
    
    private function addBootstrap()
    {
        $this->grav['assets']->add('plugin://blog/vendor/bootstrap/css/bootstrap.min.css', 100);
        $this->grav['assets']->add('plugin://blog/vendor/bootstrap/js/bootstrap.min.js', 100);
    }
    
    private function addPure()
    {
        $this->grav['assets']->add('plugin://blog/vendor/pure/grids-min.css', 100);
    }
    
    private function setUrls(Twig $twig)
    {
        $parent = $this->grav['page']->parent();
        if (null === $parent) {
            $twig->twig_vars['feed_url'] = $twig->twig_vars['base_url'] = '';
            
            return;
        }
        
        $feedUrl = $baseUrl = $parent->url();
        if ($baseUrl == '/') {
            $baseUrl = '';
        }
        if ($baseUrl == $twig->twig_vars['base_url_relative']) {
            $feedUrl = $baseUrl . $parent->slug();
        }
        
        $twig->twig_vars['base_url'] = $baseUrl;
        $twig->twig_vars['feed_url'] = $feedUrl;
    }
}
