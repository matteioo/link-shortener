<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    /**
     * Redirect to the URL.
     */
    public function redirectToUrl(string $identifier)
    {
        $link = Link::where('identifier', $identifier)->first();

        if ($link) {
            $link->clicks++;
            $link->save();

            return redirect()->away($link->url);
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
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => ['required', 'url'],
            'duration' => ['integer', 'min:1', 'max:31'],
        ]);

        $duration = 7;
        $length = 6;
        $userId = null;

        if (auth()->user()) {
            $duration = $request->duration ?? 7;
            $length = 4;
            $userId = auth()->user()->getAuthIdentifier();
        }

        $createdLink = new Link([
            'url' => $request->url,
            'duration' => $duration,
        ]);


        $createdLink->setIdentifierLength($length);
        //dd($createdLink);
        $createdLink->setAttribute('user_id', $userId)->save();
    }
}
