<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Mail\ReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Form::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        $forms = $query->paginate(10);
        return view('admin.dashboard-form', compact('forms'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->contact_name,
            'email' => $request->contact_email,
            'message' => $request->contact_message,
        ];

        Form::create($data);

        return redirect()->route('welcome')->with('success', 'Form submitted successfully.');
    }

    public function reply(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'reply_message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = Form::findOrFail($id);
        $replyMessage = $request->input('reply_message');

        Mail::to($form->email)->send(new ReplyMail($replyMessage));

        return redirect()->route('admin.dashboard.form')->with('success', 'Reply sent successfully.');
    }

    public function destroy($id)
    {
        Form::destroy($id);
        return redirect()->route('admin.dashboard.form')->with('success', 'Form deleted successfully.');
    }
}
