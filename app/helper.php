<?php
    function attachements_path($path=''){
        return public_path('images'.($path ? DIRECTORY_SEPARATOR.$path : $path));
        //public_pth : 우리 프로젝트의 웹 서버 루트 디렉터리의 절대 경로를 반환하는 함수
    }
    ##  composer.json  autoload  에  "files": ["app/helper.php"] 추가 후.
    ##  composer dump-autoload --optimize
    function return_user_name($answers){
        $data = $answers;
        $count = 0;
        
        foreach($answers as $answer){
            $data[$count]['u_name']=\App\User::find($answer->user_id)->user_id;
            $count ++;
        }

        return $data;
    }
?>
