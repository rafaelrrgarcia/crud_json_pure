<?php

class AddressController extends Controller
{
    public function index($params)
    {
        // Model actions
        $addresses = new Address();
        $foundAddresses = $addresses->index();
        $this->printJson($foundAddresses);
    }

    public function create($params)
    {
        // Validations
        if (!isset($params['address']) || $params['address'] == '')
            $this->printEmptyFieldJson('Address');
        if (!isset($params['city_id']) || $params['city_id'] == '')
            $this->printEmptyFieldJson('City Id');

        // Model actions
        $addresses = new Address();
        $foundAddress = $addresses->create($params);
        $this->printJson($foundAddress);
    }

    public function read($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $addresses = new Address();
        $foundAddress = $addresses->read($params);
        $this->printJson($foundAddress);
    }

    public function update($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');
        if (!isset($params['address']) || $params['address'] == '')
            $this->printEmptyFieldJson('Address');
        if (!isset($params['city_id']) || $params['city_id'] == '')
            $this->printEmptyFieldJson('City Id');

        // Model actions
        $addresses = new Address();
        $foundAddress = $addresses->update($params);
        $this->printJson($foundAddress);
    }

    public function delete($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $addresses = new Address();
        $foundAddress = $addresses->delete($params);
        $this->printJson($foundAddress);
    }
}
