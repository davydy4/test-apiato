<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Containers\User\Models\User;
use Carbon\Carbon;

class InsertToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        factory(User::class)->create([
            'id'                => 1,
            'integration_id'    => '1',
            'type'              => 'user',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(User::class)->create([
            'id'                => 2,
            'integration_id'    => '2',
            'type'              => 'user',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(User::class)->create([
            'id'                => 3,
            'integration_id'    => '3',
            'type'              => 'user',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'deleted_at'        => null
        ]);

        factory(User::class)->create([
            'id'                => 4,
            'integration_id'    => '4',
            'type'              => 'user',
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
