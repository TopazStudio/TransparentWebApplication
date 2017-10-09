<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/4/17
 * Time: 4:04 PM
 */

namespace App\Services\Company;


use App\Model\Document;
use App\Util\CRUD\HandlesCRUD;
use Illuminate\Http\Request;
use Storage;

class DocumentService
{
    use HandlesCRUD;

    //TODO: allow uploading more than one file.

    protected $docPath = 'docs/companies';

    /**
     * Used to update a Cuisine owned by the current user,
     *
     * @param Request $request
     * @internal Model $model
     * @return bool
     */
    public function add(Request $request){
        if($request->file('doc')->isValid()){
            $this->errors['file_upload']['doc'] = 'Upload_unsuccessful';
            return empty($this->errors);
        }

        $path = $this->docPath . '/' . $request->companyId;
        $request->file('doc')->store($path);

        $model = Document::create([
            'location' => $path,
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->file('doc')->getClientOriginalExtension(),
            'size' => $request->file('doc')->getClientSize(),
            'companyId' => $request->companyId,
            'userId' => $request->userId,
        ]);

        if($model){
            $this->info['added'][] = $model->id;
        }else{
            $this->errors['Add']['Add Failed'] = $model->id;
        }

        return empty($this->errors);
    }


    /**
     * Used to update a Cuisine owned by the current user,
     *
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function update(Request $request,$id){
        if($request->file('doc')->isValid()){
            $this->errors['file_upload']['doc'] = 'Upload_unsuccessful';
            return empty($this->errors);
        }

        if($model = $this->getModelAccordingToParent($request,$id)) {
            Storage::delete($model->location);

            $path = $this->docPath . '/' . $request->companyId;
            $request->file('doc')->store($path);

            if ($model->update([
                'location' => $path,
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->file('doc')->getClientOriginalExtension(),
                'size' => $request->file('doc')->getClientSize(),
            ])) {
                $this->info['updated'] = $id;
            } else {
                $this->errors['Update']['Not Updated'] = $id;
            }
        }

        return empty($this->errors);
    }

    public function afterDelete($request,$model){
        //delete document from file system
        Storage::delete($model->location);
        return true;
    }



}