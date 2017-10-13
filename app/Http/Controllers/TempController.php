<?php
/**
 * Created by PhpStorm.
 * User: erick
 * Date: 10/13/17
 * Time: 12:30 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class TempController extends Controller
{


   public function storeTempPic(Request $request){
       $path = 'public/temp';

       $fileName = explode('.',$request->file('tempImage')->getClientOriginalName());
       $extension = $request->file('tempImage')->getClientOriginalExtension();

       //filename to store
       $fileNameToStore = $fileName[0] . '_' . time() .'.'. $extension;

       $request->file('tempImage')->storeAs($path,$fileNameToStore);

       return $this->successResponse(['location'=>$path . '/' .$fileNameToStore]);
   }
}