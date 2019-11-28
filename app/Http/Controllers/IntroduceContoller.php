<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class IntroduceContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {            
    //     $introduces = \App\Member::first()->paginate(1);
    //     // $users = \App\Member::latest()->paginate($int);                            
    //     return view('introduce.index',compact('introduces'));// compact()를 사용하여 배열로 전달 
    //     // return view('introduce.index',['introduces'=> $introduces , 'users' => $users]);// compact()를 사용하여 배열로 전달 
    // }
    public function index()
    {            
        $introduces = \App\Member::all();                       
        return view('introduce.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('introduce.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $users = \App\User::where('user_id',$request->user_id)->first();
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
            // 중복방지를 위해 랜덤문자열 + filter_var(첫번째 인자값의 내용중 두번째인자 필터를 이용해서 필터링)
            // getClientOriginalName : 기존 파일이름,  FILTER_SANITIZE_URL : URL로 부적절한 이름 필터링
            $photo->move(attachements_path(),$filename);
            // 파일을 원하는 위치로 옮기는 구문
        }
        if($users){
            $introduces = \App\Member::create([
                // "userId"=>$users->count,
                "user_id"=>$request->user_id,
                "intro"=>$request->intro,
                "goal"=>$request->goal,
                "photo"=>isset($filename) ? $filename : '',
            ]);
        }
        //$introduces = \App\Member::find(1)->users()->create($request->all());  
       // $introduces = \App\Member::users()->create($request->all());  
        
        //return redirect(route('introduce.index'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /*  public function show($id)
    {
        //$introduces = \App\Member::where('id',$id)->get();    
        $introduces = \App\Member::where('userId',$id)->get();                              
        return view('introduce.index',compact('introduces'));// compact()를 사용하여 배열로 전달
    } */
     public function show($id)
    {
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = \App\Member::where('id',$id)->first();
        return view('introduce.edit', ['member' => $member]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $users = \App\User::where('userId',$request->userId)->first();
      
        $oldPhoto = \App\Member::where('id','=', $id)->first();
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
            // 중복방지를 위해 랜덤문자열 + filter_var(첫번째 인자값의 내용중 두번째인자 필터를 이용해서 필터링)
            // getClientOriginalName : 기존 파일이름,  FILTER_SANITIZE_URL : URL로 부적절한 이름 필터링
            $photo->move(attachements_path(),$filename);
            // 파일을 원하는 위치로 옮기는 구문  
            if(file_exists(storage_path('../public/images/'.$oldPhoto->photo))){
                unlink(storage_path('../public/images/'.$oldPhoto->photo)); // 기존파일 삭제
                //unlink : 파일삭제 storage_path: 주어진 파일의 절대경로 반환
            }
        }
            $member = \App\Member::where('id',$id)->update([  
                "user_id"=>$request->user_id, 
                "intro"=>$request->intro, //1111
                "goal"=>$request->goal, //1111
                "photo"=>isset($filename) ? $filename : $oldPhoto->photo,
            ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Member = id 가 넘어옴
    {
        
        // $oldPhoto = \App\Member::where('userId','=', $id)->first(); 
        // if ($oldPhoto) {
        // unlink(storage_path('../public/images/'.$oldPhoto->photo));
        // }
        \App\Member::where('id', $id)->delete(); // $id와 같은 userId의 값을 삭제 
        return response()->json([],204);
    }
}