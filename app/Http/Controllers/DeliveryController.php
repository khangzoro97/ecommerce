<?php

namespace App\Http\Controllers;

use App\City;
use App\Feeship;
use App\Province;
use App\Wards;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $city= City::orderby('matp','ASC')->get();
        return view('admin.delivery.add_delivery',compact('city'));
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output .='<option>--Chọn quận/huyện--</option>';
                foreach($select_province as $key => $province){
                    $output .= '<option value="'.$province->maqh.'">'.$province->name_huyen.'</option>';
                }
            }else{
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output .='<option>--Chọn xã/phường--</option>';
                foreach($select_wards as $key => $ward){
                    $output .='<option value="'.$ward->xaid.'">'.$ward->name_xa.'</option>';
                }
            }
        }
        echo $output;
    }
    public function insert_delivery(Request $request){
        $data= $request->all();
        $fee_ship= new Feeship();
        $fee_ship->fee_matp= $data['city'];
        $fee_ship->fee_maqh= $data['province'];
        $fee_ship->fee_xaid= $data['wards'];
        $fee_ship->fee_feeship= $data['fee_ship'];
        $fee_ship->save();
    }
    public function select_feeship(){
        $feeship= Feeship::orderby('fee_id','DESC')->get();
        $output= '';
        $output .='<div class="table-responsive">
            <table class="table table-bordered">
                 <thead>
                    <tr>
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th>
                        <th>Tên xã phường</th>
                        <th>Phí ship</th>
                    </tr>
                 </thead>
                 <tbody>
                 ';
                    foreach($feeship as $key=>$value) {
                        $output.='
                    <tr>
                        <td>'.$value->city->name_city.'</td>
                        <td>'.$value->province->name_huyen.'</td>
                        <td>'.$value->wards->name_xa.'</td>
                        <td contenteditable data-feeship_id="'.$value->fee_id.'" class="fee_feeship_edit">'.number_format($value->fee_feeship,0,',','.').' đ'.'</td>
                    </tr>
                        ';
                    }
        $output .='
            </tbody>
            </table></div>
        ';
    echo $output;
    }

    public function update_delivery(Request $request){
        $data= $request->all();
        $fee_ship= Feeship::find($data['feeship_id']);
        $fee_value= rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship=$fee_value;
        $fee_ship->save();
    }
}
