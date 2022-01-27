<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\CompanyProfileData;
use App\Listeners\UpdateCompanyProfileData;
use App\Events\CompanyDiagnosisDataEvent;
use App\Listeners\SetCompanyDiagnosisData;
use App\Events\StudentProfileData;
use App\Listeners\UpdateStudentProfileData;
use App\Events\StudentFutureDiagnosisData;
use App\Listeners\SetStudentFutureDiagnosisData;
use App\Events\StudentSelfDiagnosisData;
use App\Listeners\SetStudentSelfDiagnosisData;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CompanyProfileData::class => [
            UpdateCompanyProfileData::class,
        ],
        CompanyDiagnosisDataEvent::class => [
            SetCompanyDiagnosisData::class,
        ],
        StudentProfileData::class => [
            UpdateStudentProfileData::class,
        ],
        StudentFutureDiagnosisData::class => [
            SetStudentFutureDiagnosisData::class,
        ],
        StudentSelfDiagnosisData::class => [
            SetStudentSelfDiagnosisData::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
