<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\StudySession;
use App\UserClass;
use App\User;

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
        $this->studySession = $studySession 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sessions = StudySession::join('user_classes','user_classes.class_id', '=', $study_sessions->class_id')
                        ->where('users_classes.user_id', 'user.id')
                        ->where('user_classes.priority', '=', 1)->get();

    }
}
