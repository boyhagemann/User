<?php

namespace Boyhagemann\User\Controller;

use Boyhagemann\User\PermissionRepository;
use Event, View, Sentry, Input, Redirect;

class PermissionController extends \BaseController
{
    protected $permissionRepository;
    
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
            
            
    public function index()
    {        
        Event::fire('user.permissions', array($this->permissionRepository));
        
        $groups = Sentry::findAllGroups();
        $permissions = array();
        foreach($groups as $group) {
            $permissions[$group->id] = $group->getPermissions();
        }
        
//        dd(\Form::checkbox('test' . '[]',1, in_array('edit.user', $permissions[1])));
        
        return View::make('user::permissions', array(
            'permissionRepository' => $this->permissionRepository,
            'groups' => $groups,
            'permissions' => $permissions,
        ));
    }
    
    public function save()
    {
        $groups = Sentry::findAllGroups();
        $permissions = array();
                
        foreach(Input::all() as $permission => $allowed) {
            
            if(!is_array($allowed)) {
                continue;
            }
                        
            foreach($groups as $group) {
                
                $permission = str_replace('_', '.', $permission);
                
                $status = in_array($group->id, $allowed) ? 1 : 0;                
                $permissions[$group->id][$permission] = $status;
            }
        }
        
        foreach($groups as $group) {
            $group->permissions = array_merge($group->permissions, $permissions[$group->id]);
            $group->save();
        }
        
        return Redirect::route('user.permissions');
    }

}

