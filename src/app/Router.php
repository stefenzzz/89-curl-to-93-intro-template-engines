<?php

namespace App;
use App\Exceptions\RouteNotFoundException;
use App\Attributes\Route;
use Illuminate\Container\Container;

class Router{

    private array $routes = [];
    private string $requestMethod;
    private string $requestUri;
    public function __construct(private Container $container)
    {

    }

    public function register(string $method, string $route, array $action):Router
    {
        $this->routes[$method][$route] = $action;
        return $this;
    }
    public function listRouteControllers(array $controllers)
    {
   
        foreach($controllers as $controller)
        {
            $reflectionController = new \ReflectionClass($controller);
                  
            foreach($reflectionController->getMethods() as $method)
            {
                $attributes = $method->getAttributes(Route::class,\ReflectionAttribute::IS_INSTANCEOF);
                
                 foreach($attributes as $attribute)
                 {
                    $route = $attribute->newInstance();
            
                    $this->register($route->method->value,$route->routePath,[$controller,$method->name]);                               
                 }              
            }          
        }
           
    }

    public function get(string $route, array $action):Router
    {
        return $this->register('get', $route, $action);

    }
    public function post(string $route, array $action):Router
    {
        return $this->register('post',$route,$action);

    }
    public function resolve($requestUri,$requestMethod)
    {

        $this->requestUri = strtolower($requestUri);
        $this->requestMethod = strtolower($requestMethod);
       

        $route = explode('?', $this->requestUri)[0];
        
 
        $action = $this->routes[$this->requestMethod][$route] ?? null;

    
        if(!$action){
            throw new RouteNotFoundException('');
        }
        
        if(!is_array($action))
        {
            throw new RouteNotFoundException();
        }

        [$class, $method] = $action;
        if(class_exists($class))
        {
            $class =  $this->container->get($class);
         
            if(method_exists($class, $method))
            {
                return call_user_func_array([$class,$method],[]);
                
            }
        }
   

        throw new RouteNotFoundException('class does not exists');
    }
    public function routes():array
    {
        return $this->routes;
    }
}
