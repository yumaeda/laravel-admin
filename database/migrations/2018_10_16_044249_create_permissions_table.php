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
 * Class CreatePermissionsTable
 *
 * @author      Yukitaka_Maeda<yumaeda@gmail.com>
 * @version     GIT: $Id$
 * @link        %%your_link%%
 * @see         %%your_see%%
 * @since       Class available since Release 1.0.0
 */
class CreatePermissionsTable extends Migration
{
    /**
     * Table name
     *
     * @var string
     */
    const TABLE_NAME = 'permissions';

    /**
     * Run the migrations.
     *
     * @access public
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @access public
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
