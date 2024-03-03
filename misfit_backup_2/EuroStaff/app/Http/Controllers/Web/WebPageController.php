<?php

namespace App\Http\Controllers\Web;

use App\Events\SendContactEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class WebPageController extends Controller
{
    public function home()
    {
        return view('web.home');
    }

    public function jobs()
    {
        return view('web.jobs');
    }

    public function company()
    {
        return view('web.company');
    }

    public function pages()
    {
        return view('web.pages');
    }

    public function blogs()
    {
        return view('web.blogs');
    }

    public function contact()
    {
        return view('web.contact_us');
    }

    public function sendContactEmail(ContactRequest $request)
    {
        try {
            $name = $request->con_name;
            $email = $request->con_email;
            $message = $request->con_message;

            event(new SendContactEmailEvent($name, $email, $message));

            return redirect('/contact');
        } catch (Exception $e) {
            Log::error($e);
            // return $this->error($e->getMessage(), $e->getTrace(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
