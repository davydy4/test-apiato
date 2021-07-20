<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Containers\User\Models\UserAsup;
use Carbon\Carbon;

class InsertToUsersAsupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        factory(UserAsup::class)->create([
            'number'            => 1,
            'fullname'          => 'Тестов Тест Тестович',
            'email'             => 'user1@nor.com',
            'integration_id'    => '1',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(UserAsup::class)->create([
            'number'            => 2,
            'fullname'          => 'Абрикосов Абрикос Абрикосович',
            'email'             => 'user2@nor.com',
            'integration_id'    => '2',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(UserAsup::class)->create([
            'number'            => 3,
            'fullname'          => 'Огурцов Огурец Огурцович',
            'email'             => 'user3@nor.com',
            'integration_id'    => '3',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(UserAsup::class)->create([
            'number'            => 4,
            'fullname'          => 'Молодцов Молодец Молодцович',
            'email'             => 'user4@nor.com',
            'integration_id'    => '4',
            'orgid'             => 11111111,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
