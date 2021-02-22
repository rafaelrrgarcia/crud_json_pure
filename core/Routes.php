<?php

class Routes
{
    public function getClassFunction($url)
    {
        try {
            $routes = [];

            switch ($_SERVER['REQUEST_METHOD']) {
                case "GET":
                    $routes = $this->get($url);
                    break;
                case "POST":
                    $routes = $this->post($url);
                    break;
                case "DELETE":
                    $routes = $this->delete($url);
                    break;
            }

            $dataReturn = $this->checkUrlParameters($url, $routes);
            return $dataReturn;

        } catch (Exception $e) {
            return $e;
        }
    }

    private function get($url) // Defines GET routes
    {
        return $routes = [
            'users' => 'UserController@index',
            'users/:id' => 'UserController@read',
            'addresses' => 'AddressController@index',
            'addresses/:id' => 'AddressController@read',
            'cities' => 'CityController@index',
            'cities/:id' => 'CityController@read',
            'states' => 'StateController@index',
            'states/:id' => 'StateController@read'
        ];
    }

    private function post($url) // Defines POST routes
    {
        return $routes = [
            'users' => 'UserController@create',
            'users/full' => 'UserController@createFull',
            'users/:id' => 'UserController@update',
            'addresses' => 'AddressController@create',
            'addresses/:id' => 'AddressController@update',
            'cities' => 'CityController@create',
            'cities/:id' => 'CityController@update',
            'states' => 'StateController@create',
            'states/:id' => 'StateController@update'
        ];
    }

    private function delete($url) // Defines DELETE routes
    {
        return $routes = [
            'users/:id' => 'UserController@delete',
            'addresses/:id' => 'AddressController@delete',
            'cities/:id' => 'CityController@delete',
            'states/:id' => 'StateController@delete'
        ];
    }

    private function checkUrlParameters($url, $routes) // Do the routes verifications above the URL
    {
        try {
            $dataReturn = [ // Default return if not found
                'class' => '',
                'action' => '',
                'found' => false,
            ];

            foreach ($routes as $routeUrl => $routeClassFunction) {
                if ($url == $routeUrl) { // Check if full url
                    $dataReturn = $this->formatDataReturn($routeClassFunction);
                    break;
                } else { // check if parameters
                    $found = $this->checkVariablesInUrl($url, $routeUrl);
                    if ($found != false) {
                        $dataReturn = $this->formatDataReturn($routeClassFunction, $found);
                        break;
                    }
                }
            }

            return $dataReturn;

        } catch (Exception $e) {
            return $e;
        }
    }

    private function formatDataReturn($routeClassFunction, $extraParams = false) // Get CLASS and FUNCTION from the URL route
    {
        $routeParts = explode("@", $routeClassFunction);
        $dataReturn = [
            'class' => $routeParts[0],
            'action' => $routeParts[1],
            'found' => true
        ];

        if ($extraParams) $dataReturn = array_merge($dataReturn, $extraParams);

        return $dataReturn;
    }

    private function checkVariablesInUrl($url, $routeURL) // Check special URL with variables
    {
        $extraParams = [];
        $urlChecker = [];

        $explodedUrl = explode("/", $url);
        $explodedRoute = explode("/", $routeURL);

        // Search for variable positioning
        for ($i = 0; $i < count($explodedRoute); $i++) {
            if (strpos($explodedRoute[$i], ':') !== false && isset($explodedUrl[$i])) {
                $variable = str_replace(":", "", $explodedRoute[$i]);
                $extraParams[$variable] = $explodedUrl[$i];
                $urlChecker[] = (isset($explodedRoute[$i])) ? $explodedRoute[$i] : "";
            } else {
                $urlChecker[] = (isset($explodedUrl[$i])) ? $explodedUrl[$i] : "";
            }
        }

        if (count($extraParams) == 0 || implode("/", $urlChecker) != $routeURL) $extraParams = false;
        return $extraParams;
    }
}
