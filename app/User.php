<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $casts = [
    //     'roles' => 'array',
    // ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    // public function getFullNameAttribute()
    // {
    //     if (is_null($this->last_name)) {
    //         return "{$this->name}";
    //     }

    //     return "{$this->name} {$this->last_name}";
    // }
    // public function isAdmin()
    // {
    //     return $this->role == 'admin';
    // }
    /***
     * @param string $role
     * @return $this
     */

    // public function addRole(string $role)
    // {
    //     $roles = $this->getRoles();
    //     $roles[] = $role;

    //     $roles = array_unique($roles);
    //     $this->setRoles($roles);

    //     return $this;
    // }

/**
 * @param array $roles
 * @return $this
 */
    // public function setRoles(array $roles)
    // {
    //     $this->setAttribute('roles', $roles);
    //     return $this;
    // }

/***
 * @param $role
 * @return mixed
 */
    // public function hasRole($role)
    // {
    //     return in_array($role, $this->getRoles());
    // }

/***
 * @param $roles
 * @return mixed
 */
    // public function hasRoles($roles)
    // {
    //     $currentRoles = $this->getRoles();
    //     foreach ($roles as $role) {
    //         if (!in_array($role, $currentRoles)) {
    //             return false;
    //         }
    //     }
    //     return true;
    // }

/**
 * @return array
 */
    // public function getRoles()
    // {
    //     $roles = $this->getAttribute('roles');

    //     if (is_null($roles)) {
    //         $roles = [];
    //     }

    //     return $roles;
    // }
}
