<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Vaqt;
use App\Models\Navbat;
use Carbon\Carbon;

class QidiruvControllerEng extends Controller
{
    public function qidiruv()
    {
        // Get the current day of the week as a number (0-6)
        $today = Carbon::now();
        $dayOfWeekNumber = $today->dayOfWeek;

        // Query the Vaqt model where 'kun' matches the current day of the week number
        $vaqt = Vaqt::where('kun', $dayOfWeekNumber)->get(); // Make sure to execute the query

        // Query the User model where 'type' is not 'superadmin'
        $qidiruv = User::where('type', '!=', 'superadmin')->get();

        // Return the view with the fetched data
        return view('clienteng.qidiruv', compact('qidiruv', 'vaqt'));
    }

    public function navbatkorish()
    {
        // Return the view with the fetched data
        return view('clienteng.navbatkorish');
    }

    public function navbat(Request $request)
    {
        $uid = $request->input('uid');
        $user = User::where('id', $uid)->first();
        // Now you can use the $vaqt value
        return view('clienteng.navbat', compact('uid', 'user'));
    }

    public function navbattekshirish(Request $request)
    {
        $tel = $request->input('tel');
        $navbat = Navbat::where('tel', $tel)->get();
        $user = User::all();
        // Now you can use the $vaqt value
        return view('clienteng.navbattekshirish', compact('navbat', 'user'));
    }

    public function navbatbekor(Request $request)
    {
        $id = $request->nid;
        $navbat = Navbat::findOrFail($id);

        // Save the changes to the about section
        $navbat->delete();
        // Now you can use the $vaqt value
        return redirect()->back()->with('success', 'Canceled');
    }
    ///navbat store
    public function navbatstore(Request $request)
{
    $data = $request->validate([
        'userid' => 'required|integer',
        'sana' => 'required|string',
        'vaqt' => 'required|string',
        'ism' => 'required|string',
        'tel' => 'required|string',
        'maqsad' => 'required|string',
    ]);

    try {
        Navbat::create([
            'userid' => $data['userid'],
            'sana' => $data['sana'],
            'vaqt' => $data['vaqt'],
            'ism' => $data['ism'],
            'tel' => $data['tel'],
            'maqsad' => $data['maqsad'],

        ]);

        return redirect()->back()->with('success', 'Successfully Saved');
            } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error!');
    }
}
    //navbat store
}
