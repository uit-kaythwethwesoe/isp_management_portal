<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Blog;
use App\Language;
use App\Bcategory;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BcategoryController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    public function bcategory(Request $request)
    {
        $langCode = $request->language ?? $this->lang->code;
        $lang = Language::where('code', $langCode)->first();
        if (!$lang) {
            $lang = $this->lang;
        }
        $langId = $lang->id;

        $bcategories = Bcategory::where('language_id', $langId)->orderBy('id', 'desc')->get();
        return view('admin.blog.blog-category.index', compact('bcategories'));
    }

    // Add Blog Category
    public function add()
    {
        return view('admin.blog.blog-category.add');
    }

    // Store Blog Category
    public function store(Request $request)
    {
        $slug = Helper::make_slug($request->name);
        $blogs = Bcategory::select('slug')->get();

        $request->validate([
            'name' => [
                'required',
                'unique:bcategories,name',
                'max:150',
                function ($attribute, $value, $fail) use ($slug, $blogs) {
                    foreach ($blogs as $blog) {
                        if ($blog->slug == $slug) {
                            return $fail('Title already taken!');
                        }
                    }
                }
            ],
            'status' => 'required',
        ]);

        $bcategory = new Bcategory();

        $bcategory->language_id = $request->language_id;
        $bcategory->name = $request->name;
        $bcategory->slug = $slug;
        $bcategory->status = $request->status;
        $bcategory->save();


        $notification = array(
            'messege' => 'Blog Category Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // Blog Category Delete
    public function delete($id)
    {

        $bcategory = Bcategory::find($id);
        $blogs = Blog::where('bcategory_id', $id)->get();
        foreach ($blogs as $data) {

            $data->delete();
        }
        $bcategory->delete();

    }

    // Blog Category Edit
    public function edit($id)
    {

        $bcategory = Bcategory::find($id);
        return view('admin.blog.blog-category.edit', compact('bcategory'));
    }

    // Blog Skill Category
    public function update(Request $request, $id)
    {
     
        $slug = Helper::make_slug($request->name);
        $bcategories = Bcategory::select('slug')->get();
        $bcategory = Bcategory::findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'max:150',
                function ($attribute, $value, $fail) use ($slug, $bcategories, $bcategory) {
                    foreach ($bcategories as $serv) {
                        if ($bcategory->slug != $slug) {
                            if ($serv->slug == $slug) {
                                return $fail('Title already taken!');
                            }
                        }
                    }
                },
                'unique:bcategories,name,'.$id
            ],
            'status' => 'required',
        ]);

        $bcategory = Bcategory::find($id);
        $bcategory->name = $request->name;
        $bcategory->status = $request->status;
        $bcategory->slug = $slug;
        $bcategory->save();

        $notification = array(
            'messege' => 'Blog Category Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.bcategory').'?language='.$this->lang->code)->with('notification', $notification);
    }
}
