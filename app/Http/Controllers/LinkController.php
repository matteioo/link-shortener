<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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

    /**
     * Store a new link.
     *
     * @throws ValidationException if validation fails
     */
    public function store(Request $request): void
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

        if (auth()->user()) {
            $duration = $request->duration ?? 7;
            $length = 4;
            $userId = auth()->user()->getAuthIdentifier();

            if ($request->has('password') && !is_null($request->password)) {
                $password = Crypt::encryptString($request->password);
            }
        }

        $createdLink = new Link([
            'url' => $request->url,
            'duration' => $duration,
            'password' => $password,
        ]);

        $createdLink->setIdentifierLength($length);
        $createdLink->setAttribute('user_id', $userId)->save();
    }
}
