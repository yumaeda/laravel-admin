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
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class PermissionsServiceProvider
 *
 * @category    App
 * @package     Providers
 * @author      Yukitaka_Maeda<yumaeda@gmail.com>
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 1.0.0
 */
class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @access public
     * @return void
     */
    public function boot()
    {
        \Blade::directive('role', function ($role){
            return "<?php if(auth()->check() && auth()->user()->hasRoles($role)) { ?>";
        });
        \Blade::directive('endrole', function (){
            return "<?php } ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @access public
     * @return void
     */
    public function register()
    {
        //
    }
}
