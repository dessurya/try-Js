<?php

use Illuminate\Database\Seeder;
use App\Models\Config;

class SeederConfigTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	$store = [];
    	$store[] = [
    		'accKey' => 'menuCalladministrator',
    		'config' => '{"menu" : [{"name" : "Self Data","active" : true,"action" : "Self_Data"},{"name" : "Master Administrator","active" : false,"action" : "Master_Administrator"},{"name" : "Master User","active" : false,"action" : "Master_User"},{"name" : "Master Gift","active" : false,"action" : "Master_Gift"},{"name" : "Master Product","active" : false,"action" : "Master_Product"},{"name" : "Transaction","active" : false,"action" : "Transaction"}]}'
    	];
        $store[] = [
            'accKey' => 'Self_Data_administrator',
            'config' => '{"function_name" : "findData","model" : "App\\\\Models\\\\Users"}'
        ];
        $store[] = [
            'accKey' => 'Master_Administrator_administrator',
            'config' => '{"function_name" : "getConfigPageIndex","model" : "App\\\\Models\\\\Users","index" : {"table" : [{ "field" : "Name", "name" : "name", "search" : true, "order" : true },{ "field" : "Email", "name" : "email", "search" : true, "order" : true }]}}'
        ];
        $store[] = [
            'accKey' => 'Master_User_administrator',
            'config' => '{"function_name" : "getConfigPageIndex","model" : "App\\\\Models\\\\Customer","index" : {"table" : [{ "field" : "Name", "name" : "name", "search" : true, "order" : true },{ "field" : "Email", "name" : "email", "search" : true, "order" : true },{ "field" : "Address", "name" : "address", "search" : true, "order" : true },{ "field" : "Phone", "name" : "phone", "search" : true, "order" : true },{ "field" : "Point", "name" : "point", "search" : true, "order" : true }]}}'
        ];
        $store[] = [
            'accKey' => 'Master_Gift_administrator',
            'config' => '{"function_name" : "getConfigPageIndex","model" : "App\\\\Models\\\\Gift","index" : {"table" : [{ "field" : "Name", "name" : "name", "search" : true, "order" : true },{ "field" : "Point", "name" : "point", "search" : true, "order" : true },{ "field" : "Description", "name" : "description", "search" : true, "order" : true }]}}'
        ];
        $store[] = [
            'accKey' => 'Master_Product_administrator',
            'config' => '{"function_name" : "getConfigPageIndex","model" : "App\\\\Models\\\\Product","index" : {"table" : [{ "field" : "Name", "name" : "name", "search" : true, "order" : true },{ "field" : "Price", "name" : "price", "search" : true, "order" : true },{ "field" : "Description", "name" : "description", "search" : true, "order" : true }]}}'
        ];
        $store[] = [
            'accKey' => 'Transaction_administrator',
            'config' => '{"function_name" : "getConfigPageIndex","model" : "App\\\\Models\\\\Transaction","index" : {"table" : [{ "field" : "Created At", "name" : "created_at", "search" : true, "order" : true },{ "field" : "Customer", "name" : "customer", "search" : true, "order" : true },{ "field" : "Amount", "name" : "amount", "search" : true, "order" : true }]}}'
        ];
    	foreach ($store as $row) {
            $store = new Config;
            $store->accKey = $row['accKey'];
            $store->config = $row['config'];
            $store->save();
        }
    }
}
