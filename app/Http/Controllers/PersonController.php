<?php

namespace App\Http\Controllers;

use App\Http\Requests\Person\PersonStoreRequest;
use App\Http\Requests\Person\PersonUpdateRequest;
use App\Models\Person;
use App\Services\PersonService;
use Cassandra\Exception\InvalidQueryException;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PersonService $personService)
    {
        return (view('basic.index', ['people' => $personService->getAll()]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonStoreRequest $request, PersonService $personService)
    {
        //If the order and the name of the person is found within trashed items it would be restored.
        //however I could not find a way around the store request in a proper fashion yet.

//        $trashed = Person::onlyTrashed()->where(['name'=> $request->input('name'), 'order'  => $request->input('order')])->get();
//        if($trashed->isNotEmpty()){
//            dd($trashed);
//        }else{
        $personService->add($request);
//        }
        return redirect(route('people.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Person $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Person $person
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PersonService $personService)
    {
        $person = $personService->getById($id);

        return view('basic.edit', ['person' => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Person $person
     * @return \Illuminate\Http\Response
     */
    public function update($id, PersonUpdateRequest $request, PersonService $personService)
    {
        try {
            $personService->update($id, $request);
        } catch (InvalidQueryException $e) {
            dd($e);
        }
        return redirect(route('people.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Person $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PersonService $personService)
    {
        $personService->delete($id);
        return redirect(route('people.index'));
    }
}
