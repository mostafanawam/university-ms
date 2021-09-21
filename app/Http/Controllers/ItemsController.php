<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Item;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ItemsController extends Controller
{

  public function itemlist()//get the list of items from DB
  {
    $items = Item::all();
    return view('admin.item',['items'=>$items]); //go to users page with users list
  }


    public function additem(Request $request)
    {

        $rules = [
          'name' => 'required|unique:items|',
          'MaterialQuantity' => 'required|numeric',
          ];
          $validator = Validator::make($request->all(),$rules);//check if all rule are true
          if ($validator->fails()) {//if rules are false
          			return redirect('admin/additem')//return to the page
          			->withInput()
          			->withErrors($validator);//send errors
          		}
              else{
                $data = $request->input();//get values from form
          try{
                    $item = new Item;//new Model
                    $item->name = $data['name'];//set values
                    $item->quantity =  $data['MaterialQuantity'];
                  //  $item->isAvailable=1;
                    $item->save();//insert values
            return redirect('admin/item')->with('status',"Item Inserted successfully");//redirect to users with success message
          }
          catch(Exception $e){
            return redirect('admin/additem')->with('failed',"Operation Failed");//fail if error
                }
              }
    }

    function deleteitem($id){//function to delete user
        $item= Item::find($id);//find if id passed in the url exist
        if(!$item){//if user not found
          return redirect('admin/item')->with('status',"Item Not Found");
        }//else if found
        $item->delete(); //delete user
          return redirect('admin/item')->with('status',"Item Deleted successfully");//redirect with success message
    }

}
