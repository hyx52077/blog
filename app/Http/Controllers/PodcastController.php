<?php

namespace App\Http\Controllers;
use App\Jobs\ProcessPodcast;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\user;
class PodcastController extends Controller
{
    use DispatchesJobs;
    //

    /**
     * Store a new podcast.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request,$id)
    {
        // Create podcast...
        $user = User::findOrFail($id);
        $this->dispatch(new ProcessPodcast($user));
    }

    public function sendReminderEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->dispatch(new SendReminderEmail($user));
    }

}
