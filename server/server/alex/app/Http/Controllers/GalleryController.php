<?php

namespace App\Http\Controllers;

use Aws\AwsClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Gallery;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = DB::table('gallery')
            ->get()
            ->toArray();

        return view('templates.gallery',compact('images'));
    }
    public function selectRestaurantForGallery(request $request)
    {
        $toArray = $request->toArray();

        $output = DB::table('business')
            ->where('biz_name', 'like', '%' . $toArray['gallery_rest_name'] . '%')
            ->limit(50)
            ->get()
            ->toArray();

            return response()->json($output);
    }

    public function uploadGalleryImg(request $request)
    {
        $s3 = new \Aws\S3\S3Client([
            'version'     => 'latest',
            'region'      => 'us-west-2',
            'credentials' => [
                'key'    => 'AKIAJSW4MLLREX67TBPA',
                'secret' => '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'
            ]
        ]);

        $toArray = $request->toArray();

        $name = $toArray['rest'];
        $biz_ID = $toArray['biz_ID'];

        if($biz_ID == '' || $request['files'] == null){
            return redirect('/gallery')->with('error', 'Please Fill all Fields!');
        }else{
            $files = $request->file('files');
            foreach ($files as $file) {

               $filepath = $file->getPathName();

               $filename = $file->getClientOriginalName();
               $extension = $file->getClientOriginalExtension();
               $fileNameNoExtension = rtrim($filename,('.'.$extension));

              $awsFolderName = 'restaurant_'.$biz_ID.'/'.date('YmdHis').time().rand().'.'.$extension;

                $result = $s3->putObject(array(
                    'Bucket'       => 'priimo',
                    'Key'          => $awsFolderName,
                    'region'       => 'us-west-2',
                    'SourceFile'   => $filepath,
                    'ContentType'  => $file->getMimeType(),
                    'ACL'          => 'public-read',
                    'StorageClass' => 'REDUCED_REDUNDANCY'
                ));
                $s3Url = "https://s3-us-west-2.amazonaws.com/priimo/".$awsFolderName;

                Gallery::insert([
                    'auth_id' => Auth::id(),
                    'biz_id' => $biz_ID,
                    'business_name' => $name,
                    'rest_img' => $s3Url,
                ]);
           }

           return redirect('/gallery')->with('success', 'Your Image(s) Uploaded!');
        }
    }

}
