<?php

namespace Cherif\Demo;

use Laminas\Form\View\Helper\FormElement;
use Laminas\Form\View\HelperConfig;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\HelperPluginManager;
use Laminas\View\Renderer\PhpRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LaminasFromTwigExtension extends AbstractExtension
{
	private $formElement;
	private $renderer;
	private $config;

	/**	
	 * @inherit
	 */
	public function __construct(FormElement $formElement, PhpRenderer $renderer, HelperConfig $config)
	{
		$this->formElement = $formElement;
		$this->renderer = $renderer;
		$this->config = $config;
	}

	public function getFunctions()
    {
		$fns = [];
		$pluginManager = $this->pluginManager();
		$serviceManager = $this->serviceManager($pluginManager);
		$aliases = $this->configure($serviceManager);
		$options  = ['is_safe' => ['html']];
		foreach ($aliases as $name => $definition) {
			if ($serviceManager->has($name)) {
				$plugin = $serviceManager->get($name);
				$callable = [$plugin, '__invoke'];
				$fns[] = new TwigFunction($name, $callable, $options);
			}
		}
		return $fns;
	}

	private function pluginManager(): HelperPluginManager
	{
		return $this->renderer->getHelperPluginManager();
	}

	private function serviceManager(HelperPluginManager $pluginManager): ServiceManager
	{
		$this->renderer->setHelperPluginManager($this->config->configureServiceManager($pluginManager));
		return $this->config->configureServiceManager($pluginManager);
	}


	private function configure(ServiceManager $serviceManager): array
	{
		$this->renderer->setHelperPluginManager($serviceManager);
		$this->formElement->setView($this->renderer);
		$config = $this->config->toArray();
		return $config['aliases'];
	}
}