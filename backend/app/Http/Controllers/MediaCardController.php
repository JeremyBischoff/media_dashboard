<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\MediaCard;
use App\Http\Resources\MediaCardResource;

class MediaCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # Eloquent ORM call to get all media cards
        $media_cards = MediaCard::all();
        # Resource formats the response
        return MediaCardResource::collection($media_cards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Unpack the request
        $media_title = $request->input('media_title');
        $entry_title = $request->input('entry_title');
        $entry_author = $request->input('entry_author');
        $entry_url = $request->input('entry_url');

        # Eloquent ORM call to create a new media card
        $media_card = MediaCard::create([
            'media_title' => $media_title,
            'entry_title' => $entry_title,
            'entry_author' => $entry_author,
            'entry_url' => $entry_url,
        ]);

        # Resource formats the response
        return new MediaCardResource($media_card);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        # Eloquent ORM call to get a media card by id
        $media_card = MediaCard::findOrFail($id);

        # Resource formats the response
        return new MediaCardResource($media_card);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        # Unpack the request
        $media_title = $request->input('media_title');
        $entry_title = $request->input('entry_title');
        $entry_author = $request->input('entry_author');
        $entry_url = $request->input('entry_url');

        # Eloquent ORM call to update a media card by id
        MediaCard::where('id', $id)->update([
            'media_title' => $media_title,
            'entry_title' => $entry_title,
            'entry_author' => $entry_author,
            'entry_url' => $entry_url,
        ]);

        # Eloquent ORM call to get the updated media card
        $media_card = MediaCard::findOrFail($id);

        # Resource formats the response
        return new MediaCardResource($media_card);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        # Eloquent ORM call to delete a media card by id
        $media_card = MediaCard::findOrFail($id);
        $media_card->delete();

        # Return a 204 No Content response if the media card is deleted
        return response()->json(null, 204);
    }
}
