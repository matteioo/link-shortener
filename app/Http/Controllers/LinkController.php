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

        // TODO: Add visit counters to create statistics about the clicked links etc.

        if ($link) {
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
            'links' => LinkResource::collection(Link::with('user')->get()),
        ]);
    }
}
