<?php
use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\User;

/**
 * Class UserTableSeeder
 *
 * @author      Yukitaka_Maeda<yumaeda@gmail.com>
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 1.0.0
 */
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_role = Role::where('slug','developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $dev_perm = Permission::where('slug','create-tasks')->first();
        $manager_perm = Permission::where('slug','edit-users')->first();

        $developer = new User();
        $developer->name = 'Yukitaka Maeda';
        $developer->email = 'yumaeda@xxx.com';
        $developer->password = bcrypt('secret');
        $developer->save();
        $developer->roles()->attach($dev_role);
        $developer->permissions()->attach($dev_perm);

        $manager = new User();
        $manager->name = 'Fumika Baba';
        $manager->email = 'fbaba@xxx.com';
        $manager->password = bcrypt('secret');
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);
    }
}
