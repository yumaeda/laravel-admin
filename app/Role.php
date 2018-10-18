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
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 *
 * @category    App
 * @author      Yukitaka_Maeda<yumaeda@gmail.com>
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 1.0.0
 */
class Role extends Model
{
    /**
     * Get all the permissions
     *
     * @access public
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        // Pivot table "permissions_roles" has to be defined.
        return $this->belongsToMany(Permission::class);
    }
}
