<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Validation\ValidationException;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

class NewsletterController extends Controller
{
    /**
     * @param Newsletter $newsletter
     * @return Redirector|RedirectResponse
     * @throws BindingResolutionException
     * @throws ValidationException
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email coud not be added to our newsletter list.'
            ]);
        }


        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }
}
