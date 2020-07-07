<?php

use Illuminate\Database\Seeder;
use App\Models\Users;

class SeederUsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	$store = new Users;
        $store->name = 'administrator';
        $store->email = 'your.administrator@try.you';
        $store->password = 'try.you';
        $store->save();
    }
}
