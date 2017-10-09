<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/2/17
 * Time: 12:35 PM
 */

namespace App\Services\Topic;

use App\Model\CompanyRelatedTopic;
use App\Model\Taggable;
use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;
use Illuminate\Http\Request;

class TopicService implements CRUDService
{
    use HandlesCRUD;

    public function getModelType()
    {
        return 'App\Model\Topic';
    }

    private function addCompaniesAbout(Request $request,$model){
        //TODO: check if company exist. We can capture an integrity error.

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
    }

    private function addTags(Request $request,$model){
        foreach ($request->tags as $tag){
            $rel = Taggable::create([
                'tag_id' => $tag,
                'taggable_id' => $model->id,
                'taggable_type' => 'topicTag'
            ]);
            if($rel){
                $this->info['added'][] = $rel->id;
            }
            else
                $this->errors['Add']['Add Failed'][] = $model->id;
        }
    }

    public function afterCreate($request,$model){
        $this->addCompaniesAbout($request,$model);
        $this->addTags($request,$model);
        return true;
    }

    public function afterUpdate($request,$model){
        $companiesAbout = CompanyRelatedTopic::Where('topicId','=',$model->id)->get();
        $tags = Taggable::Where('taggable_id','=',$model->id)
            ->Where('taggable_type','=','topicTag')
            ->get();

        //TODO: make frontend confirm changes to companies about to reduce queries to database.
        foreach ($companiesAbout as $companyAbout){
            if ($companyAbout->delete()) {
                $this->info['deleted'][] = $companyAbout->id;
            } else {
                $this->errors['Delete']['Delete Failed'][] = $companyAbout->id;
            }
        }
        foreach ($tags as $tag){
            if ($tag->delete()) {
                $this->info['deleted'][] = $tag->id;
            } else {
                $this->errors['Delete']['Delete Failed'][] = $tag->id;
            }
        }

        $this->addCompaniesAbout($request,$model);
        $this->addTags($request,$model);
        return true;
    }
}