<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShipState;

class ShippingAreaController extends Controller
{
    // Divisions////////////////////////////////////////////////
    public function ViewDivision()
    {
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function StoreDivision(Request $request) 
    {
        $request->validate([

            'division_name' => 'required',
            
        ]);

        ShipDivision::insert([

            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'Division Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditDivision($id)
    {
        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division',compact('divisions'));
    }

    public function UpdateDivision(Request $request, $id)
    {
        $division = ShipDivision::findOrFail($id);

        $division->update([

            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'Division Updated Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('manage.division')->with($notification);
    }

    public function DeleteDivision($id)
    {
        $division = ShipDivision::findOrFail($id);
        $division->delete();

        $notification = array(
            'message'=> 'Division Deleted Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('manage.division')->with($notification);
    }

// Divisions /////////////////////////////////////////////////////



// District Function 

    public function ViewDistrict()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('districts','divisions'));
    }

    public function StoreDistrict(Request $request)
    {
        $request->validate([

            'division_id' => 'required',
            'district_name' => 'required',
            

        ]);

        ShipDistrict::insert([

            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'District Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditDistrict($id)
    {
        $divisions  = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district',compact('districts','divisions'));
    }

    public function UpdateDistrict(Request $request, $id)
    {
        $district = ShipDistrict::findOrFail($id);

        $district->update([

            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'District Updated Succesfully',
            'alert-type' => 'info'
        );
        return redirect()->route('manage.district')->with($notification);
    }

    public function DeleteDistrict($id)
    {
        {
            $district = ShipDistrict::findOrFail($id);
            $district->delete();
    
            $notification = array(
                'message'=> 'District Deleted Succesfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage.district')->with($notification);
        }
    }

    // District /////////////////////////////////////////


    // State ////////////////////////////////////////////


    public function ViewState()
    {
      
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $states = ShipState::with('division', 'district')->orderBy('id', 'ASC')->get();
        return view('backend.ship.state.view_state', compact('districts','divisions','states'));
    }

    public function StateStore(Request $request)
    {
        $request->validate([

            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
            

        ]);

        ShipState::insert([

            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'State Inserted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }   

    public function EditState($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $states = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state', compact('districts','divisions','states'));
    }

    public function UpdateState(Request $request, $id)
    {
        $state = ShipState::findOrFail($id);

        $state->update([

            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
            
        ]);

        $notification = array(
            'message'=> 'State Updated Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage.state')->with($notification);
      
    }

    public function DeleteState($id)
    {
        $state = ShipState::findOrFail($id);
        $state->delete();

        $notification = array(
            'message'=> 'State Deleted Succesfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manage.state')->with($notification);
    }
 


}
