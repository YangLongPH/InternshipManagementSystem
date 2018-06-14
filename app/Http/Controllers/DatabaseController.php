<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Models\User;
use App\Models\Sinh_Vien;
use Excel,Input,File;
use Hash;
use DB;
class DatabaseController extends Controller{
    public function readExcels(Request $request){
      return view('admin.readExcels')->with([
            'user'=> $request->session()->get('user'),
            'sinhvien' => $request->session()->get('sinhvien')
            ]);
    }

    public function createNew(Request $request){
      return view('admin.createNew')->with([
        'user' => $request->session()->get('user'),
        'sinhvien' => $request->session()->get('sinhvien')
        ]);
    }
    
    public function updateDB(Request $request) {
    switch ($request->choseTable) {
      case 'students':
              return $this->ExcelsStudents($request);
              break;
      case 'class':
              return $this->ExcelsClass($request);
              break;
      case 'president.class':
              return $this->ExcelsPresidentClass($request);
              break;
      case 'president.group':
              return $this->ExcelsPresidentGroup($request);
              break;
      case 'adviser':
              return $this->ExcelsAdviser($request);
              break;
      case 'violate.ytsv':
              return $this->ExcelsViolateYTSV($request);
              break;
      case 'violate.ytcd':
              return $this->ExcelsViolateYTCD($request);
              break;
      case 'bonus':
              return $this->ExcelsBonus($request);
              break;

      case 'point.average':
              return $this->ExcelsPointAverage($request);
              break;
      case 'violate.pass':
              return $this->ExcelsViolatePass($request);
              break;

      case 'study.science':
              return $this->ExcelsStudyScience($request);
              break;
      case 'have.prize':
              return $this->ExcelsHavePrize($request);
              break;
      case 'join.activity':
              return $this->ExcelsJoinActivity($request);
              break;
      case 'have.praise':
              return $this->ExcelsHavePraise($request);
              break;

      case 'violate.department':
              return $this->ExcelsViolateDepartment($request);
              break;

      case 'violate.activity':
              return $this->ExcelsViolateActivity($request);
              break;
    }
  }


  public function ExcelsStudents($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) != null ) {
              // echo "</br>"."Haved: ".$row->name;
            }else {
              $sinh_vien_new = new Sinh_Vien();
              $sinh_vien_new->mssv = $row->mssv;
              $sinh_vien_new->fullname = $row->name;
              $sinh_vien_new->birthday = $row->birthday;
              $sinh_vien_new->class = $row->class;
              $sinh_vien_new->save();

              $user = new User();
              $user->username = $row->mssv;
              $user->email = "$row->mssv"."@vnu.edu.vn";
              $user->password = Hash::make($row->mssv);
              $user->mssv = $row->mssv;
              $user->id_role =3;
              $user->avatar = $row->mssv;
              $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
  }

  public function ExcelsClass($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
  }

  public function ExcelsPresidentClass($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
  }

  public function ExcelsPresidentGroup($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsAdviser($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsViolateYTSV( $request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsViolateYTCD( $request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsBonus($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsPointAverage($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsViolatePass($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsStudyScience($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsHavePrize($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsJoinActivity($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsHavePraise($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }

  public function ExcelsViolateDepartment($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
  }

  public function ExcelsViolateActivity($request){
      $S1=Sinh_Vien::all()->count();
      Excel::selectSheets('Sheet1')->load($request->fileExcels, function($reader){
        $reader->each(function($row){
            if (Sinh_Vien::find($row->mssv) == null ) {
              echo $row;
              // $sinh_vien_new = new Sinh_Vien();
              // $sinh_vien_new->save();
              // $user = new User();
              // $user->save();
            }
        });
      });

      $S2=Sinh_Vien::all()->count();
      $S2=$S2-$S1;
      return view('admin.readExcels')->with([
          'user' => $request->session()->get('user'),
          'sinhvien' => $request->session()->get('sinhvien'),
          'dcount' => $S2,
          'chosetable' => $request->choseTable
          ]);
    
  }
}