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

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class RoleMiddleware
 *
 * @category    App
 * @package     Http
 * @subpackage  Middleware
 * @author      Yukitaka_Maeda<yumaeda@gmail.com>
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 1.0.0
 */
class RoleMiddleware
{
    /**
     * 404 Error code
     *
     * @var int
     */
    const ERROR_CODE_404 = 404;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request
     * @param \Closure $next
     * @param string $role
     * @param null $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role, $permission = null)
    {
        if (empty($request->user()) || !$request->user()->hasRoles($role)) {
            abort(self::ERROR_CODE_404);
        }

        if ($permission !== null && !$request->user()->can($permission)) {
            abort(self::ERROR_CODE_404);
        }

        return $next($request);
    }
}
