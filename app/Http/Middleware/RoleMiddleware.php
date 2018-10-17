<?php
namespace App\Http\Middleware;

use Closure;

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
     * @param $request
     * @param \Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if ($request->user() && !$request->user()->hasRole($role)) {
            abort(self::ERROR_CODE_404);
        }

        if ($permission !== null && !$request->user()->can($permission)) {
            abort(self::ERROR_CODE_404);
        }

        return $next($request);
    }
}
