<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/3/17
 * Time: 7:29 PM
 */

namespace App\Services\Blog;


use App\Model\CompanyRelatedBlog;
use App\Util\CRUD\CRUDService;
use App\Util\CRUD\HandlesCRUD;

class BlogService implements CRUDService
{
    use HandlesCRUD;

    public function getModelType()
    {
        return 'App\Model\Blog';
    }

    public function afterCreate($request,$model){
        //Persist company blog relationship
        //TODO: check if blog exist.
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
        return true;
    }

    public function afterUpdate($request,$model){
        $companiesAbout = CompanyRelatedBlog::Where('blogId','=',$model->id)->get();

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
        return true;
    }
}