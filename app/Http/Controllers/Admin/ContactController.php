<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $lims_contact_all = Contact::get();
        return view('admin.contact.index', compact('lims_contact_all'));
    }

    public function create()
    {
        return view('admin.contact.create');

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $message = 'Contact created successfully';
        Contact::create($data);
        return redirect('contacts')->with('message', $message);
    }

    public function update(Request $request, $id)
    {
        $lims_contact_data = Contact::find($request['contact_id']);
        $data = $request->all();
        $lims_contact_data->update($data);
        return redirect('contacts')->with('message', 'Contact updated successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $employee_id = $request['contactIdArray'];
        foreach ($employee_id as $id) {
            $lims_employee_data = Contact::find($id);
            $lims_employee_data->is_active = false;
            $lims_employee_data->save();
        }
        return 'Contact deleted successfully!';
    }
    public function destroy($id)
    {
        $lims_contact_data = Contact::find($id);
        $lims_contact_data->delete();
        return redirect('contacts')->with('not_permitted', 'Contact deleted successfully');
    }
}
