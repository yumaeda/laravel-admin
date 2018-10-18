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
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoleUserTable
 *
 * @author      Yukitaka_Maeda<Yukitaka_Maeda@epark.co.jp>
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 1.0.0
 */
class CreateRoleUserTable extends Migration
{
    /**
     * Table name
     *
     * @var string
     */
    const TABLE_NAME = 'role_user';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();

            // Set the foreign key constraints in order to delete the corresponding records
            // if a user or permission is deleted.
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
