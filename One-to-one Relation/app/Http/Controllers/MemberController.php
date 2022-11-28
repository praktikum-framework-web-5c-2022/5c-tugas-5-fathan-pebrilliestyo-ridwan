<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{

    public function index(){
        $members = Member::with('sosmed')->paginate(5);  
            return view('member.index', [
                'members' => $members
            ]);
    }

    public function create(){
        return view('member.create');
    }

    public function insert(Request $request){

        $this->validate($request,[
            'username'=>'required|string|unique:members,username|max:8',
            'nama'=>'required|max:50',
            'facebook' => 'nullable|string',
            'instagram' => array('nullable','regex:/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/'),
            'whatsapp' => 'nullable|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10|max:12',
        ]);

        $member = Member::create([
            'username' => $request->username,
            'nama' => $request->nama,
        ]);

        $member->sosmed()->create([
            'facebook'=> $request->facebook,
            'instagram'=> $request->instagram,
            'whatsapp'=> $request->whatsapp,
        ]);

        if($member){
            return redirect()->route('member.index')->with(['success' => 'Data berhasil ditambahkan']);
        }else{
            return redirect()->route('member.create')->with('error');
        }
    }

    public function edit($id){
        $member = Member::find($id);
        // dd($member);
        return view('member.edit',compact('member'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required|max:50',
            'status' => 'required|string',
            'facebook' => 'nullable|string',
            'instagram' => array('nullable','regex:/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/'),
            'whatsapp' => 'nullable|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10|max:12',
        ]);

        $member = Member::find($id);
        $member->update($request->all());
        $member->sosmed()->update([
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
            'whatsapp'=>$request->whatsapp,
        ]);

        if($member){
            return redirect()->route('member.index')->with(['success' => 'Data berhasil diubah']);
        }else{
            return redirect()->route('member.edit')->with('error');
        }
    }

    public function delete($id){
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('member.index')->with('success',"Data member berhasil dihapus");
    }
}
