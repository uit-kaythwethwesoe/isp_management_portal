<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use App\Language;
use Mews\Purifier\Facades\Purifier;
use Session;

class BranchController extends Controller
{
   public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function branch(Request $request){
        $langCode = $request->language ?? $this->lang->code;
        $lang = Language::where('code', $langCode)->first();
        if (!$lang) {
            $lang = $this->lang;
        }
        $langId = $lang->id;
   
        $branchs = Branch::where('language_id', $langId)->orderBy('id', 'DESC')->get();
        return view('admin.branch.index', compact('branchs'));
    }

    // Add Branch
    public function add(){
        return view('admin.branch.add');
    }

    // Store Branch
    public function store(Request $request){

        $request->validate([
            'iframe' => 'required',
            'branch_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $branch = new Branch();
        $branch->language_id = $request->language_id;
        $branch->iframe = $request->iframe;
        $branch->branch_name = $request->branch_name;
        $branch->manager = $request->manager;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->address = $request->address;
        $branch->save();

        $notification = array(
            'messege' => 'Branch Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Branch Delete
    public function delete($id){

        $branch = Branch::find($id);
        $branch->delete();

        return back();
    }

    // Branch Edit
    public function edit($id){

        $branch = Branch::find($id);
        return view('admin.branch.edit', compact('branch'));

    }

    // Update Branch
    public function update(Request $request, $id){

        $id = $request->id;
         $request->validate([
            'iframe' => 'required',
            'branch_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $branch = Branch::find($id);

        $branch->update($request->all());
        $branch->language_id = $request->language_id;
        $branch->iframe = $request->iframe;
        $branch->branch_name = $request->branch_name;
        $branch->manager = $request->manager;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->address = $request->address;
        $branch->save();

        $notification = array(
            'messege' => 'Branch Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.branch').'?language='.$this->lang->code)->with('notification', $notification);;
    }

}