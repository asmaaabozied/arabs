<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name'=>'unPayed', // when the employer creates the task and doesn't have enough money to pay for it
            ],
            [
                'name'=>'pending', // When the task is created and paid for, it stays in this status waiting for the admin approval

            ],
            [
                'name'=>'active', // When approved by the manager and ready to receive requests for completion, workers in this case can complete the task assigned to them individually

            ],
//            [
//                'name'=>'taskInProgress', //When the task is in progress after all workers have accepted the task
//            ],

            [
                'name'=>'completed', // When it is done by the all workers

            ],
//            [
//                'name'=>'employerVerifiedWork', //When it is completed and verified the employer
//
//            ],
//            [
//                'name'=>'adminVerifiedWork', //When it is verified by employer and verified by the admin
//
//            ],
//            [
//                'name'=>'employerRejectedWork', //When it is "not accepted" by employer
//
//            ],
//            [
//                'name'=>'adminRejectedWork', //When it is "not accepted" by admin
//
//            ],
            [
                'name'=>'adminRefusalTask', //When the admin Refusal the task because it contains immoral content or contrary to the platform policy, or for any other reason he deems

            ],


        ];
        foreach ($statuses as $status){
            Status::create($status);
        }
    }
}
