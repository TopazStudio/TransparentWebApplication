<?php

namespace App\Util\CRUD;


use App\Model\Picture;
use Illuminate\Http\Request;

trait HandlesImages
{

    protected $picType = 'defaultPic';

    protected $picPath = 'public/defaultPic';

    public function handleImage(Request $request,$id){
        $fileName = explode('.',$request->file($this->picType)->getClientOriginalName());
        $extension = $request->file($this->picType)->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = $fileName[0] . '_' . time() .'.'. $extension;

        $request->file($this->picType)->storeAs($this->picPath,$fileNameToStore);

        Picture::create([
            'location' => $fileNameToStore,
            'picturable_id' => $id,
            'picturable_type' => $this->picType
        ]);
    }

    public function defaultImage($id){
        Picture::create([
            'location' => 'placeHolder.jpg',
            'picturable_id' => $id,
            'picturable_type' => $this->picType
        ]);
    }
}