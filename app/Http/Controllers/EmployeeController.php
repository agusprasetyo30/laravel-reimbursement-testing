<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Gate;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('create-user')) {
            abort(403, 'Anda tidak memiliki hak akses');
        }

        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation_input = $this->customValidation($request);

        // Validation checking
        if ($validation_input->fails()) {
            return redirect()
                ->route('employee.create')
                ->withErrors($validation_input->messages())
                ->withInput();
        }

        $request->merge(['password' => Hash::make($request->password)]);

        User::create($request->all());

        return redirect()->route('employee.index')
            ->with('alert_type', 'success')
            ->with('message', 'Add employee successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Gate::denies('edit-user')) {
            abort(403, 'Anda tidak memiliki hak akses');
        }

        $employee = User::find($id);

        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = User::find($id);
        $request->merge(['nip' => $employee->nip]);

        $validation_input = $this->customValidation($request, 'update');

        // Validation checking
        if ($validation_input->fails()) {
            return redirect()
                ->route('employee.edit', $employee->id)
                ->withErrors($validation_input->messages())
                ->withInput();
        }

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('employee.index')
            ->with('alert_type', 'success')
            ->with('message', 'Update employee successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::where('id', $id)->first();

        $data->delete();

        return $this->success($data, "Delete employee successfully");
    }

    /**
     * Use to change password user
     *
     * @param [type] $id
     * @return void
     */
    public function changePassword(Request $request, $id)
    {
        $employee = User::find($id);
        $rules = ["password" => ['required', 'confirmed']];
        $validation_input = Validator::make($request->all(), $rules);

        // Validation checking
        if ($validation_input->fails()) {
            return redirect()
                ->route('employee.edit', $employee->id)
                ->withErrors($validation_input->messages())
                ->withInput();
        }

        $employee->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('employee.edit', $employee->id)
            ->with('alert_type', 'success')
            ->with('message', 'Change password successfully');
    }

    /**
     * Use to make custom validation data
     *
     * @param [type] $request
     * @param string $type
     * @return object
     */
    private function customValidation($request, $type = 'store')
    {
        $validation = [
            'name'     => ['required'],
            'email'    => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'nip'      => ['required', 'numeric', 'unique:users'],
            'role'     => ['required']
        ];

        // Delete validation unique when same with name
        if ($type == 'update') {
            // delete unused array key when updating data
            unset($validation['nip']);
            unset($validation['password']);

            // checking email
            $check_email = User::where('email', $request->email)
                ->where('nip', $request->nip)
                ->first();

            // Delete validation email
            if ($check_email) unset($validation['email'][1]);
        }

        return Validator::make($request->all(), $validation, [
            'role.required' => 'Role / Jurusan not selected',
        ]);
    }
}
