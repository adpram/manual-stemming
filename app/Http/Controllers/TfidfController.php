<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tfidf;
use Illuminate\Support\Facades\DB;


class TfidfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tfidf = Tfidf::all();
        $artikel1 = explode(' ', $tfidf[0]->artikel1);
        $artikel2 = explode(' ', $tfidf[0]->artikel2);
        $artikel3 = explode(' ', $tfidf[0]->artikel3);
        $artikel4 = explode(' ', $tfidf[0]->artikel4);
        
        $term = [];
        foreach($artikel1 as $val1){
            array_push($term, $val1);
        }
        foreach($artikel2 as $val2){
            array_push($term, $val2);
        }
        foreach($artikel3 as $val3){
            array_push($term, $val3);
        }
        foreach($artikel4 as $val4){
            array_push($term, $val4);
        }

        $term = array_count_values($term);
        $artikel1Count = array_count_values($artikel1);
        $artikel2Count = array_count_values($artikel2);
        $artikel3Count = array_count_values($artikel3);
        $artikel4Count = array_count_values($artikel4);

        return view('tfidf', compact('tfidf', 'term', 'artikel1', 'artikel2', 'artikel3', 'artikel4', 'artikel1Count', 'artikel2Count', 'artikel3Count', 'artikel4Count'));
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
     * perbarui artikel
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function perbaruiArtikel(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $tfidf = Tfidf::find($id);
            $tfidf->artikel1 = $request->artikel1;
            $tfidf->artikel2 = $request->artikel2;
            $tfidf->artikel3 = $request->artikel3;
            $tfidf->artikel4 = $request->artikel4;
            $tfidf->update();
            DB::commit();
            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
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
    public function destroy($id)
    {
        //
    }
}
