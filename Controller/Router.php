<?php


namespace Antonioele\Router\Controller;


use Magento\Framework\App\RouterInterface as RouterInterfaceAlias;
use Magento\Catalog\Api\ProductRepositoryInterface;

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
     *
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
    private $productRepository;
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
    protected $logger;
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
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\App\Router\ActionList $actionList,
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\DefaultPathInterface $defaultPath,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\App\Route\ConfigInterface $routeConfig,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Code\NameBuilder $nameBuilder,
        \Magento\Framework\App\Router\PathConfigInterface $pathConfig,
    \Psr\Log\LoggerInterface $logger
    ) {
        $this->productRepository =$productRepository;
        $this->actionList = $actionList;
        $this->actionFactory = $actionFactory;
        $this->_responseFactory = $responseFactory;
        $this->_defaultPath = $defaultPath;
        $this->_routeConfig = $routeConfig;
        $this->_url = $url;
        $this->nameBuilder = $nameBuilder;
        $this->pathConfig = $pathConfig;
        $this->logger =$logger;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
$poutp=$this->parseRequest($request);
$actionistance=$this->matchAction($request,$poutp);

        $productId = $request->getParam('id');
        echo $productId;
      $ppproduct=  $this->productRepository->getById(1402);
      $ppproduct->getName();
$ppp=["www"=>$ppproduct->getName()];
$this->logger->info("ppppppp",$ppp);
        $pluto=["pippo"=>$request];
//$this->logger->info("la request",$pluto);
$this->logger->info("output",$poutp);




    }

    protected function parseRequest(\Magento\Framework\App\RequestInterface $request)
    {
        $output = [];

        $path = trim($request->getPathInfo(), '/');

        $params = explode('/', $path ? $path : $this->pathConfig->getDefaultPath());
        foreach ($this->_requiredParams as $paramName) {
            $output[$paramName] = array_shift($params);
        }

        for ($i = 0, $l = sizeof($params); $i < $l; $i += 2) {
            $output['variables'][$params[$i]] = isset($params[$i + 1]) ? urldecode($params[$i + 1]) : '';
        }
        return $output;
    }
    protected function matchAction(\Magento\Framework\App\RequestInterface $request, array $params)
    {
        $moduleFrontName = $this->matchModuleFrontName($request, $params['moduleFrontName']);
        if (empty($moduleFrontName)) {
            return null;
        }

        /**
         * Searching router args by module name from route using it as key
         */
        $modules = $this->_routeConfig->getModulesByFrontName($moduleFrontName);

        if (empty($modules) === true) {
            return null;
        }

        /**
         * Going through modules to find appropriate controller
         */
        $currentModuleName = null;
        $actionPath = null;
        $action = null;
        $actionInstance = null;


        if (isset($params['variables'])) {
            $request->setParams($params['variables']);
        }
        return $actionInstance;
    }
    protected function matchModuleFrontName(\Magento\Framework\App\RequestInterface $request, $param)
    {
        // get module name
        if ($request->getModuleName()) {
            $moduleFrontName = $request->getModuleName();
        } elseif (!empty($param)) {
            $moduleFrontName = $param;
        } else {
            $moduleFrontName = $this->_defaultPath->getPart('module');
            $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, '');
        }
        if (!$moduleFrontName) {
            return null;
        }
        return $moduleFrontName;
    }

}