<?php

class HomeController extends Controller
{
    public function index()
    {
        // Default home message
        $this->printJson(['success' => true]);
    }
}
