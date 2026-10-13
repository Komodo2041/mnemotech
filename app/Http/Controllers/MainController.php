<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

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

    public function test($v, $nr, Request $req)
    {

        $save =  $req->input('save');
        if ($save) {
            $chc = $req->input("chc");
            $goods = Crypt::decrypt($chc);
            $values = $req->input("val");
            $res = 0;
            $anno = [];
            foreach ($goods as $key => $value) {
                if ($v == 1) {
                    if (strtolower($value) == strtolower($values[$key])) {
                        $res++;
                        $anno[$key] = 1;
                    } else {
                        $anno[$key] = 0;
                    }
                } elseif ($v == 2) {
                    if ($value == $values[$key]) {
                        $res++;
                        $anno[$key] = 1;
                    } else {
                        $anno[$key] = 0;
                    }
                }
            }

            return view("test", ["op" => 2, "goods" => $goods, "values" => $values, "v" => $v, "nr" => $nr, "anno" => $anno, "res" => $res]);
        } else {
            if ($v == 1) {
                $words = Mnemo::inRandomOrder()->take($nr)->get()->pluck("name", "id")->toArray();
            } elseif ($v == 2) {
                $words = Mnemo::inRandomOrder()->take($nr)->get()->pluck("id", "name")->toArray();
            }

            $list = [];
            $goods = [];
            foreach ($words as $key => $value) {
                $list[] = $key;
                $goods[] = $value;
            }
            $chc = Crypt::encrypt($goods);
            return view("test", ["v" => $v, "nr" => $nr, "chc" => $chc, "list" =>   $list, "op" => 1]);
        }
    }
}
