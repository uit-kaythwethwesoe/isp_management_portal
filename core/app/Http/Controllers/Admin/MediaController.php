<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Language;
use App\Mediazone;
use App\Sectiontitle;
use Session;

class MediaController extends Controller
{
      public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function media(Request $request){
        $lang = Language::where('code', $request->language)->first()->id;

        $medias = Mediazone::where('language_id', $lang)->orderBy('id', 'DESC')->get();
        $saectiontitle = Sectiontitle::where('language_id', $lang)->first();
        return view('admin.media.index', compact('medias', 'saectiontitle'));
    }

    // Add Mediazone
    public function add(){
        return view('admin.media.add');
    }

    // Store Mediazone
    public function store(Request $request){

        $request->validate([
            'icon' => 'required|mimes:jpeg,jpg,png',
            'name' => 'required|max:150',
            'link' => 'required|max:150',
        ]);
        $media = new Mediazone();

        if($request->hasFile('icon')){
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $icon);
            $media->icon = $icon;
        }
      
     
        $media->name = $request->name;
        $media->language_id = $request->language_id;
        $media->status = $request->status;
        $media->link = $request->link;
        $media->save();

        $notification = array(
            'messege' => 'Mediazone Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Mediazone Delete
    public function delete($id){

        $media = Mediazone::find($id);
        @unlink('assets/front/img/'. $media->icon);
        $media->delete();

        return back();
    }

    // Mediazone Edit
    public function edit($id){

        $media = Mediazone::find($id);
        return view('admin.media.edit', compact('media'));

    }

    // Update Mediazone
    public function update(Request $request, $id){

        $id = $request->id;
         $request->validate([
            'name' => 'required|max:150',
            'icon' => 'mimes:jpeg,jpg,png',
            'link' => 'required|max:150',
        ]);

        $media = Mediazone::find($id);

        if($request->hasFile('icon')){
            @unlink('assets/front/img/'. $media->icon);
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $icon = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $icon);

            $media->icon = $icon;
        }

        $media->name = $request->name;
        $media->language_id = $request->language_id;
        $media->status = $request->status;
        $media->link = $request->link;
        $media->save();

        $notification = array(
            'messege' => 'Mediazone Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.media').'?language='.$this->lang->code)->with('notification', $notification);;
    }

    public function mediacontent(Request $request, $id){
       
        $request->validate([
            'media_zone_title' => 'required',
            'media_zone_subtitle' => 'required',
        ]);

        $media_title = Sectiontitle::where('language_id', $id)->first();

        $media_title->update($request->all());

        $notification = array(
            'messege' => 'Media Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.media').'?language='.$this->lang->code)->with('notification', $notification);
    }
}