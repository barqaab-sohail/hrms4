<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\Asset\AssetStore;
use App\Http\Requests\Asset\ClassStore;
use App\Http\Requests\Asset\SubClassStore;
use App\Models\Asset\Asset;
use App\Models\Asset\AsClass;
use App\Models\Asset\AsSubClass;
use App\Models\Asset\AsDocumentation;
use DB;
use Storage;

class AssetController extends Controller
{
    
    public function index(){
        $assets = Asset::all();
        return view ('asset.index', compact('assets'));
    }

    public function create(){
    	session()->put('asset_id', '');
    	$asClasses = AsClass::all();
    	$asSubClasses = AsSubClass::all();
        
    	return view ('asset.create', compact('asClasses','asSubClasses'));
    }

    public function store (AssetStore $request){

    	$input = $request->all();
    	  
        $asset='';
    	DB::transaction(function () use ($input, $request, &$asset) {  
            $today = \Carbon\Carbon::today();

            $asset=Asset::create($input);
            
            //add image
                $extension = request()->document->getClientOriginalExtension();
                $fileName = time().'.'.$extension;
                $folderName = "asset/".$asset->id."/";
                //store file
                $request->file('document')->storeAs('public/'.$folderName,$fileName);
                
                $file_path = storage_path('app/public/'.$folderName.$fileName);

                $attachment['description']='image';
                $attachment['file_name']=$fileName;
                $attachment['size']=$request->file('document')->getSize();
                $attachment['path']=$folderName;
                $attachment['extension']=$extension;
                $attachment['asset_id']=$asset->id;

            AsDocumentation::create($attachment);
    		
    	}); // end transcation
    	return response()->json(['url'=> route("asset.edit",$asset),'message' => 'Data Successfully Saved']);
    }

    public function edit(Request $request, $id){
    	session()->put('asset_id', $id);
    	$asClasses = AsClass::all();
    	$asSubClasses = AsSubClass::all();
    	$data = Asset::find($id);

        if($request->ajax()){      
            return view ('asset.ajax', compact('asClasses','asSubClasses','data'));   
        }else{
            return view ('asset.edit', compact('asClasses','asSubClasses','data'));       
        }

    	


    }


    public function update (AssetStore $request, $id){

         $input = $request->all();

        DB::transaction(function () use ($input, $request, $id) {  
            $today = \Carbon\Carbon::today();
            
            Asset::findOrFail($id)->update($input);

            //Edit image
            if ($request->hasFile('document')){

                $extension = request()->document->getClientOriginalExtension();
                $fileName = time().'.'.$extension;
                $folderName = "asset/".$id."/";
                //store file
                $request->file('document')->storeAs('public/'.$folderName,$fileName);
                
                $file_path = storage_path('app/public/'.$folderName.$fileName);

                $attachment['description']='image';
                $attachment['file_name']=$fileName;
                $attachment['size']=$request->file('document')->getSize();
                $attachment['path']=$folderName;
                $attachment['extension']=$extension;
                $attachment['asset_id']=$id;

                $asDocumentation = AsDocumentation::where('asset_id',$id)->first();

                if($asDocumentation){
                    $oldDocumentPath =  $asDocumentation->path.$asDocumentation->file_name;
                    AsDocumentation::findOrFail($asDocumentation->id)->update($attachment);

                    if(File::exists(public_path('storage/'.$oldDocumentPath))){
                        File::delete(public_path('storage/'.$oldDocumentPath));
                    }
                    
                }else{
                    AsDocumentation::create($attachment);
                }
               
            }
            
        }); // end transcation

        return response()->json(['status'=> 'OK', 'message' => "Data Successfully Updated"]);

    }




     public function destroy($id)
    {
        $asDocuments = AsDocumentation::where('asset_id',$id)->get();
        foreach ($asDocuments as $asDocument) {
            $path = public_path('storage/'.$asDocument->path.$asDocument->file_name);
                if(File::exists($path)){
                  File::delete($path);
                }  
        }
        Asset::findOrFail($id)->delete();   

    return back()->with('success', "Data successfully deleted");
   
    }

    public function getSubClasses($id){

    	$as_sub_classes = DB::table("as_sub_classes")
	                ->where("as_class_id",$id)
	                ->pluck("name","id");
	    
	    return response()->json($as_sub_classes);


    }

    public function asCode($asSubClass){

        $asSubClass = AsSubClass::where('id',$asSubClass)->first();


        $count = 1;
       // $code = $code.'0'; //200
        $asCode =  $asSubClass->as_class_id.'-'. $asSubClass->id.'-';
       // $asCode = $asCode.$count;

        while(Asset::where('asset_code',$asCode.$count)->count()>0){ 
            $count++;  
        }
        $asCode = $asCode.$count;

        return response()->json([ 'assetCode'=>$asCode]);
    }

     public function storeClass (ClassStore $request){
        $newClass = preg_replace('/[^A-Za-z0-9\- ]/', '', $request->name);
        $class = AsClass::where('name', $newClass)->first();
       
        if($class == null){
            
             DB::transaction(function () use ($request, $newClass) {  

                 AsClass::create(['name'=>$newClass]);

            }); // end transcation   

            $classes = DB::table("as_classes")->orderBy('id')
                ->pluck("id","name");
        
            return response()->json(['classes'=> $classes, 'message'=>"$newClass Successfully Entered"]);
        }else{

            return response()->json(['classes'=> '', 'message'=>"$newClass is already entered"]);
           
        }
    }

     public function storeSubClass (SubClassStore $request){
        $newSubClass = preg_replace('/[^A-Za-z0-9\- ]/', '', $request->name);
        $subClass = AsSubClass::where('as_class_id',$request->as_class_id)->where('name', $newSubClass)->first();
       
        if($subClass == null){
            
             DB::transaction(function () use ($request, $newSubClass) {  

                 AsSubClass::create(['name'=>$newSubClass, 'as_class_id'=>$request->as_class_id]);

            }); // end transcation   

            $subClasses = DB::table("as_sub_classes")->where('as_class_id',$request->as_class_id)->orderBy('id')
                ->pluck("id","name");
        
            return response()->json(['subClasses'=> $subClasses, 'message'=>"$newSubClass Successfully Entered"]);
        }else{

            return response()->json(['subClasses'=> '', 'message'=>"$newSubClass is already entered"]);
           
        }
      
        
    }
}
