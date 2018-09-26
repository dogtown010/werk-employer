<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Employer;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;

class EmployersController extends Controller
{
    public function index(){

        $employers = Employer::orderBy('CompanyName')->paginate(20);

        return view("welcome", compact('employers'));
    }

    public function edit($id){

        $employers = Employer::where('ID', $id)->first();

        return view("edit", compact('employers'));
    }

    public function delete($id){

        $employers = Employer::where('ID', $id)->delete();

        return redirect("/")->with('status', 'Client successfully deleted!');
    }

    public function store (Request $object){

        $rules = ['name' => 'required',
                  'email' => 'required|unique:tblemployee,EmailAddress',
                  'lnumber' => 'required|numeric'
                ];

        $messages = ['name.required' => 'Please enter the Company Name',
                     'email.unique' => 'The email address has been registered before',
                     'lnumber' => 'Please enter a valid landline number'
                    ];

        $validator = Validator::make($object->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('?validate=yes')
                    ->withErrors($validator)
                    ->withInput();
        }

        $request = new Employer;

        $request->CompanyName = $object->name;
        $request->CompanyAddress = $object->address;
        $request->Industry = $object->industry;
        $request->Classification = $object->classification;
        $request->ContactPerson = $object->person;
        $request->Position = $object->position;
        $request->ContactNumberLandline = $object->lnumber;
        $request->ContactNumberMobile = $object->input('mnumber', '');
        $request->EmailAddress = $object->email;

        $request->save();


        return redirect("/")->with('status', 'Client successfully added!');
    }

    public function processEdit (Request $object){

        $rules = ['name' => 'required',
                  'email' => 'required|email',
                  'lnumber' => 'required|numeric'
                ];

        $messages = ['name.required' => 'Please enter the Company Name',
                     'email.email' => 'Please enter a valid email',
                     'lnumber' => 'Please enter a valid landline number'
                    ];

        $validator = Validator::make($object->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/edit/'.$object->id)
                    ->withErrors($validator)
                    ->withInput();
        }

        $request = Employer::where('ID', $object->id)->first();

        $request->CompanyName = $object->name;
        $request->CompanyAddress = $object->address;
        $request->Industry = $object->industry;
        $request->Classification = $object->classification;
        $request->ContactPerson = $object->person;
        $request->Position = $object->position;
        $request->ContactNumberLandline = $object->lnumber;
        $request->ContactNumberMobile = $object->input('mnumber', '');
        $request->EmailAddress = $object->email;

        $request->save();


        return redirect("/")->with('status', 'Client '.$request->CompanyName.' successfully updated!');
    }

    public function export() {

        $fileName = "CLIENTS_" . date('Y-m-d H:i:s') . ".csv";
        $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=".$fileName,
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

        $employers = Employer::all();
        $columns = array("Company Name","Address", "Industry", "Classification", 
                                "Contact Person", "Position","Landline Number","Mobile Number", "Email Address");

        $callback = function() use ($employers, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($employers as $employer) {
                fputcsv($file, array($employer->CompanyName, $employer->CompanyAddress, $employer->Industry, $employer->Classification, $employer->ContactPerson, $employer->Position, $employer->ContactNumberLandline, $employer->ContactNumberMobile, $employer->EmailAddress));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function import(){
        return view('fileupload');
    }

    public function processImport(Request $request)
    {
        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);
        
        array_pop($rows);

        foreach($rows as $row){
            //print_r($row); die();
            $row = array_combine($header, $row);

            $email = Employer::where('EmailAddress', $row['email'])->first();

            if(count($email)){
                return redirect("/")->with('status', 'Email '.$row['email'].' is already in the database');
            }

            Employer::create([
                'CompanyName' => $row['name'],
                'CompanyAddress' => $row['address'],
                'Industry' => $row['industry'],
                'Classification' => $row['classification'],
                'ContactPerson' => $row['person'],
                'Position' => $row['position'],
                'ContactNumberLandline' => $row['landline'],
                'ContactNumberMobile' => $row['mobile'],
                'EmailAddress' => $row['email']
            ]);
        }

        return redirect("/")->with('status', 'Import success!');
    }

    public function search(Request $object){

        $key = $object->search;
        $employers = Employer::where('CompanyName', 'like', '%'.$key.'%')
                        ->orWhere('CompanyAddress', 'like', '%'.$key.'%')
                        ->orWhere('Industry', 'like', '%'.$key.'%')
                        ->orWhere('Classification', 'like', '%'.$key.'%')
                        ->orWhere('ContactPerson', 'like', '%'.$key.'%')
                        ->orWhere('Position', 'like', '%'.$key.'%')
                        ->orWhere('ContactNumberLandline', 'like', '%'.$key.'%')
                        ->orWhere('ContactNumberMobile', 'like', '%'.$key.'%')
                        ->orWhere('EmailAddress', 'like', '%'.$key.'%')
                        ->paginate(15);

        return view("welcome", compact('employers'));
    }

    public function format() {

        $fileName = "IMPORT_FORMAT.csv";
        $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=".$fileName,
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

        $columns = array("name","address", "industry", "classification", 
                                "person", "position","landline","mobile", "email");

        $callback = function() use ($columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, array("WeRK","Robinsons Eqiutable Tower", "Marketing", "Company", "Dianne Chan", "Sales Support", "5709739", " ", "dianne@werk.ph"));
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

}
