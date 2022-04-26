<?php

namespace App\Services;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonService
{
    private $personModel;

    public function __construct(Person $personModel)
    {
        $this->personModel = $personModel;
    }

    public function getAll()
    {
        return $this->personModel->orderBy('order', 'ASC')->paginate(20);
    }


    public function update($id, Request $request)
    {
        $this->personModel = $this->personModel->find($id);
        $this->personModel->name = $request->input('name');
        $this->personModel->order = $request->input('order');
        $this->personModel->save();
    }

    public function getById($id)
    {
        return $this->personModel->find($id);
    }

    public function add(Request $request)
    {
        $this->personModel->name = $request->input('name');
        $this->personModel->order = $request->input('order');
        $this->personModel->saveOrFail();
    }

    public function delete(int $id)
    {
        $this->personModel->find($id)->delete();
    }
}
