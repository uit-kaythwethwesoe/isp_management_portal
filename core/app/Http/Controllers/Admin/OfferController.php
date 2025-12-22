<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Language;
use App\Offerprovide;
use App\Sectiontitle;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
     public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function offer(Request $request){
        $lang = Language::where('code', $request->language)->first()->id;
     
        $offers = Offerprovide::where('language_id', $lang)->orderBy('id', 'DESC')->get();
        
        $saectiontitle = Sectiontitle::where('language_id', $lang)->first();
        
        return view('admin.offer.index', compact('offers', 'saectiontitle'));
    }

    // Add slider Category
    public function add(){
        return view('admin.offer.add');
    }

    // Store slider Category
    public function store(Request $request){

        $request->validate([
            'offer' => 'required|max:150',
        ]);

        $offer = new Offerprovide();
        $offer->language_id =  $request->language_id;
        $offer->status =  $request->status;
        $offer->offer =  Purifier::clean($request->offer);
        $offer->save();

        $notification = array(
            'messege' => 'Offer Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Delete
    public function delete($id){

        $offer = Offerprovide::find($id);
        $offer->delete();

        return back();
    }

    // slider Category Edit
    public function edit($id){

        $offer = Offerprovide::find($id);
        return view('admin.offer.edit', compact('offer'));

    }

    // Update slider Category
    public function update(Request $request, $id){

        $id = $request->id;
         $request->validate([
            'offer' => 'required|max:150',
        ]);

        $offer = Offerprovide::find($id);

        $offer->language_id =  $request->language_id;
        $offer->status =  $request->status;
        $offer->offer =  Purifier::clean($request->offer);
        $offer->save();

        $notification = array(
            'messege' => 'Offer Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.offer').'?language='.$this->lang->code)->with('notification', $notification);
    }

    public function offercontent(Request $request, $id){
        
        $request->validate([
            'offer_title' => 'required',
            'offer_subtitle' => 'required',
            'offer_image' => 'mimes:jpeg,jpg,png',
        ]);
        // dd($request->all());
        $offer_title = Sectiontitle::where('language_id', $id)->first();

        if($request->hasFile('offer_image')){
            @unlink('assets/front/img/'. $offer_title->offer_image);
            $file = $request->file('offer_image');
            $extension = $file->getClientOriginalExtension();
            $offer_image = time().rand().'.'.$extension;
            $file->move('assets/front/img/', $offer_image);

            $offer_title->offer_image = $offer_image;
        }

        $offer_title->offer_title = $request->offer_title;
        $offer_title->offer_subtitle = $request->offer_subtitle;
        $offer_title->save();

        $notification = array(
            'messege' => 'Offer Content Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.offer').'?language='.$this->lang->code)->with('notification', $notification);
    }

}