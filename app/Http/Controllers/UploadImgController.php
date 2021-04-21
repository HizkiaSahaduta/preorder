<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class UploadImgController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){

        $userid = Session::get('USERNAME');
        $checkCreatedBy = DB::table('order_book_hdr')
                            ->where('book_id','=', $id)
                            ->first();

        Session::put('book_id_temp', $id);
        return view('layouts.UploadImg',[
                    'userid' => $userid,
                    'checkCreatedBy' => $checkCreatedBy->user_id
                    ]);

    }

    public function upload(Request $request){

        $book_id = trim(Session::get('book_id_temp'));


        if($book_id){

            $image = $request->file('file');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('img/upload/'), $imageName);

            $checkExistImage = DB::table('image_path')
                                ->where('tr_id','=', $book_id)
                                ->where('user_id','=', Session::get('USERNAME'))
                                ->first();


            if($checkExistImage)
            {


                $seqNum = DB::table('image_path')
                        ->select('tr_seq')
                        ->where('user_id', '=', Session::get('USERNAME'))
                        ->where('tr_id', '=', $book_id)
                        ->max('tr_seq');

                DB::table('image_path')
                    ->insert([
                    'mill_id' => 'SR',
                    'tr_id' => $book_id,
                    'appl_id' => 'CUST.ORDER',
                    'tr_seq' => $seqNum + 1,
                    'origin_name' => $imageName,
                    'img_path' => 'img/upload/'.$imageName,
                    'user_id' => Session::get('USERNAME')
                    ]);
            }
            else
            {
               DB::table('image_path')
                    ->insert([
                    'mill_id' => 'SR',
                    'tr_id' => $book_id,
                    'appl_id' => 'CUST.ORDER',
                    'tr_seq' => 1,
                    'origin_name' => $imageName,
                    'img_path' => 'img/upload/'.$imageName,
                    'user_id' => Session::get('USERNAME')
                    ]);
            }

            $saveImageHdr = DB::table('order_book_hdr')
                            ->where('user_id','=', Session::get('USERNAME'))
                            ->where('book_id','=', $book_id)
                            ->update(['image' => 'Y']);


            return response()->json(['response' => "Success ".$image]);
        }
        else{

            return response()->json(['response' => "Error ".$image]);
        }

    }

    public function fetch(){

        $book_id = trim(Session::get('book_id_temp'));


        $tr_id = DB::table('image_path')
                    ->select('tr_id')
                    ->where('tr_id','=', $book_id)
                    ->Value('tr_id');

        $Images = DB::table('image_path')
                            ->where('tr_id','=', $book_id)
                            //->where('user_id','=', Session::get('USERNAME'))
                            ->get();


        if ($tr_id) {

            $output = '';

            foreach($Images as $Image){

                $output .= 
                '
                    
                    <figure class="col-md-4">
                        
                        <a href="'.asset('img/upload/' . $Image->origin_name).'" title="Image of '.$book_id.'-'.$Image->tr_seq.'">
                            <img src="'.asset('img/upload/' . $Image->origin_name).'" class="img-fluid">
                        </a>
                        
                        <button class="btn btn-outline-danger btn-block remove_image" id="'.$Image->origin_name.'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            Remove
                        </button>
    
                    </figure>
                    
        
                ';
    
            }
    
            echo $output;
            
        }

        else {

            $output = '<span class="shadow-none badge badge-danger">No photos have been uploaded yet</span>';

            echo $output;

        }

        
    }

    public function delete(Request $request){


        $book_id = trim(Session::get('book_id_temp'));
        $img = $request->get('name');

        if($img){

            \File::delete(public_path('img/upload/' .$img));

            $delete = DB::table('image_path')
                        ->where('tr_id','=', $book_id)
                        ->where('user_id','=', Session::get('USERNAME'))
                        ->where('origin_name',$img)
                        ->delete();

            $checkExistImage = DB::table('image_path')
                            ->where('tr_id','=', $book_id)
                            ->where('user_id','=', Session::get('USERNAME'))
                            ->first();

            if(!$checkExistImage){

                $saveImageHdr = DB::table('order_book_hdr')
                                    ->where('user_id','=', Session::get('USERNAME'))
                                    ->where('book_id','=', $book_id)
                                    ->update(['image' => 'N']);

                return response()->json(['response' => "Image deleted"]);
            }
            else{

                return response()->json(['response' => "Image deleted"]);
            }
        }
    }
}
