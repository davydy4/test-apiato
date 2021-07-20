<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Containers\Enterprise\Models\Enterprise;

class InsertToEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        factory(Enterprise::class)->create([
            'objid'     => 8800000,
            'objidref'  => 8800000,
            'objsname'  => 'Головной офис',
            'objstatus' => null,
            'is_root'   => true,
            'parents'   => null
        ]);

        factory(Enterprise::class)->create([
            'objid'     => 11111111,
            'objidref'  => 8800000,
            'objsname'  => 'ООО Самая лучшая компания',
            'objstatus' => null,
            'is_root'   => false,
            'parents'   => null,
            'quota'     => 5
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
