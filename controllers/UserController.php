<?php

class UserController extends Controller
{
    public function index($params)
    {
        // Model actions
        $users = new User();
        $foundUsers = $users->index();
        $this->printJson($foundUsers);
    }

    public function create($params)
    {
        // Validations
        if (!isset($params['name']) || $params['name'] == '')
            $this->printEmptyFieldJson('Name');
        if (!isset($params['address_id']) || $params['address_id'] == '')
            $this->printEmptyFieldJson('Address Id');

        // Model actions
        $users = new User();
        $foundUser = $users->create($params);
        $this->printJson($foundUser);
    }

    // Create the full register of user with all the fields
    public function createFull($params)
    {
        // Validations
        if (!isset($params['name']) || $params['name'] == '')
            $this->printEmptyFieldJson('Name');
        if (!isset($params['address']) || $params['address'] == '')
            $this->printEmptyFieldJson('Address');
        if (!isset($params['city']) || $params['city'] == '')
            $this->printEmptyFieldJson('City');
        if (!isset($params['state']) || $params['state'] == '')
            $this->printEmptyFieldJson('State');
        if (!isset($params['state_uf']) || $params['state_uf'] == '')
            $this->printEmptyFieldJson('State UF');

        // Search or create State ----
        $paramsState = [
            'name' => $params['state'],
            'uf' => $params['state_uf']
        ];

        $states = new State();
        $foundState = $states->readOrCreate($paramsState);
        if(isset($foundState['success']) && $foundState['success'] == false)
            $this->printErrorJson($foundState['message']);

        // Search or create City ----
        $paramsCity = [
            'state_id' => $foundState['id'],
            'name' => $params['city']
        ];

        $cities = new City();
        $foundCity = $cities->readOrCreate($paramsCity);
        if(isset($foundCity['success']) && $foundCity['success'] == false)
            $this->printErrorJson($foundCity['message']);

        // Search or create Address ----
        $paramsAddress = [
            'city_id' => $foundCity['id'],
            'address' => $params['address']
        ];

        $cities = new Address();
        $foundAddress = $cities->readOrCreate($paramsAddress);
        if(isset($foundAddress['success']) && $foundAddress['success'] == false)
            $this->printErrorJson($foundAddress['message']);


        // Create user ----
        $paramsUser = [
            'address_id' => $foundAddress['id'],
            'name' => $params['name']
        ];
        $users = new User();
        $foundUser = $users->create($paramsUser);
        $this->printJson($foundUser);
    }

    public function read($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $users = new User();
        $foundUser = $users->read($params);
        $this->printJson($foundUser);
    }

    public function update($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');
        if (!isset($params['name']) || $params['name'] == '')
            $this->printEmptyFieldJson('Name');
        if (!isset($params['address_id']) || $params['address_id'] == '')
            $this->printEmptyFieldJson('Address Id');

        // Model actions
        $users = new User();
        $foundUser = $users->update($params);
        $this->printJson($foundUser);
    }

    public function delete($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $users = new User();
        $foundUser = $users->delete($params);
        $this->printJson($foundUser);
    }
}
