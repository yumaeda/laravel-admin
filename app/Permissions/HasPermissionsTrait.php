<?php
/**
 *
 *
 * @author      Yukitaka_Maeda<yumaeda@gmail.com>
 * @copyright   laravel-admin
 * @license     %%license%%
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 2018/10/18 12:15
 */
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
     * Get all the related roles
     *
     * @access public
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get all the related permissions
     *
     * @access public
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Give the specified permissions
     *
     * @access public
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissions(...$permissions): self
    {
        $target = $this->getTargetPermissions($permissions);
        if ($target !== null) {
            $this->permissions()->saveMany($target);
        }

        return $this;
    }

    /**
     * Deprives the specified permission
     *
     * @access public
     * @param mixed ...$permissions
     * @return $this
     */
    public function deprivePermissions(...$permissions): self
    {
        $target = $this->getTargetPermissions($permissions);
        if ($target !== null) {
            $this->permissions()->detach($target);
        }

        return $this;
    }

    /**
     * Refreshes with the specified permissions
     *
     * @param mixed ...$permissions
     * @return $this
     */
    public function refreshPermissions(...$permissions): self
    {
        $this->permissions()->detach();

        return $this->givePermissions($permissions);
    }

    /**
     * Gets an boolean value whether to have the specified permission or not
     *
     * @access public
     * @param \App\Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission): bool
    {
        $has_role_permissions = $this->hasPermissionThroughRole($permission);
        $permission_count = $this->permissions()->where('slug', $permission->slug)->count();

        return ($has_role_permissions || (bool) $permission_count);
    }

    /**
     * Delete the specified permissions
     *
     * @access public
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(...$permissions): self
    {
        $target = $this->getTargetPermissions($permissions);
        $this->permissions()->detach($target);

        return $this;
    }

    /**
     * Get all the specified permissions
     *
     * @access protected
     * @param array $permissions
     * @return mixed
     */
    protected function getTargetPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    /**
     * Gets an boolean value whether to have one of the specified roles or not
     *
     * @access protected
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRoles(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gets an boolean value whether to have the specified permission or not
     *
     * @access protected
     * @param \App\Permission $permission
     * @return bool
     */
    protected function hasPermissionThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }
}
