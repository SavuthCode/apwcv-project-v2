<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use DB;
use ZipArchive;
use Clickatell\Rest;
use Clickatell\ClickatellException;

class SettingController extends Controller
{
    public function emptyDatabase()
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        $tables = DB::select('SHOW TABLES');
        $str = 'Tables_in_' . env('DB_DATABASE');
        foreach ($tables as $table) {
            if($table->$str != 'accounts' && $table->$str != 'general_settings' && $table->$str != 'hrm_settings' && $table->$str != 'languages' && $table->$str != 'migrations' && $table->$str != 'password_resets' && $table->$str != 'permissions' && $table->$str != 'pos_setting' && $table->$str != 'roles' && $table->$str != 'role_has_permissions' && $table->$str != 'users' && $table->$str != 'currencies') {
                DB::table($table->$str)->truncate();
            }
        }
        return redirect()->back()->with('message', 'Database cleared successfully');
    }
    public function generalSetting()
    {
        $lims_general_setting_data = GeneralSetting::latest()->first();
        $zones_array = array();
        $timestamp = time();
        foreach(timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return view('admin.setting.general_setting', compact('lims_general_setting_data',  'zones_array'));
    }

    public function generalSettingStore(Request $request)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $this->validate($request, [
            'site_logo' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);

        $data = $request->except('site_logo');
//        $path = '.env';
//        $searchArray = array('APP_TIMEZONE='.env('APP_TIMEZONE'));
//        $replaceArray = array('APP_TIMEZONE='.$data['timezone']);
//
//        file_put_contents($path, str_replace($searchArray, $replaceArray, file_get_contents($path)));

        $general_setting = GeneralSetting::latest()->first();
        $general_setting->id = 1;
        $general_setting->site_title = $data['site_title'];
        $general_setting->staff_access = $data['staff_access'];
        $general_setting->date_format = $data['date_format'];
        $general_setting->developed_by = $data['developed_by'];
        $general_setting->invoice_format = $data['invoice_format'];
        $general_setting->state = $data['state'];
        $logo = $request->site_logo;

        if ($logo) {
            $general_setting->site_logo = MyHelper::UploadImage($logo,'logo');
        }
        $general_setting->save();
        return redirect()->back()->with('message', 'Data updated successfully');
    }

    public function backup()
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        // Database configuration
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database_name = env('DB_DATABASE');

        // Get connection object and set the charset
        $conn = mysqli_connect($host, $username, $password, $database_name);
        $conn->set_charset("utf8");


        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {

            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            $sqlScript .= "\n\n" . $row[1] . ";\n\n";


            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);

            $columnCount = mysqli_num_fields($result);

            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i ++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j ++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\n";
        }

        if(!empty($sqlScript))
        {
            // Save the SQL script to a backup file
            $backup_file_name = public_path().'/'.$database_name . '_backup_' . time() . '.sql';
            //return $backup_file_name;
            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler);

            $zip = new ZipArchive();
            $zipFileName = $database_name . '_backup_' . time() . '.zip';
            $zip->open(public_path() . '/' . $zipFileName, ZipArchive::CREATE);
            $zip->addFile($backup_file_name, $database_name . '_backup_' . time() . '.sql');
            $zip->close();

            // Download the SQL backup file to the browser
            /*header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backup_file_name));
            ob_clean();
            flush();
            readfile($backup_file_name);
            exec('rm ' . $backup_file_name); */
        }
        return redirect('public/' . $zipFileName);
    }

    public function changeTheme($theme)
    {
        $lims_general_setting_data = GeneralSetting::latest()->first();
        $lims_general_setting_data->theme = $theme;
        $lims_general_setting_data->save();
    }


}
