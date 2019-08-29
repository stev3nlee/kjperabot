<?php

namespace App\Http\Controllers\AdminSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company_profile;
use App\Models\Role;
use App\Models\Role_detail;
use App\Administrator;
class SettingController extends Controller
{
  public function __construct()
  {
    $this->TC = new Company_profile;
  }

  public function showMetadata()
  {
    return view('administratoronly/settings/metadata/index')->with([
      "company"=>$this->TC->first()
    ]);
  }

  public function saveMetadata(Request $request)
  {
    $this->validate($request,[
      "meta_title"=>"required|max:225"
      ,"meta_keyword"=>"required"
      ,"meta_description"=>"required"
    ]);
    \DB::beginTransaction();
    try{
      $company_profile=$this->TC->find(1);
      $company_profile->meta_title        = trim($request->input('meta_title'));
      $company_profile->meta_keyword      = trim($request->input('meta_keyword'));
      $company_profile->meta_description  = trim($request->input('meta_description'));
      $company_profile->save();
      \DB::commit();
      Parent::h_flash('You have successfully edited the data.','success');
    }catch (\Exception $e) {
      dd($e);
      \DB::rollback();
      Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
    }
    return redirect()->back();
  }

  public function showSocialMedia()
  {
    return view('administratoronly/settings/social-media/index')->with([
      "company"=>$this->TC->first()
    ]);
  }

  public function saveSocialMedia(Request $request)
  {
    \DB::beginTransaction();
    try{
      $company_profile=$this->TC->find(1);
      $company_profile->facebook   = trim($request->input('facebook'));
      $company_profile->instagram  = trim($request->input('instagram'));
      $company_profile->save();
      \DB::commit();
      Parent::h_flash('You have successfully edited the data.','success');
    }catch (\Exception $e) {
      dd($e);
      \DB::rollback();
      Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
    }
    return redirect()->back();
  }

  public function showTool()
  {
    return view('administratoronly/settings/tools/index')->with([
      "company"=>$this->TC->first()
    ]);
  }

  public function saveTool(Request $request)
  {
    $company=$this->TC->first();
    $logo=$company->logo_path;
    $favicon=$company->favicon_path;
    if(!empty($request->file('logo'))){
      $image = $request->file('logo');
      $filename = strtotime("now").".".$image->getClientOriginalExtension();
      $image->move('images/uploads',$filename);
      $logo="images/uploads/".$filename;
    }

    if(!empty($request->file('favicon'))){
      $image = $request->file('favicon');
      $filename = strtotime("now").".".$image->getClientOriginalExtension();
      $image->move('images/uploads',$filename);
      $favicon="images/uploads/".$filename;
    }
    \DB::beginTransaction();
    try{
      $company->logo_path = $logo;
      $company->favicon_path  = $favicon;
      $company->save();
      \DB::commit();
      Parent::h_flash('You have successfully edited the data.','success');
    }catch (\Exception $e) {
      dd($e);
      \DB::rollback();
      Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
    }
    return redirect()->back();
  }

  public function showChangePassword()
  {
    return view('administratoronly/settings/change-password/index');
  }

  public function saveChangePassword(Request $request)
  {
    $this->validate($request, [
        'current_password'=> 'required',
        'password'  => 'required|min:6',
        'password_confirmation'  => 'required|same:password',
      ]);

    if(\Hash::check($request->input('current_password'),\Auth::guard('administrator')->user()->password))
    {
      $admin=Administrator::find(\Auth::guard('administrator')->user()->id);
      $admin->password = bcrypt($request->input('password'));
      $admin->updated_at = date("Y-m-d H:i:s");
      $admin->save();
      Parent::h_flash("You have successfully changed your password.","success");
    }else{
      Parent::h_flash("The old password field does not match with current password.","danger");
    }
    return redirect()->back();
  }

  public function showGroup()
  {
    return view('administratoronly/settings/useraccount/group/index')->with([
      "roles"=>Role::orderBy('role_name')->get()
    ]);
  }

  public function showAddGroup()
  {
    return view('administratoronly/settings/useraccount/group/add')->with([
      "role_details"=>Role_detail::get()
    ]);
  }

  public function addRoleGroup(Request $request)
  {
    $this->validate($request, [
        'role_name'     => 'required|unique:roles,role_name|max:20',
      ]);

    $countRole=Role_detail::count();
    $role="";
    for($x=1;$x<=$countRole;$x++){
      if($x!=1){ $role.="&&"; }
      $role.=($request->input('is_checked.'.$x) == "" ? 0 : 1);
    }
    \DB::beginTransaction();
    try{
      Role::create(["role_name"=>$request->input('role_name'),"role_access"=>$role]);
      \DB::commit();
      Parent::h_flash('You have successfully added new role.','success');
      return redirect('administratoronly/settings/useraccount/group/index');
    }catch (\Exception $e) {
      \DB::rollback();
      Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      return redirect()->back();
    }
  }

  public function showEditGroup($id)
  {
    Role::findOrFail($id);
    return view('administratoronly/settings/useraccount/group/edit')->with([
      "role"  =>Role::where('id',$id)->first(),
      "roles" => Role_detail::get()
    ]);
  }

  public function saveEditGroup(Request $request)
  {
    $this->validate($request,[
      'role_name'=>'required|max:20|unique:roles,role_name,'.$request->input('id'),
    ]);
    $count_role_detail=Role_detail::count();
    $arr_input=$request->input('is_checked');
    $input="";
    for($x=1; $x <= $count_role_detail; $x++){
      if($x!=1){ $input.="&&"; }
      $input.= (empty($arr_input[$x]) ? "0" : $arr_input[$x]);
    }

    $data=Role::findOrFail($request->input('id'));
    \DB::beginTransaction();
    try{
      $data->role_name = $request->input('role_name');
      $data->role_access = $input;
      $data->save();
      \DB::commit();
      Parent::h_flash("You have successfully edited this role.","success");
    }catch (\Exception $e){
      \DB::rollback();
      Parent::h_flash("There is an error inside the data. Please contact your administrator.","danger");
    }
    return redirect('administratoronly/settings/useraccount/group/index');
  }

  public function deleteRoleGroup(Request $request)
  {
    $id=Administrator::where('role_id',$request->input('id'))->first();
    if(count($id) == 0)
    {
      \DB::beginTransaction();
      try{
        $edit=Role::find($request->input('id'));
        $edit->delete();
        Parent::h_flash('You have successfully deleted this account.','success');
        \DB::commit();
      }catch (\Exception $e) {
        \DB::rollback();
        Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      }
    }else{
      Parent::h_flash("You cannot delete this role as its still in use.",'danger');
    }
    return redirect()->back();
  }

  public function showAccount()
  {
    return view('administratoronly/settings/useraccount/account/index')->with([
      "admins"=>Administrator::with('role')->get()
      ,"roles"=>Role::get()
    ]);
  }

  public function addAccount(Request $request)
  {
    $this->validate($request, [
        'email'     => 'required|email|unique:administrators,email',
        'full_name'  => 'required|max:30',
        'role'      => 'required'
    ]);
    \DB::beginTransaction();
    try{
      Administrator::create([
        "name"    =>$request->input('full_name')
        ,"email"  =>$request->input('email')
        ,"password"  =>bcrypt('kjperabot')
        ,"role_id"   =>$request->input('role')
        ,"is_active"   =>1
      ]);
      \DB::commit();
      Parent::h_flash('You have successfully added new account.','success');
      return redirect()->back();
    }catch (\Exception $e) {
      \DB::rollback();
      Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      return redirect()->back();
    }
  }

  public function editAccount(Request $request)
  {
    $this->validate($request, [
        'full_name'  => 'required|max:30',
        'role'      => 'required'
    ]);
    $account = Administrator::find($request->input('id'));
    \DB::beginTransaction();
    try{
      $account->name = $request->input('full_name');
      $account->role_id = $request->input('role');
      $account->save();
      \DB::commit();
      Parent::h_flash('You have successfully edit the account.','success');
      return redirect()->back();
    }catch (\Exception $e) {
      \DB::rollback();
      Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      return redirect()->back();
    }
  }

  public function deleteAccount(Request $request)
  {
    $account = Administrator::find($request->input('id'));
    \DB::beginTransaction();
    try{
      $account->delete();
      \DB::commit();
      Parent::h_flash('You have successfully delete the account.','success');
      return redirect()->back();
    }catch (\Exception $e) {
      dd($e);
      \DB::rollback();
      Parent::h_flash('There is an error inside the data. Please contact your administrator.','danger');
      return redirect()->back();
    }
  }

}
