<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee = employee::get();
        $response=[
            'message'=>'list employee',
            'data'=>$employee
        ];

        return response()->json($employee,Response::HTTP_OK);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name'=>['required'],
            'jabatan'=>['required'],
            'nik'=>['required'],
            'tgl_lahir'=>['required'],
            'no_tlp'=>['required'],
            'status'=>['required'],
            'tahun_bergabung'=>['required']

        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        try{
            $employee = employee::create($request->all());
            $response = [
                'message' => 'employee data created',
                'data'=> $employee

            ];
            return response()->json($response, Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                'message'=> "Failed " . $e->errorInfo
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $employee = employee::findOrFail($id);
        $response = [
            'message' => 'Detail employee data',
            'data'=> $employee

        ];
        return response()->json($response, Response::HTTP_OK);

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
        //
        $employee = employee::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'=>['required'],
            'jabatan'=>['required'],
            'nik'=>['required'],
            'tgl_lahir'=>['required'],
            'no_tlp'=>['required'],
            'status'=>['required'],
            'tahun_bergabung'=>['required']

        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 
            Response::HTTP_UNPROCESSABLE_ENTITY);

        }
        try{
            $employee->update($request->all());
            $response = [
                'message' => 'employee data updated',
                'data'=> $employee

            ];
            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'message'=> "Failed " . $e->errorInfo
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = employee::findOrFail($id);

       
        try{
            $employee->delete();
            $response = [
                'message' => 'employee data deleted',
                'data'=> $employee

            ];
            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'message'=> "Failed " . $e->errorInfo
            ]);

        }
        

    }
}
