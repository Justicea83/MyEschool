<?php

namespace App\Http\Controllers\Admin;

use App\Models\AcademicInfo;
use App\Models\AcademicYear;
use App\Models\Fee;
use App\Models\NewClass;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
class DetailController extends Controller
{
    public function index(){
        return view('admin.details.index');
    }
    //items functions
    public function itemsIndex(){
        return view('admin.details.items.add');
    }
    public function saveItem(Request $request){
        if($request->ajax()){
            try{
                $item = new Item();
                $item->name = $request->name;
                $item->amount = $request->amount;
                $item->school_id = auth()->user()->school_id;
                $item->academic_year_id = $request->year;
                $item->term_id = $request->term;
                if($item->save()){
                    return response()->json([
                        'status'=>'success'
                    ]);
                }
                return response()->json([
                    'status'=>'error'
                ]);
            }catch (\Exception $e){
                return response()->json([
                    'status'=>'error'
                ]);
            }
        }
    }
    public function academicIndex(){
        return view('admin.details.academics.add');
    }
    public function saveAcademicYear(Request $request){

            try {

                if ($request->ajax()) {
                    $item = new AcademicYear();
                    $item->name = $request->name;
                    $item->school_id = auth()->user()->school_id;
                    if ($request->status == 'active') {
                        AcademicYear::where('status', 'active')->update([
                            'status' => 'inactive'
                        ]);
                    }
                    $item->status = $request->status;
                    if ($item->save()) {
                        return response()->json([
                            'status' => 'success'
                        ]);
                    }
                    return response()->json([
                        'status' => 'error'
                    ]);
                }
                }catch (\Exception $e){
                return response()->json([
                    'status'=>'error'
                ]);
            }


    }

    public function deleteAcademicYear($id){
        $data = AcademicYear::find($id)->delete();
        if($data){
            return redirect()->back()->with([
                'success'=>'Deleted Successfully',
            ]);
        }
        return redirect()->back()->with([
            'error'=>'Failed to Delete',
        ]);
    }
    //terms
    public function showTerms(){
        return view('admin.details.term.add');
    }
    public function saveTerms(Request $request){
        try{
            if($request->ajax()){
                $item = new Term();
                $item->number = $request->number;
                $item->display_name = $request->name;
                if($request->status == 'active'){
                    $newStatus = Term::where('status','active')->update([
                        'status'=>'inactive'
                    ]);
                }
                $item->status = $request->status;
                $item->school_id = auth()->user()->school_id;
                $item->academic_year_id = $request->year;
                if($item->save()){
                    return response()->json([
                        'status'=>'success'
                    ]);
                }
                return response()->json([
                    'status'=>'error'
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>$e
            ]);
        }

    }

    public function deleteTerm($id){
        $data = Term::find($id)->delete();
        if($data){
            return redirect()->back()->with([
                'success'=>'Deleted Successfully',
            ]);
        }
        return redirect()->back()->with([
            'error'=>'Failed to Delete',
        ]);
    }
    public function deleteItem($id){
        $data = Item::find($id)->delete();
        if($data){
            return redirect()->back()->with([
                'success'=>'Deleted Successfully',
            ]);
        }
        return redirect()->back()->with([
            'error'=>'Failed to Delete',
        ]);
    }
    public function showFees(){
        return view('admin.details.fees.add');
    }

    public function saveFees(Request $request){
        if($request->ajax()){
            try{
                for($i = 0; $i < count($request->classes) ; $i++){
                    for($j = 0; $j < count($request->items);$j++){
                        $fee = new Fee();
                        $tempSchool = $fee->school_id = auth()->user()->school_id;
                        $tempTerm = $fee->term_id = $request->term;
                        $tempYear = $fee->academic_year_id = $request->year;
                        $tempItem = $fee->item_id = $request->items[$j]['id'];
                        $tempClass = $fee->class_id = $request->classes[$i]['id'];
                        //test for duplicates
                        $data = Fee::where('school_id',$tempSchool)
                            ->where('academic_year_id',$tempYear)
                            ->where('term_id',$tempTerm)
                            ->where('item_id',$tempItem)
                            ->where('class_id',$tempClass)
                            ->first();
                        if(isset($data))
                            continue;
                        $fee->save();
                    }
                }
                return response()->json([
                    'status'=>'success'
                ]);
            }catch (\Exception $e){
                return response()->json([
                    'status'=>'error'
                ]);
            }
        }
    }

    public function showBreakDown($id){
        $data = DB::table('fees')->where('fees.school_id',auth()->user()->school_id)
            ->where('fees.class_id',$id)
            ->select('fees.academic_year_id')
            ->distinct()
            ->leftJoin('academic_years','fees.academic_year_id','academic_years.id')
            ->select('academic_years.name as academic','academic_years.id')
            ->get();
        //dd($data);
        $class_name = NewClass::where('id',$id)->pluck('name')->first();
        return view('admin.details.fees.academicBreakdown',
            [
                'data'=>$data,
                'name'=>$class_name
            ]
        );
    }
    public function showTermBreakdown($id){
        $data = DB::table('fees')->where('fees.school_id',auth()->user()->school_id)
            ->where('fees.academic_year_id',$id)
            ->select('fees.term_id')
            ->distinct()
            ->leftJoin('terms','fees.term_id','terms.id')
            ->select('terms.display_name as academic','terms.id','terms.number')
            ->orderby('terms.number','ASC')
            ->get();
        //dd($data);
        $class_name = DB::table('fees')->where('fees.school_id',auth()->user()->school_id)
            ->where('fees.academic_year_id',$id)
            ->select('fees.class_id')
            ->distinct()
            ->leftJoin('classes','fees.class_id','classes.id')
            ->leftJoin('academic_years','fees.academic_year_id','academic_years.id')
            ->select('classes.name','academic_years.name as academic_name')
            ->first();
        return view('admin.details.fees.termBreakdown',[
            'data'=>$data,
            'name'=>$class_name
        ]);
    }
    public function showActualBreakdown($id){
        $data = DB::table('fees')->where('fees.school_id',auth()->user()->school_id)
            ->where('fees.term_id',$id)
            ->leftJoin('items','fees.item_id','items.id')
            ->select('items.name','items.amount','items.id')
            ->get();
        $class_name = DB::table('fees')->where('fees.school_id',auth()->user()->school_id)
            ->where('fees.term_id',$id)
            ->leftJoin('classes','fees.class_id','classes.id')
            ->leftJoin('terms','fees.term_id','terms.id')
            ->leftJoin('academic_years','fees.academic_year_id','academic_years.id')
            ->select('classes.name','academic_years.name as academic_name','terms.display_name')
            ->first();
        return view('admin.details.fees.details',[
            'data'=>$data,
            'name'=>$class_name
        ]);
    }


    public function deleteBreakDownItem($id){
        $data = Fee::find($id)->delete();
        if($data){
            return redirect()->back()->with([
                'success'=>'Deleted Successfully',
            ]);
        }
        return redirect()->back()->with([
            'error'=>'Failed to Delete',
        ]);
    }

    public function showEditAcademic($id){
        $data = AcademicYear::where('id',$id)->get();
        return $data;
    }

    public function updateEditAcademic(Request $request){
        if($request->ajax()){
            if ($request->status == 'active') {
                AcademicYear::where('status', 'active')->update([
                    'status' => 'inactive'
                ]);
            }
            DB::table('academic_years')->where('id',$request->id)
                ->update([
                    'status' => $request->status
                ]);
        }
    }

    public function showEditTerm($id){
        $data = Term::find($id);
        return $data;
    }

    public function updateEditTerm(Request $request){
        if($request->ajax()){
            if ($request->status == 'active') {
                $newStatus = Term::where('status', 'active')->update([
                    'status' => 'inactive'
                ]);
            }
            DB::table('terms')->where('id',$request->id)
                ->update([
                    'status' => $request->status,
                    'display_name'=>$request->display_name
                ]);
        }
    }
}
