<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
// app/Helpers/InputTypeValidation.php

    public function MassInsert(Request $request)
    {
        $TableName = $request->TableName;
        $tableColumns = Schema::getColumnListing($TableName);
        $data = $request->except(['_token', 'id', 'TableName']);
        $rules = [];
        $uploadedFiles = [];

        // Build validation rules based on table columns and input types
        foreach ($tableColumns as $column) {
            if ($request->hasFile($column)) {
                $rules[$column] = 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:80000';
            } else {
                $rules[$column] = 'nullable';
            }
        }

        // Validate request data
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Process form data
        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $uploadedFiles[$key] = $this->moveUploadedFile($request->file($key));
            }
        }

        // Insert data into the table
        try {
            $insertData = array_merge($data, $uploadedFiles);
            DB::table($TableName)->insert($insertData);
        } catch (\Exception $e) {
            dd($e);
            return back()->withErrors(['error_a' => 'Failed to insert data.'])->withInput();
        }

        return redirect()->back()->with('status', 'Data inserted successfully.');
    }

    private function moveUploadedFile($file)
    {
        if (!$file) {
            return null;
        }

        $destinationPath = public_path('assets/docs');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return 'assets/docs/' . $fileName;
    }

    private function removeNullValues($array)
    {
        return array_filter($array, function ($value) {
            return !is_null($value);
        });
    }

    public function MassUpdate(Request $request)
    {
        $TableName = $request->TableName;
        $tableColumns = Schema::getColumnListing($TableName);
        $data = $request->except(['_token', 'id', 'TableName']);
        $rules = [];
        $uploadedFiles = [];

        // Build validation rules based on table columns and input types
        foreach ($tableColumns as $column) {
            if ($request->hasFile($column)) {
                $rules[$column] = 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:80000';
            } else {
                $rules[$column] = 'nullable';
            }
        }

        // Validate request data
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Process form data
        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $uploadedFiles[$key] = $this->moveUploadedFile($request->file($key));
            }
        }

        // Update data in the table
        try {

            $updateData = array_merge($data, $uploadedFiles);
            $id = $request->id;

            // unset($updateData['id']);
            DB::table($TableName)->where('id', $request->id)->update($this->removeNullValues($updateData));
        } catch (\Exception $e) {
            dd($e);
            return back()->withErrors(['error' => 'Failed to update data.'])->withInput();
        }

        return redirect()->back()->with('status', 'Data updated successfully.');
    }

    public function MassDelete($TableName, $id)
    {
        DB::table($TableName)->where('id', $id)->delete();

        return redirect()
            ->back()
            ->with('status', 'The record was deleted successfully');
    }

}
