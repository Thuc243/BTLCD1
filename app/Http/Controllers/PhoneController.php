<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhoneController extends Controller
{

public static $phones = [

["id"=>1,"name"=>"iPhone 15","price"=>25000000,"image"=>"iphone.jpg"],
["id"=>2,"name"=>"Samsung S24","price"=>22000000,"image"=>"samsung.jpg"]

];

public function index()
{
$phones=self::$phones;
return view('phones.index',compact('phones'));
}

public function create()
{
return view('phones.create');
}

public function store(Request $request)
{

$imageName = time().'.'.$request->image->extension();

$request->image->move(public_path('images'),$imageName);

$newPhone=[
"id"=>count(self::$phones)+1,
"name"=>$request->name,
"price"=>$request->price,
"image"=>$imageName
];

self::$phones[]=$newPhone;

return redirect('/phones');

}

public function edit($id)
{

foreach(self::$phones as $p)
{
if($p['id']==$id)
{
$phone=$p;
}
}

return view('phones.edit',compact('phone'));

}

}