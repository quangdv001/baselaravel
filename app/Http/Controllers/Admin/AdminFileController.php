<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\FileService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminFileController extends AdminBaseController
{
    protected $file;
    private $imgError = 'https://developers.google.com/maps/documentation/streetview/images/error-image-generic.png';
    public function __construct(FileService $file)
    {
        parent::__construct();
        $this->file = $file;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $file = $this->file->getFileByFolder(0);
        return view('admin.file.index')
            ->with('data', $file);
    }

    public function uploadFile(Request $request){
        $file = $request->file('file');
        $time = time();
        $data['folder_id'] = 0;
        $data['name'] = $file->getClientOriginalName();
        $data['path'] = $time.'-'.$file->getClientOriginalName();
        $data['type'] = $file->getClientOriginalExtension();
        Storage::putFileAs(
            'upload/files', $file, $data['path']
        );
        $data['url'] = Storage::url('upload/files/'.$data['path']);
        $img = $this->file->createFile($data, $this->user, []);
        $res['success'] = 0;
        if($img){
            $res['success'] = 1;
            $res['html'] = view('admin.file.item')->with('data', $img)->render();
        }
        return response()->json($res);
    }

    public function removeFile($id){
        $file = $this->file->getFileById($id);
        $path = 'upload/files/'. $file->path;
        $res['success'] = 0;
        if($file){
            Storage::delete($path);
            $this->file->removeFile($file);
            $res['success'] = 1;
        }
        return response()->json($res);
    }

    public function downloadFile($id){
        $file = $this->file->getFileById($id);
        return Storage::download('upload/files/'.$file->path);
    }

    public function openFileModal(){
        $file = $this->file->getFileByFolder(0);
        $res['success'] = 1;
        $res['html'] = view('admin.file.modal')->with('data', $file)->render();
        return response()->json($res);
    }

}
