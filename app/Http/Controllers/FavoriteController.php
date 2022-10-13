<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('user_id', Auth::id())->get();
        // dd($contacts);
        $bookmark = Favorite::where('user_id', Auth::id())->orderBy('con_id')->get();
        $trashed = Contact::onlyTrashed()->where('user_id', Auth::id())->orderBy('deleted_at')->get();
        $blacklist = Favorite::onlyTrashed()->where('user_id', Auth::id())->orderBy('deleted_at')->get();



        return view('favorite.index')
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite, $con_id)
    {
        DB::table('favorites')->where('con_id', $con_id)->delete();
        return redirect()->route('dashboard')->with('success', 'favorite deleted successfully.');
    }
}
