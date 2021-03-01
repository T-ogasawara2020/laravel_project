<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;
use Illuminate\Support\Facades\DB;//クエリビルダー
use App\Services\CheckFormData;
use App\Services\SearchDB;
use App\Http\Requests\StoreContactForm;


class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $search = $request->input('search'); #DI
        //eloquent ORマッパー
        //$contacts = ContactForm::all();//eloquentによる方法

        //クエリビルダー
        // $contacts = DB::table('contact_forms')
        // ->select('id', 'your_name', 'title', 'created_at')
        // ->orderBy('id','asc') //逆順はasc
        // ->paginate(20);
        //dd($contacts);

        // // //検索フォーム
        $query = DB::table('contact_forms');

        //if keywords exist
        // if($search !== null){
        //     //relace  full-width with half-width
        //     $search_split = mb_convert_kana($search,'s');

        //     //separate with blanks
        //     $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

        //     //word loop
        //     foreach($search_split2 as $value){
        //         $query->where('your_name','like','%'.$value.'%');
        //     }
        // };

        $query = SearchDB::searchInspect($query, $search);
        $contacts = $query->paginate(20);
        return view('contact.index', compact('contacts'));//compactはphpの関数
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  //$request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactForm $request)
    {
        $contact = new ContactForm;
        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();

        return redirect('contact/index');
        //dd($your_name,$title);
        
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = ContactForm::find($id);
        $gender = CheckFormData::checkGender($contact);
        $age = CheckFormData::checkAge($contact);
       
        
        
        
        

        return view('contact.show', compact('contact','gender','age'));
        //fat controller
        //controllerが大きくなってしまう。
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = ContactForm::find($id);
        return view('contact.edit', compact('contact'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = ContactForm::find($id);
        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();

        return redirect('contact/index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = ContactForm::find($id);

        $contact->delete();

        return redirect('contact/index');
        //
    }
}
