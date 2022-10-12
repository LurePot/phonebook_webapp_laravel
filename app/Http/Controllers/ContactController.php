<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Favorite;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateContactRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('user_id', Auth::id())->orderBy('name')->get();
        // $fid= Favorite::find('id');
        // dd($fid);
        $bk = Favorite::pluck('con_id');
        $bookmark = DB::table('contacts')->whereIn('id', $bk)
            ->where('user_id', Auth::id())->get();
            
            $trashed = Contact::onlyTrashed()->where('user_id', Auth::id())->orderBy('deleted_at')->get();
            $blacklist = Favorite::onlyTrashed()->where('user_id', Auth::id())->orderBy('deleted_at')->get();
           


        return view('dashboard')
            ->with('contacts', $contacts)
            ->with('bookmark', $bookmark)
            ->with('trashed', $trashed)
            ->with('blacklist', $blacklist)
            ->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('contact.create')->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        // dd($request);
        // pathinfo();
        //    image require for the first time
        if (!$request->has('photo')) {
            return back()->withInput()->with('error', 'Please Upload Image!');
        }

        $unrid = strtolower(Auth::user()->name) . '_' . Auth::id() . rand(1, 500);
        //  dd($unrid );
        $image = $request->file('photo');

        $filename = $unrid . '.png';
        $path = $image->storeAs('public/contact', $filename);
        $storagepath = Storage::path($path);
        // desired format
        $img = Image::make($storagepath)->fit(330, 330);
        // save image
        $img->save($storagepath);
        //

        $userId = User::find(Auth::id());
        $data = [
            'name' => $request->name,
            'relation' => $request->relation,
            'user_id' => $userId->id,
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $filename,
        ];
        // dd($data);
        if (Contact::create($data)) {
            return redirect()->route('dashboard')->with('message', "Contact has been added!");
        } else {
            return back()->with('message', "Create Failed!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contact.show')
            ->with('contact', $contact)
            ->with('user', Auth::user());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit')
            ->with('contact', $contact)
            ->with('user', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        // $u = User::find(Auth::id());
        $contact->update($request->except('photo'));
        // replace the request filename with desired name
        if ($contact->save()) {
            return back()->with('message', "Update Successfully!");
        } else {
            return back()->with('message', "Update Failed!!!");
        }
    }

    public function favorite($id)
    {

        $con = Contact::find($id);
        $favorite = new Favorite();
        $favorite->user_id = $con->user_id;
        $favorite->con_id = $con->id;
        // replace the request filename with desired name
        if ($favorite->save()) {
            return back()->with('message', "Favorite Successfully!");
        } else {
            return back()->with('message', "Favorite Failed!!!");
        }
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $contact = Contact::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orwhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('search.index', compact('contact'))
            ->with('user', Auth::user());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('dashboard')->with('success', 'Contact deleted successfully.');
    }

    public function trashed()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('contact.trashed', compact('contacts'))->with('user', Auth::user());
    }
}
