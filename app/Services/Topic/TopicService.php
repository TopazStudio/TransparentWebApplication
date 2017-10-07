<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/2/17
 * Time: 12:35 PM
 */

namespace App\Services\Topic;

use App\Model\CompanyRelatedTopic;
use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;

class TopicService implements CRUDService
{
    use HandlesCRUD;

    public function getModelType()
    {
        return 'App\Model\Topic';
    }

    public function afterCreate($request,$model){
        //Persist company topic relationship
        //TODO: check if company exist.
        foreach ($request->companiesAbout as $about){
            $rel = CompanyRelatedTopic::create([
                'topicId' => $model->id,
                'companyId' => $about
            ]);
            if($rel){
                $this->info['added'][] = $rel->id;
            }
            else
                $this->errors['Add']['Add Failed'][] = $model->id;
        }
        return true;
    }

    public function afterUpdate($request,$model){
        $companiesAbout = CompanyRelatedTopic::Where('topicId','=',$model->id)->get();

        //Delete than recreate method
        foreach ($companiesAbout as $companyAbout){
            if ($companyAbout->delete()) {
                $this->info['deleted'][] = $companyAbout->id;
            } else {
                $this->errors['Delete']['Delete Failed'][] = $companyAbout->id;
            }
        }

        //Add new companies about
        foreach ($request->companiesAbout as $about){
            $rel = CompanyRelatedTopic::create([
                'topicId' => $model->id,
                'companyId' => $about
            ]);
            if($rel){
                $this->info['added'][] = $rel->id;
            }
            else
                $this->errors['Add']['Add Failed'][] = $model->id;
        }
        return true;
    }
}