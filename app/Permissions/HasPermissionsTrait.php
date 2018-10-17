<?php
namespace App\Permissions;

use App\Permission;
use App\Role;

/**
 * Trait HasPermissionsTrait
 *
 * @category    App
 * @package     Permissions
 * @author      Yukitaka Maeda<yumaeda@gmail.com>
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 1.0.0
 */
trait HasPermissionsTrait
{
    /**
     * @param array $permissions
     * @return mixed
     */
    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }

    /**
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles()->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles()->contains($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function withdrawPermissionsTo(...$permissions): self
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return \App\Permissions\HasPermissionsTrait
     */
    public function refreshPermissions(...$permissions) {
        $this->permissions()->detach();

        return $this->givePermissionsTo($permissions);
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission): bool
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(...$permissions): self
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions !== null) {
            $this->permissions()->saveMany($permissions);
        }

        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(...$permissions): self
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission): bool
    {
       return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }
}
