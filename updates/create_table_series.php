<?php namespace Allekslar\Series\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableSeries
 * @package Allekslar\Series\Classes\Console
 */
class CreateTableSeries extends Migration
{
    const TABLE = 'allekslar_series_series';

    /**
     * Apply migration
     */
    public function up()
    {
        if (Schema::hasTable(self::TABLE)) {
            return;
        }

        Schema::create(self::TABLE, function (Blueprint $obTable)
        {
            $obTable->engine = 'InnoDB';
            $obTable->increments('id')->unsigned();
            $obTable->boolean('active')->default(0);
            $obTable->string('name')->index();
            $obTable->string('slug')->unique()->index();
            $obTable->string('code')->nullable()->index();
            $obTable->string('external_id')->nullable()->index();
            $obTable->integer('view_count')->nullable()->default(0);
            $obTable->integer('parent_id')->nullable()->unsigned();
            $obTable->integer('nest_left')->nullable()->unsigned();
            $obTable->integer('nest_right')->nullable()->unsigned();
            $obTable->integer('nest_depth')->nullable()->unsigned();
            $obTable->timestamps();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
