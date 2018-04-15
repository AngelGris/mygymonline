<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
        });

        DB::table('exercises')->insert(
            [
                [
                    'id'            => 1,
                    'name'          => 'Butterfly Machine',
                    'description'   => 'Chest'
                ],
                [
                    'id'            => 2,
                    'name'          => 'Walking',
                    'description'   => 'Cardiovaculra System, Legs'

                ],
                [
                    'id'            => 3,
                    'name'          => 'Arnold Press',
                    'description'   => 'Front Shoulders, Upper Back, Triceps, Shoulders'
                ],
                [
                    'id'            => 4,
                    'name'          => 'Marching in Place',
                    'description'   => 'Cardiovaculra System, Full Body'

                ],[
                    'id'            => 5,
                    'name'          => 'Swing',
                    'description'   => 'Shoulders, Quads, Glutes, Lower Back'
                ],
                [
                    'id'            => 6,
                    'name'          => 'Crunch',
                    'description'   => 'All Abs'

                ],[
                    'id'            => 7,
                    'name'          => 'Air Squat',
                    'description'   => 'Quads, Glutes, Legs, Lower Back'
                ],
                [
                    'id'            => 8,
                    'name'          => 'Windmill',
                    'description'   => 'Back, Shoulders'

                ],[
                    'id'            => 9,
                    'name'          => 'Push-up Wall',
                    'description'   => 'Chest, Triceps'
                ],
                [
                    'id'            => 10,
                    'name'          => 'Jumping Jacks',
                    'description'   => 'Cardiovaculra System, Full Body'

                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
