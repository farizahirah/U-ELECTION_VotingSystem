<?php

namespace App\Http\Controllers;

use App\Models\BuletinNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuletinNewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buletin_news = BuletinNew::paginate(15);
        return view('buletinNew.index', compact('buletin_news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buletinNew.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $safeName = null;
        if($request->hasFile('document'))
        {
            $destinationPath = public_path() . '/archieve/buletin_new/'.$request->title.'/';
            $doc = $request->file('document');
            $safeName = $doc->getClientOriginalName();
            $doc->move($destinationPath, $safeName);
        }

        BuletinNew::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'document' => $safeName,
            'status' => $request->status,
            'created_by' => $user,
        ]);

        return redirect(route('buletin_new.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(BuletinNew $buletinNew)
    {
        return view('buletinNew.view', compact('buletinNew'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BuletinNew $buletinNew)
    {
        return view('buletinNew.edit', compact("buletinNew"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BuletinNew $buletinNew)
    {
        $user = Auth::user()->id;
        if($request->hasFile('document'))
        {
            if (File::exists(public_path() . '/archieve/buletin_new/'.$buletinNew->title.'/'.$buletinNew->document)){
                unlink(public_path() . '/archieve/buletin_new/'.$buletinNew->title.'/'.$buletinNew->document);
            }
            $destinationPath = public_path() . '/archieve/buletin_new/'.$request->title.'/';
            $doc = $request->file('document');
            $safeName = $doc->getClientOriginalName();
            $doc->move($destinationPath, $safeName);
            $buletinNew->update([ 'document' => $safeName]);
        }

        $buletinNew->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => $user,
        ]);

        return redirect(route('buletin_new.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BuletinNew $buletinNew, $id)
    {
        $sample = BuletinNew::destroy($id);

        // Redirect to the group management page
        return redirect(route('buletin_new.index'));
    }
}
