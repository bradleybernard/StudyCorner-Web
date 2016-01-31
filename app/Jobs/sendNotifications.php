<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\StudySession;
use App\UserClass;
use App\User;
use PushNotification;

class sendNotifications extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $studySession;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(StudySession $studySession)
    {
        $this->studySession = $studySession;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $columns = [
            'users.device_token', 'study_sessions.title', 'study_sessions.time_start', 'study_sessions.location',
            'study_sessions.going_count', 'users.cruz_id', 'classes.class_name',
        ];

        $justPassed = StudySession::join('user_classes','user_classes.class_id', '=', 'study_sessions.class_id')
                        ->join('users','user_classes.user_id','=','users.id')
                        ->join('classes', 'classes.id', '=', 'user_classes.class_id')
                        ->where('user_classes.priority', '1')
                        ->where('study_sessions.id', $this->studySession->id)
                        ->select($columns)->get();

        $devs = [];

        foreach($justPassed as $user) 
        {
            $devs[] = PushNotification::Device($user->device_token);
        }

        $readableTime = date('g:i A', strtotime($user->time_start));

        $message = PushNotification::Message('There is a new ' . $user->class_name . ' session starting at ' . $readableTime . ' in ' . $user->location . '.');


        $collection = PushNotification::app('StudyCorner')
            ->to(PushNotification::DeviceCollection($devs))
            ->send($message);
    }
}
