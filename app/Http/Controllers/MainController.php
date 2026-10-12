<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mnemo;

class MainController extends Controller
{
    public function start()
    {
        $mlist = Mnemo::orderBy("id", "ASC")->get();
        return view("main", ["mlist" => $mlist]);
    }

    public function add(Request $request)
    {
        $max = Mnemo::all()->max("id");
        if (!$max) {
            $max = 0;
        }
        $max++;

        $name = $request->input('name', "");
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("addmnemo", ["name" => $name, "max" => $max,  'errorforms' => implode(", ", $validated), "op" => 0]);
            } else {
                $validated = $validator->validated();
                Mnemo::create(["name" => $name]);
                return redirect("/");
            }
        }
        return view("addmnemo", ["name" => $name, "max" => $max, "op" => 0]);
    }

    public function edit($id, Request $request)
    {
        $mn = Mnemo::find($id);

        $max = $id;

        $name = $request->input('name', $mn->name);
        $save =  $request->input('save');
        if ($save) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                $validated = $validator->errors()->all();
                return view("addmnemo", ["name" => $name, "max" => $max,  'errorforms' => implode(", ", $validated), "op" => 1]);
            } else {
                $validated = $validator->validated();
                $mn->name = $name;
                $mn->save();
                return redirect("/");
            }
        }
        return view("addmnemo", ["name" => $name, "max" => $max, "op" => 1]);
    }
}
