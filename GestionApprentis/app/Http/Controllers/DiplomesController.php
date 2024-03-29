<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diplomes;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class DiplomesController extends Controller
{
    public function index()
    {
        $diplomes = Diplomes::all();
        return view('diplomes.index', compact('diplomes'));
    }

    
    public function generatePDF()
    {
        $diplomes = Diplomes::get();

        $data = [
            'title' => 'Welcome to Funda of Web IT - fundaofwebit.com',
            'date' => date('m/d/Y'),
            'diplomes' => $diplomes
        ];

        $pdf = PDF::loadView('diplomes.index', $data);
        return $pdf->download('users-lists.pdf');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'duree' => 'required|integer',
            'description' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Diplomes::create($request->all());

        return redirect()->route('diplomes.index');
    }

    public function edit($id)
    {
        $diplome = Diplomes::findOrFail($id);
        return response()->json(['diplome' => $diplome]); // Return the diploma data as JSON
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'duree' => 'required|integer',
                'description' => 'nullable|string|max:2000',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $diplome = Diplomes::findOrFail($id);
            $diplome->update($request->all());

            return redirect()->route('diplomes.index');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error($e);
            // Return an error response
            return back()->withError('An error occurred while updating the diploma.')->withInput();
        }
    }


    public function destroy($id)
    {
        $diplome = Diplomes::findOrFail($id);
        $diplome->delete();

        return response()->json(['success' => true]); // Return success response
    }
}