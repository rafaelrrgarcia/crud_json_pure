<?php

class CityController extends Controller
{
    public function index($params)
    {
        // Model actions
        $cities = new City();
        $foundCities = $cities->index();
        $this->printJson($foundCities);
    }

    public function create($params)
    {
        // Validations
        if (!isset($params['name']) || $params['name'] == '')
            $this->printEmptyFieldJson('Name');
        if (!isset($params['state_id']) || $params['state_id'] == '')
            $this->printEmptyFieldJson('State Id');

        // Model actions
        $cities = new City();
        $foundCity = $cities->create($params);
        $this->printJson($foundCity);
    }

    public function read($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $cities = new City();
        $foundCity = $cities->read($params);
        $this->printJson($foundCity);
    }

    public function update($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');
        if (!isset($params['name']) || $params['name'] == '')
            $this->printEmptyFieldJson('Name');
        if (!isset($params['state_id']) || $params['state_id'] == '')
            $this->printEmptyFieldJson('State Id');

        // Model actions
        $cities = new City();
        $foundCity = $cities->update($params);
        $this->printJson($foundCity);
    }

    public function delete($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $cities = new City();
        $foundCity = $cities->delete($params);
        $this->printJson($foundCity);
    }
}
