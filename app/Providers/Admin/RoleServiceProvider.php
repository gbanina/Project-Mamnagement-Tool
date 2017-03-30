<?php

namespace App\Providers\Admin;
use Auth;
use App\Models\Role;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    public function __construct(){
    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function all()
    {
        return Role::where('account_id', Auth::user()->current_acc)->get();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function store($name)
    {
        $role = new Role();
        $role->account_id = Auth::user()->current_acc;
        $role->name = $name;
        $role->save();
    }

    public function find($id)
    {
        return Role::find($id);
    }

    public function update($id, $name)
    {
        $role = Role::find($id);
        $role->name = $name;
        $role->save();
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
    }
}
