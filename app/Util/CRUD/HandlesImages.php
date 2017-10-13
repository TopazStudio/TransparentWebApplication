<?php

namespace App\Util\CRUD;


use App\Model\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HandlesImages
{

    /**
     * Type used to relate the Picture entity with another
     * entity.
     *
     * @var string
    */
    protected $picType = 'defaultPic';

    /**
     * Path used to fetch the picture from its location in the
     * public folder. NB: the path should not include 'public/'
     * as this is taken care of by the symbolic link setup for the storage.
     *
     * @var string
    */
    protected $picPath = 'defaultPic';

    /**
     * Store images uploaded through post in the request
     * in the public folder according to the path specified, the
     * store the location in the database using the Picture entity.
     *
     * @param Request $request - request containing the file to store.
     * @param int $id - Id of the model to associate the image with using the picType specified.
    */
    public function handleImage(Request $request,$id){
        $fileName = explode('.',$request->file($this->picType)->getClientOriginalName());
        $extension = $request->file($this->picType)->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = $fileName[0] . '_' . time() .'.'. $extension;

        //Store in public folder
        $request->file($this->picType)->storeAs('public/' . $this->picPath,$fileNameToStore);

        $path = $this->picPath . '/' . $fileNameToStore;

        Picture::create([
            'location' => $path,
            'picturable_id' => $id,
            'picturable_type' => $this->picType
        ]);
    }

    /**
     * Store the default image's location into the database using the
     * Picture entity according to the picType specified.
     *
     * @param int $id - Id of the model to associate the image with using the picType specified.
     */
    public function defaultImage($id){
        Picture::create([
            'location' => $this->picPath .'/'. 'placeHolder.jpg',
            'picturable_id' => $id,
            'picturable_type' => $this->picType
        ]);
    }

    /**
     * Move image that was in the temporary public location into
     * the specified location and store location into the database
     * using the Picture entity.
     *
     * @param Request $request - request carrying current location of image in the temp folder.
     * @param int $id - Id of the model to associate the image with using the picType specified.
     */
    public function saveImageFromTemp(Request $request,$id){
        //TODO: add errors
        $fileName = explode('/',$request->image);
        $path = $this->picPath .'/'. end($fileName);

        //Store in public folder
        Storage::move($request->image, 'public/'. $path);

        Picture::create([
            'location' => $path,
            'picturable_id' => $id,
            'picturable_type' => $this->picType
        ]);
    }
}