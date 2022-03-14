<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stemming;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stemming = Stemming::all();
        $string = str_replace("  ", ' ', $stemming[0]->data); // replace double space with single space
        $value = str_replace(array(',', '.', '"', "“", "”", "(", ")", "!", ":"), '', $string); // hapus tanda baca
        $tokenizing = explode(' ', $value);

        // stop word
        $tokenTidakLolos = file('http://static.hikaruyuuki.com/wp-content/uploads/stopword_list_tala.txt');
        foreach ($tokenTidakLolos as $key => $sw) {
            $tokenTidakLolos[$key] = strtolower(str_replace("\n", '', $sw));
        }
        $tambahanTokenTidakLolos = explode(' ', $stemming[0]->token_tidak_lolos);
        foreach ( $tambahanTokenTidakLolos as $val ) {
            array_push($tokenTidakLolos, strtolower($val));
        }

        // pengecualian stop word
        $tambahanTokenLolos = explode(' ', $stemming[0]->token_lolos);

        // token lolos untuk stemming
        // token yang lolos
        $tokenYangLolos = [];
        foreach ( $tokenizing as $index => $token ) {
            if ( in_array(strtolower($token), $tambahanTokenLolos) ) {
                $tokenYangLolos[$index] = $token;
            } else if ( in_array(strtolower($token), $tokenTidakLolos) || preg_match('~[0-9]+~', $token) ) {
                $tokenYangLolos[$index] = "-";                            
            } else {
                $tokenYangLolos[$index] = $token;
            } 
        }

        $resultStemming = explode(' ', $stemming[0]->result_stemming);
        return view('main', compact('stemming', 'tokenizing', 'tokenTidakLolos', 'tambahanTokenLolos', 'tokenYangLolos', 'resultStemming'));
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
     * perbarui data tokenizing
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function perbaruiData(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $stemming = Stemming::find($id);
            $stemming->data = $request->data;
            $stemming->update();
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
     * tambah data token tidak lolos
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function tambahTokenTidakLolos(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $stemming = Stemming::find($id);
            $stemming->token_tidak_lolos = $request->token_tidak_lolos;
            $stemming->update();
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
     * tambah data tidak lolos
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function tambahTokenLolos(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $stemming = Stemming::find($id);
            $stemming->token_lolos = $request->token_lolos;
            $stemming->update();
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
     * perbarui hasil stemming
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function perbaruiHasilStemming(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $stemming = Stemming::find($id);
            $stemming->result_stemming = $request->result_stemming;
            $stemming->update();
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
