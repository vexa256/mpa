<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function createManagementFiles()
    {
        // Database credentials
        $DB_USER = "hacker";
        $DB_PASS = "kamukama";
        $DB_NAME = "payroll";

        // Path where the directories will be created
        $BASE_PATH = "/var/www/html/payroll.local/sys";

        // Get a list of tables from the database
        $tables = DB::select('SHOW TABLES');

        // Loop through the table names
        foreach ($tables as $tableObj) {
            $table = (array) $tableObj;
            $table = reset($table);

            // Convert the table name to PascalCase (first letter of each word capitalized)
            $folder_name = Str::studly($table);

            // Check if the directory already exists
            if (!File::isDirectory($BASE_PATH . '/' . $folder_name)) {
                // Create the directory
                File::makeDirectory($BASE_PATH . '/' . $folder_name);
                echo "Created directory: " . $BASE_PATH . '/' . $folder_name . PHP_EOL;
            } else {
                echo "Directory already exists: " . $BASE_PATH . '/' . $folder_name . PHP_EOL;
            }

            // Create MgtTablename file with given HTML code
            $file_name = "Mgt" . $folder_name . '.blade.php';
            $file_path = $BASE_PATH . '/' . $folder_name . '/' . $file_name;

            if (!File::isFile($file_path)) {
                // Get the list of columns for the current table
                $columns = DB::select("SHOW COLUMNS FROM $table");

                // Prepare the table rows
                $table_rows = "";
                foreach ($columns as $columnObj) {
                    $column = (array) $columnObj;
                    $column = reset($column);
                    $table_rows .= "<td>{{ \$data->$column }}</td>";
                }

                // Create the MgtTablename file with the given HTML code
                $html_content = <<<EOM
                <div class="row">

                    <div class="col-12">

                        {{ HeaderBtn(\$Toggle = 'New', \$Class = 'btn-danger float-end', \$Label = 'New Beneficiary', \$Icon = 'fa-plus') }}
                    </div>

                </div>
                <div class="card-body px-5 py-5 bg-light shadow-lg table-responsive">
                    <table class="mytable table table-rounded table-bordered border gy-3 gs-3">
                        <thead>
                            <tr class="fw-bold text-gray-800 border-bottom border-gray-200">
                                $table_rows
                                <th class="bg-dark text-light">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset(\$DatabaseData)
                                @foreach (\$DatabaseData as \$data)
                                    <tr>
                                        $table_rows
                                        <td>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-sm btn-secondary dropdown-toggle"
                                                    type="button" id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Choose Action
                                                </button>
                                                <ul class="dropdown-menu"
                                                    aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <a data-bs-toggle="modal"
                                                            href="#Update{{ \$data->id }}"
                                                            class="dropdown-item"
                                                            href="#">Update</a>
                                                    </li>
                                                    <li>
                                                        <a data-msg="You want to delete this record. This action is not reversible!!"
                                                            data-route="{{ route('MassDelete', ['TableName' => '$table', 'id' => \$data->id]) }}"
                                                            class="dropdown-item deleteConfirm"
                                                            href="#">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>

                <!--end::Card body-->

                @include('Beneficiary.NewBeneficiary')

                @isset(\$Roles)
                    @foreach (\$Roles as \$up)
                        {{ UpdateModalHeader(\$Title = 'Update the selected  record', \$ModalID = \$up->id) }}
                        <form action="{{ route('MassUpdate') }}" class="" method="POST">
                            @csrf

                            <div class="row">

                                <div class="mb-3 col-md-12 pt-3">
                                    <label id="label" for=""
                                        class=" required form-label">Select
                                        Parent Cluster</label>
                                    <select required name="ClusterID"
                                        class="form-select   form-select-solid"
                                        data-control="select2" data-placeholder="Select an option">

                                        <option value="{{ \$up->ClusterID }}">
                                            {{ \$up->ClusterName }}</option>

                                        @isset(\$Clusters)
                                            @foreach (\$Clusters as \$data)
                                                <option value="{{ \$data->ClusterID }}">
                                                    {{ \$data->ClusterName }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>

                                <input type="hidden" name="id" value="{{ \$up->id }}">

                                <input type="hidden" name="TableName" value="$table">

                                {{ RunUpdateModalFinal(\$ModalID = \$up->id, \$Extra = '', \$csrf = null, \$Title = null, \$RecordID = \$up->id, \$col = '4', \$te = '12', \$TableName = '$table') }}
                            </div>

                            {{ _UpdateModalFooter() }}

                        </form>
                    @endforeach
                @endisset


                EOM;

                File::put($file_path, $html_content);

                echo "Created file: " . $file_path . PHP_EOL;
            } else {
                echo "File already exists: " . $file_path . PHP_EOL;
            }
        }
    }

}
