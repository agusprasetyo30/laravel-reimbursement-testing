<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Models\ReimburseApproval;
use App\Models\Reimbursement;
use Carbon\Carbon;
use DB;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('index-reimbursement')) {
            abort(403, 'Anda tidak memiliki hak akses');
        }

        return view('reimbursement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('create-reimbursement')) {
            abort(403, 'Anda tidak memiliki hak akses');
        }

        return view('reimbursement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('store-reimbursement')) {
            abort(403, 'Anda tidak memiliki hak akses');
        }

        $validation_input = $this->customValidation($request);

        // Validation checking
        if ($validation_input->fails()) {
            return redirect()
                ->route('reimbursement.create')
                ->withErrors($validation_input->messages())
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Upload Document
            if ($request->file('document')) {
                $file = General::uploadFile($request->file('document'), 'reimbursement', 'document/reimbursement', true, true);

                $request->merge([
                    'document_file_name' => $file['origin_file_save_name'],
                    'document_file_path' => $file['file_location'],
                ]);
            }

            Reimbursement::create([
                'date'         => $request->date,
                'name'         => $request->name,
                'description'  => $request->description,
                'document_file_path'  => $request->document_file_path,
                'document_file_name'  => $request->document_file_name,
            ]);

            DB::commit();

            return redirect()->route('reimbursement.index')
                ->with('alert_type', 'success')
                ->with('message', 'Add Reimbursement Successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Gate::denies('edit-reimbursement')) {
            abort(403, 'Anda tidak memiliki hak akses');
        }

        $reimbursement = Reimbursement::find($id);

        return view('reimbursement.edit', compact('reimbursement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reimbursement = Reimbursement::find($id);

        $validation_input = $this->customValidation($request, 'update');

        // Validation checking
        if ($validation_input->fails()) {
            return redirect()
                ->route('reimbursement.edit', $reimbursement->id)
                ->withErrors($validation_input->messages())
                ->withInput();
        }

        try {
            DB::beginTransaction();

                // Upload Document
                if ($request->file('document')) {
                    // Delete file
                    if ($reimbursement->document_file_path && file_exists(storage_path('app/public/' . $reimbursement->document_file_path))) {
                        Storage::delete('public/' . $reimbursement->document_file_path);
                    }

                    $file = General::uploadFile($request->file('document'), 'reimbursement', 'document/reimbursement', true, true);

                    $reimbursement->update([
                        'document_file_name' => $file['origin_file_save_name'],
                        'document_file_path' => $file['file_location'],
                    ]);
                }

                $reimbursement->update([
                    'date'         => $request->date,
                    'name'         => $request->name,
                    'description'  => $request->description,
                ]);

                DB::commit();

                return redirect()->route('reimbursement.index')
                    ->with('alert_type', 'success')
                    ->with('message', 'Add Reimbursement Successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reimbursement = Reimbursement::find($id);

        // Delete file
        if ($reimbursement->document_file_path && file_exists(storage_path('app/public/' . $reimbursement->document_file_path))) {
            Storage::delete('public/' . $reimbursement->document_file_path);
        }

        $reimbursement->delete();

        return $this->success($reimbursement, "Delete reimbursement data successfully");
    }

    /**
     * Use to initialize approve and rejected data
     *
     * @param Request $request
     * @param [type] $id
     * @return json
     */
    public function approveReimbursement(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $reimbursement = ReimburseApproval::create([
                'reimbursement_id'  => $request->reimbursement_id,
                'status'            => $request->status, // cek status. Approve = 1, Rejected = 0
                'note'              => $request->note,
                'approved_by'       => \Auth::user()->id,
                'approval_date'     => Carbon::now()->format('Y-m-d')
            ]);

            DB::commit();

            return $this->success($reimbursement, "Approval success!");

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
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
            'date'        => ['required'],
            'name'        => ['required'],
            'description' => ['required'],
            'document'    => ['required', 'mimes:jpg,jpeg,bmp,png,svg,pdf'],
        ];

        // Delete validation when updating data
        if ($type == 'update') {
            if (!$request->document) {
                unset($validation['document']);
            }
        //     // delete unused array key when updating data
        //     unset($validation['nip']);
        //     unset($validation['password']);

        //     // checking email
        //     $check_email = User::where('email', $request->email)
        //         ->where('nip', $request->nip)
        //         ->first();

        //     // Delete validation email
        //     if ($check_email) unset($validation['email'][1]);
        }

        return Validator::make($request->all(), $validation, [

        ]);
    }

}
