<?php

use Cherif\Demo\Handler\LoginHandler;
use Cherif\Demo\LaminasFromTwigExtension;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use DI\Container;
use Laminas\Form\View\Helper\FormElement;
use Laminas\Form\View\HelperConfig;
use Laminas\View\Renderer\PhpRenderer;
use Twig\TwigFunction;

require __DIR__ . '/../vendor/autoload.php';

// Create Container using PHP-DI
$container = new Container();

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
AppFactory::setContainer($container);
$app = AppFactory::create();

// Add Routing Middleware
$app->addRoutingMiddleware();

$twig = Twig::create('../templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

$twigEnvironment = $twig->getEnvironment();

// $helper = new FormElement();
// $renderer = new PhpRenderer();

// $helpers = $renderer->getHelperPluginManager();
// $config  = new HelperConfig();
// // echo '<pre>' ;
// // var_dump($config->toArray()['aliases']);
// // echo '</pre>' ;
// //exit;
// $serviceManager = $config->configureServiceManager($helpers);
// $renderer->setHelperPluginManager($config->configureServiceManager($helpers));
// $helper->setView($renderer);

// $envi->registerUndefinedFunctionCallback(function($name) use($serviceManager){
	
// 	$helper = $serviceManager->get($name);
// 	$callable = [$helper, '__invoke'];
// 	$options  = ['is_safe' => ['html']];
// 	$fn = new TwigFunction($name, $callable, $options);
	
// 	return $fn;

// });

$formExtension = new LaminasFromTwigExtension(new FormElement(), new PhpRenderer(), new HelperConfig);
$twigEnvironment->addExtension($formExtension);


/**
 * Add Error Handling Middleware
 *
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * which can be replaced by a callable of your choice.
 
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define app routes
$app->map(['GET', 'POST'], '/login', LoginHandler::class);

// Run app
$app->run();