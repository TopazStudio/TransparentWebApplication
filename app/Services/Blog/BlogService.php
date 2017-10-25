<?php

namespace App\Services\Blog;


use App\Model\CompanyRelatedBlog;
use App\Model\Taggable;
use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;
use App\Util\CRUD\HandlesGraphQLCRUD;
use Illuminate\Http\Request;

class BlogService implements CRUDService
{
    use HandlesCRUD,HandlesGraphQLCRUD;

    public function getModelType()
    {
        return 'App\Model\Blog';
    }

    private function addCompaniesAbout(Request $request,$model){
        foreach ($request->companiesAbout as $about){
            $rel = CompanyRelatedBlog::create([
                'blogId' => $model->id,
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
                'taggable_type' => 'blogTag'
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
        $companiesAbout = CompanyRelatedBlog::Where('blogId','=',$model->id)->get();
        $tags = Taggable::Where('taggable_id','=',$model->id)
            ->Where('taggable_type','=','blogTag')
            ->get();

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