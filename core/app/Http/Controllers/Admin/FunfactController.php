<?php

namespace App\Http\Controllers\Admin;

use App\Funfact;
use App\Language;
use App\Sectiontitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunfactController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function funfact(Request $request){
        $lang = Language::where('code', $request->language)->first()->id;

        $funfacts = Funfact::where('language_id', $lang)->orderBy('id', 'DESC')->get();
        $saectiontitle = Sectiontitle::where('language_id', $lang)->first();

        return view('admin.funfact.index', compact('funfacts', 'saectiontitle'));
    }

    public function add(){
        return view('admin.funfact.add');
    }

    public function store(Request $request){

      
        $request->validate([
            'icon' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required|max:255',
            'value' => 'required',
        ]);

        $funfact = new Funfact();

        if($request->hasFile('icon')){
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $icon);

            $funfact->icon = $icon;
        }
        

        $funfact->language_id = $request->language_id;
        $funfact->name = $request->name;
        $funfact->value = $request->value;
        $funfact->save();

        $notification = array(
            'messege' => 'Funfact Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function edit($id){

        $funfact = Funfact::find($id);
        return view('admin.funfact.edit', compact('funfact'));

    }

    public function update(Request $request, $id){


        $funfact = Funfact::findOrFail($id);

         $request->validate([
            'icon' => 'mimes:jpeg,jpg,png',
            'name' => 'required|max:255',
            'value' => 'required',
        ]);

        if($request->hasFile('icon')){
            @unlink('assets/front/img/'. $funfact->icon);
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $icon);

            $funfact->icon = $icon;
        }

        $funfact->language_id = $request->language_id;
        $funfact->name = $request->name;
        $funfact->value = $request->value;
        $funfact->save();

        $notification = array(
            'messege' => 'Funfact Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.funfact').'?language='.$this->lang->code)->with('notification', $notification);
    }

    public function delete($id){

        $funfact = Funfact::find($id);
        @unlink('assets/front/img/'. $funfact->icon);
        $funfact->delete();

        return back();
    }

    public function funfactcontent(Request $request, $id){
        
        $request->validate([
            'funfact_bg' => 'mimes:jpeg,jpg,png',
        ]);

        $funfact_title = Sectiontitle::where('language_id', $id)->first();

        if($request->hasFile('offer_image')){
            @unlink('assets/front/img/'. $funfact_title->funfact_bg);
            $file = $request->file('offer_image');
            $extension = $file->getClientOriginalExtension();
            $funfact_bg = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $funfact_bg);

            $funfact_title->funfact_bg = $funfact_bg;
        }

        $funfact_title->save();

        $notification = array(
            'messege' => 'Funfact Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.funfact').'?language='.$this->lang->code)->with('notification', $notification);
    }

}
