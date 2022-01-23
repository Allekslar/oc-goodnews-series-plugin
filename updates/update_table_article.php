<?php namespace Allekslar\Series\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class UpdateTableUsers
 * @package Lovata\CompareShopaholic\Updates
 */
class UpdateTableUsers extends Migration
{
    /**
     * Apply migration
     */
    public function up()
    {

        if (Schema::hasTable('lovata_good_news_articles') && !Schema::hasColumn('lovata_good_news_articles', 'serie_id')) {

            Schema::table('lovata_good_news_articles', function (Blueprint $obTable) {
                $obTable->string('serie_id')->nullable();
                $obTable->index('serie_id');
            });
        }
    }

 
    /**
     * Rollback migration
     */
    public function down()
    {

        if (Schema::hasTable('lovata_good_news_articles') && Schema::hasColumn('lovata_good_news_articles', 'serie_id')) {
            Schema::table('lovata_good_news_articles', function (Blueprint $obTable) {
                $obTable->dropColumn(['serie_id']);
            });
        }
    }
}
