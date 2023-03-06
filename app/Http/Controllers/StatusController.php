<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use Illuminate\Support\Facades\DB;
class StatusController extends Controller
{
    public function store(Request $request)
{
 //   $status = $request->input('status');
 //  dd($request);
 DB::table('status')->update([
     'buka_tutup_rayuan' => $request->input('status1'),
     'buka_tutup_semakan' => $request->input('status2'),
 ]);
    return redirect()->back();
}

}
