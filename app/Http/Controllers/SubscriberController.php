<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Resources\SubscriberCollection;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SubscriberCollection(Subscriber::latest()->get()->load('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriberRequest
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriberRequest $request)
    {
        $validated = $request->validated();
        $subscriber = Subscriber::create($validated);
        $subscriber->fields()->createMany($validated['fields']);

        return response()->json([
            'message' => 'Subscriber has been successfully created.',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriberRequest
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubscriberRequest $request, Subscriber $subscriber)
    {
        $validated = $request->validated();
        $subscriber->update($validated);
        $fieldsToUpdate = collect($validated['fields'])->filter(fn ($field) => isset($field['id']))->values()->all();
        $fieldsToCreate = collect($validated['fields'])->filter(fn ($field) => ! isset($field['id']))->values()->all();
        $subscriber->fields()->upsert($fieldsToUpdate, ['id'], ['title', 'type']);
        $subscriber->fields()->createMany($fieldsToCreate);

        return response()->json([
            'message' => 'Subscriber has been successfully updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return response()->json([
            'message' => 'Subscriber has been successfully deleted.',
        ]);
    }
}
