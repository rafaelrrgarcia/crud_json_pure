<?php

class StateController extends Controller
{
    public function index($params)
    {
        // Model actions
        $states = new State();
        $foundStates = $states->index();
        $this->printJson($foundStates);
    }

    public function create($params)
    {
        // Validations
        if (!isset($params['name']) || $params['name'] == '')
            $this->printEmptyFieldJson('Name');
        if (!isset($params['uf']) || $params['uf'] == '')
            $this->printEmptyFieldJson('UF');

        // Model actions
        $cities = new State();
        $foundState = $cities->create($params);
        $this->printJson($foundState);
    }

    public function read($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $cities = new State();
        $foundState = $cities->read($params);
        $this->printJson($foundState);
    }

    public function update($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');
        if (!isset($params['name']) || $params['name'] == '')
            $this->printEmptyFieldJson('Name');
        if (!isset($params['uf']) || $params['uf'] == '')
            $this->printEmptyFieldJson('UF');

        // Model actions
        $cities = new State();
        $foundState = $cities->update($params);
        $this->printJson($foundState);
    }

    public function delete($params)
    {
        // Validations
        if (!isset($params['id']) || $params['id'] == '')
            $this->printEmptyFieldJson('Id');

        // Model actions
        $cities = new State();
        $foundState = $cities->delete($params);
        $this->printJson($foundState);
    }
}
