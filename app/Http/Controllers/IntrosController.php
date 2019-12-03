<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Http\Requests\IntrosRequest;
use \App\Intro;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class IntrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('intro.index',['lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);  
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intro.create',['lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'place' => 'required',
            'master' => 'required',
            'weekset' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'append' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $request->starttime = time_check($request->starttime);
        $request->endtime = time_check($request->endtime);
        $weekset = week_check($request);
        if($weekset['status']){
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
                // 중복방지를 위해 랜덤문자열 + filter_var(첫번째 인자값의 내용중 두번째인자 필터를 이용해서 필터링)
                // getClientOriginalName : 기존 파일이름,  FILTER_SANITIZE_URL : URL로 부적절한 이름 필터링
                $photo->move(attachements_path(),$filename);
                // 파일을 원하는 위치로 옮기는 구문
            }
            $intro = Intro::create([
                'title' => $request->title,
                'append' => $request->append,
                'place' => $request->place,
                'master' => $request->master,
                'weekset' => $weekset['message'],
                'starttime' => $request->starttime,
                'endtime' => $request->endtime,
                'photo' => isset($filename) ? $filename : '',
            ]);
            return response()->json([
                'message'=>'등록되었습니다.',
                'status'=>true
            ],201);
        }
        return response()->json(['message'=>$weekset['message'],'status'=>$weekset['status']],201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intro = Intro::where('id','=', $id)->first();
        $weeknd = [ '월', '화', '수', '목', '금', '토', '일' ];
        for($i = 0; $i < 7; $i++){
            $intro->weekset = str_replace(($i+1),$weeknd[$i],$intro->weekset);
        }
        return view('intro.show',['intro'=>$intro,'lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $intro = Intro::where('id', $id)->first();
        $intro->starttime = time_check($intro->starttime);
        $intro->endtime = time_check($intro->endtime);
        return view('intro.edit',['intro'=>$intro,'lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IntrosRequest $request, $id)
    {
        $request->starttime = time_check($request->starttime);
        $request->endtime = time_check($request->endtime);
        $weekset = week_check($request,$id);
        if($weekset['status']){
            $oldPhoto = Intro::where('id','=', $id)->first();
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
                $photo->move(attachements_path(),$filename);
                if($oldPhoto->$photo === '' || file_exists(storage_path('../public/images/'.$oldPhoto->photo))){
                    unlink(storage_path('../public/images/'.$oldPhoto->photo)); // 기존파일 삭제
                }
                //unlink : 파일삭제 storage_path: 주어진 파일의 절대경로 반환
            }
            $intro = Intro::where('id', $id)->update([
                'title' => $request->title,
                'append' => $request->append,
                'place' => $request->place,
                'master' => $request->master,
                'weekset' => $weekset['message'],
                'starttime' => $request->starttime,
                'endtime' => $request->endtime,
                'photo' => isset($filename) ? $filename : $oldPhoto->photo,
            ]);
            return response()->json([
                'message'=>'수정되었습니다.',
                'status'=>true
            ],201);
        }
        return response()->json(['message'=>$weekset['message'],'status'=>$weekset['status']],201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldPhoto = Intro::where('id','=', $id)->first();
        if($oldPhoto->photo !== '' && file_exists(storage_path('../public/images/'.$oldPhoto->photo))){
            unlink(storage_path('../public/images/'.$oldPhoto->photo)); // 기존파일 삭제
        }
        Intro::where('id', $id)->delete();
        return response()->json([
            'message'=>'삭제되었습니다.',
            'status'=>true
        ],201);
    }
}