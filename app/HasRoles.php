<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 9/14/2015
 * Time: 6:14 AM
 */

namespace App;


use stdClass;

trait HasRoles {

    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function hasPermission($name)
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $perm) {
                if ($perm->name == $name) {
                    return true;
                }
            }
        }
        return false;
    }

    public function isEmployee()
    {
        foreach ($this->roles as $role)
        {
            if ($role->is_employee == 1) {
                return true;
            }
        }
        return false;
    }

    public function attachRole($role)
    {
        if (is_object($role))
            $role = $role->getKey();

        if (is_array($role))
            $role = $role['id'];

        $this->roles()->attach($role);
    }

    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }

    public function detachRoles()
    {
        foreach ($this->roles as $role) {
            $this->detachRole($role);
        }
    }
}