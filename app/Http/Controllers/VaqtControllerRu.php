<?php

namespace App\Http\Controllers;
use App\Models\Vaqt;
use App\Models\Navbat;

use Illuminate\Http\Request;

class VaqtControllerRu extends Controller
{   
    //navbat
    function navbattasdiq(){
        ////////////////////////
        $user = auth()->user();
        $userId = $user->id;     
        ////////////////////////
        $vaqt = Navbat::where('status', '1')->where('xizmatkorsatildi', '0')->where('userid', $userId)->get();
        return view('russian.navbattasdiqlangan', compact('vaqt'));
    }

    function navbatxizmat(){
        ////////////////////////
        $user = auth()->user();
        $userId = $user->id;     
        ////////////////////////
        $vaqt = Navbat::where('status', '1')->where('xizmatkorsatildi', '1')->where('userid', $userId)->get();
        return view('russian.navbatxizmat', compact('vaqt'));
    }

        function navbat(){
        ////////////////////////
        $user = auth()->user();
        $userId = $user->id;     
        ////////////////////////
        $vaqt = Navbat::where('status', '0')->where('userid', $userId)->get();
        return view('russian.navbat', compact('vaqt'));
    }

    //tasdiqlash
    public function tasdiqlash(Request $request)
    {
        $selectedIds = $request->input('selectedIds', []);
    
        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Выбранные элементы не найдены.');
        }
    
        try {
            // Use whereIn to find and delete all selected items
            Navbat::whereIn('id', $selectedIds)->update(['status' => 1]);            
            // If you want to return a response message, you can do so
            return response()->json('Подтверждено.');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500); // Handle any errors
        }
    }
    //tasdiqlash
    //xizmat
    public function xizmat(Request $request)
    {
        $selectedIds = $request->input('selectedIds', []);
    
        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Выбранные элементы не найдены.');
        }
    
        try {
            // Use whereIn to find and delete all selected items
            Navbat::whereIn('id', $selectedIds)->update(['xizmatkorsatildi' => 1]);            
            // If you want to return a response message, you can do so
            return response()->json('Услуга предоставлена.');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500); // Handle any errors
        }
    }
    //xizmat
    //navbatdelete
    public function navbatdelete(Request $request)
    {
        $selectedIds = $request->input('selectedIds', []);
    
        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Выбранные элементы не найдены.');
        }
    
        try {
            // Use whereIn to find and delete all selected items
            Navbat::whereIn('id', $selectedIds)->delete();            
            // If you want to return a response message, you can do so
            return response()->json('O`chirildi.');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500); // Handle any errors
        }
    }
    //navbat
    //vaqt
    function vaqt(){
        ////////////////////////
        $user = auth()->user();
        $userId = $user->id;     
        ////////////////////////
        $vaqt = Vaqt::where('userid', $userId)->orderBy('kun')->get();
        return view('russian.vaqt', compact('vaqt'));
    }

    public function store(Request $request)
    {
        ////////////////////////
        $user = auth()->user();
        $userId = $user->id;     
        ////////////////////////
        $validatedData = $request->validate([
            'boshlash' => 'required|date_format:H:i',
            'tugash' => 'required|date_format:H:i',
            'vaqt' => 'required|integer|min:1',
        ]);

        $bosh = $validatedData['boshlash']; // Start time in H:i format
        $tug = $validatedData['tugash']; // End time in H:i format
        $vaqt = $validatedData['vaqt']; // Interval in minutes

        //$current_time = strtotime($bosh);
        //$end_time = strtotime($tug);

        $count = 1;
        while($count < 8){
        $current_time = strtotime($bosh);
        $end_time = strtotime($tug);
        while ($current_time <= $end_time) {
            Vaqt::create([
                'userid' => $userId,
                'kun' => $count,
                'vaqt' => date('H:i', $current_time),
            ]);

            // Add the interval to the current time
            $current_time = strtotime("+$vaqt minutes", $current_time);
        }
        $count = $count + 1;
    }

        return 'Успешно сохранено';
    }

    public function delete(Request $request)
{
    $selectedIds = $request->input('selectedIds', []);

    if (empty($selectedIds)) {
        return redirect()->back()->with('error', 'Выбранные элементы не найдены.');
    }

    try {
        // Use whereIn to find and delete all selected items
        Vaqt::whereIn('id', $selectedIds)->delete();
        
        // If you want to return a response message, you can do so
        return response()->json('Удалено.');
    } catch (\Exception $e) {
        return response()->json($e->getMessage(), 500); // Handle any errors
    }
}

}
