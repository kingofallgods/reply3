<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $id = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $user = User::find($id);
        $ss = Session::all();
        return view('auth.user', [
            'user' => $user,
            'ss' => $ss
        ]);
    }

    protected $filepath = '';

    public function upload(Request $request)
    {
        if ($request->isMethod('POST')) {
            //print_r($_FILES);
            $file = $request->file('avatar1');
            //判断文件是否上传成功
            if ($request->hasFile('avatar1')) {
                $originalName = $file->getClientOriginalName();
                $exp = $file->getClientOriginalExtension();
                $realpath = $file->getRealPath();

                //刚才用date函数起名字，报错
                $filename = time() . '-' . uniqid() . '.' . $exp;
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realpath));
                $this->filepath = '/storage/app/uploads/' . $filename;
            } else {
                return back();
            }
//            print_r($this->filepath);
//            exit();
        }
//        return redirect('/home')->with('filepath',$this->filepath);
       return back()->with('filepath', $this->filepath);
//        return view('auth.register', ['filepath' => $this->filepath]);
//        return back()->action('', ['filepath' => $this->filepath]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user->avatar = $request->input('avatar');
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($user->save()) {
                return redirect('user')->with('success', '修改成功-' . $id);
            }
        }


        return view('auth.update', [
            'user' => $user
        ]);
    }


}
