<?php
namespace App\Http\Traits;

use App\Customers;
use App\Actions;

trait ahmed_trait {
    public function getCustomers() {
        // Get all customers
        $customers = Customers::all();
        return $customers;
    }
	public function getActions() {
        // Get all actions
        $actions = Actions::all();
        return $actions;
    }
}