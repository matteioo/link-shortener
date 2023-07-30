<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class LinkController extends Controller
{

    /**
     * Redirect to the URL.
     */
    public function redirectToUrl(string $identifier, Request $request)
    {
        $link = Link::where('identifier', $identifier)->first();

        sleep(5);

        if (!is_null($link) && $link->expires_at > now()) {
            // Link is password protected
            if (!is_null($link->password)) {

                if (!$request->has('password')) {
                    // No password provided, show password form
                    return inertia('Links/EnterPassword', [
                        'identifier' => $link->identifier,
                    ]);
                } else {
                    // Password provided, check if it's valid
                    if (Crypt::decryptString($link->password) !== $request->password) {
                        return back()->withErrors(['password' => 'Password is not correct.'])->withInput();
                    }
                }
            }

            $link->clicks++;
            $link->save();

            return Inertia::location($link->url);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Links/Index', [
            'links' => LinkResource::collection(
                Link::with('user')
                    ->where('user_id', auth()->user()->getAuthIdentifier())
                    ->where('expires_at', '>', now())
                    ->get()),
        ]);
    }

    public function details(string $identifier)
    {
        $link = Link::where('identifier', $identifier)->first();

        if (is_null($link)) {
            return redirect()->route('home')->with('error', 'Link not found.')->setStatusCode(404);
        }

        return inertia('Links/Details', [
            'link' => new LinkResource($link),
        ]);
    }

    /**
     * Store a new link.
     *
     * @throws ValidationException if validation fails
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => ['required', 'url'],
            'duration' => ['integer', 'min:1', 'max:31'],
            'password' => ['nullable', 'string', 'min:4', 'max:255', 'confirmed'],
        ]);

        $duration = 7;
        $length = 6;
        $userId = null;
        $password = null;

        if (!is_null(auth()->user())) {
            $duration = $request->duration ?? 7;
            $length = 4;
            $userId = auth()->user()->getAuthIdentifier();

            if ($request->has('password') && !is_null($request->password)) {
                $password = Crypt::encryptString($request->password);
            }
        } else {
            // Guest user: loading times throttled to prevent mass creation of links
            sleep(3);
        }

        $createdLink = new Link([
            'url' => $request->url,
            'duration' => $duration,
            'password' => $password,
        ]);


        $createdLink->setIdentifierLength($length);
        $createdLink->setAttribute('user_id', $userId)->save();

        if (is_null(auth()->user())) {
            return inertia()->location(route('link.redirect.details', $createdLink->identifier));
        }

        return back();
    }
}
