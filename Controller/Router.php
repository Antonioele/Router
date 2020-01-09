<?php


namespace Antonioele\Router\Controller;


use Magento\Framework\App\RouterInterface as RouterInterfaceAlias;

class Router implements RouterInterfaceAlias

{
    /**
     * No route constant used for request
     */
    const NO_ROUTE = 'noroute';

    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * @var string
     */
    protected $actionInterface = \Magento\Framework\App\ActionInterface::class;

    /**
     * @var array
     */
    protected $_modules = [];

    /**
     * @var array
     */
    protected $_dispatchData = [];

    /**
     * List of required request parameters
     * Order sensitive
     * @var string[]
     */
    protected $_requiredParams = ['moduleFrontName', 'actionPath', 'actionName'];

    /**
     * @var \Magento\Framework\App\Route\ConfigInterface
     */
    protected $_routeConfig;

    /**
     * Url security information.
     *
     * @var \Magento\Framework\Url\SecurityInfoInterface
     */
    protected $_urlSecurityInfo;

    /**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\App\ResponseFactory
     */
    protected $_responseFactory;

    /**
     * @var \Magento\Framework\App\DefaultPathInterface
     */
    protected $_defaultPath;

    /**
     * @var \Magento\Framework\Code\NameBuilder
     */
    protected $nameBuilder;

    /**
     * @var array
     */
    protected $reservedNames = ['new', 'print', 'switch', 'return'];

    /**
     * Allows to control if we need to enable no route functionality in current router
     *
     * @var bool
     */
    protected $applyNoRoute = false;

    /**
     * @var string
     */
    protected $pathPrefix = null;

    /**
     * @var \Magento\Framework\App\Router\ActionList
     */
    protected $actionList;

    /**
     * @var \Magento\Framework\App\Router\PathConfigInterface
     */
    protected $pathConfig;

    /**
     * @param \Magento\Framework\App\Router\ActionList $actionList
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Magento\Framework\App\DefaultPathInterface $defaultPath
     * @param \Magento\Framework\App\ResponseFactory $responseFactory
     * @param \Magento\Framework\App\Route\ConfigInterface $routeConfig
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Framework\Code\NameBuilder $nameBuilder
     * @param \Magento\Framework\App\Router\PathConfigInterface $pathConfig
     *
     * @throws \InvalidArgumentException
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(
        \Magento\Framework\App\Router\ActionList $actionList,
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\DefaultPathInterface $defaultPath,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\App\Route\ConfigInterface $routeConfig,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Code\NameBuilder $nameBuilder,
        \Magento\Framework\App\Router\PathConfigInterface $pathConfig
    ) {
        $this->actionList = $actionList;
        $this->actionFactory = $actionFactory;
        $this->_responseFactory = $responseFactory;
        $this->_defaultPath = $defaultPath;
        $this->_routeConfig = $routeConfig;
        $this->_url = $url;
        $this->nameBuilder = $nameBuilder;
        $this->pathConfig = $pathConfig;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $antonio=$request->getPathInfo()."plutooooooooooooooo";
        echo $antonio;
    }

}