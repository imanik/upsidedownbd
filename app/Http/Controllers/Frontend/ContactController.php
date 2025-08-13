<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::latest()->get();
        $params = [
            'contacts' => $contacts,
        ];
        return view('dashboard.contact.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('dashboard.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $statuses = implode(',', config('upsidedown.branch.statuses'));

        $request->validate([
            'name'          => ['required', 'string', 'max:191'],
            'mobile'       => ['required', 'digits_between:11,13'],
            'address'       => ['nullable', 'string', 'max:191'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'child_price'   => ['required', 'numeric', 'min:0'],
            'status'        => ['required', 'in:' . $statuses],
        ]);

        $contact                 = new Contact;
        $contact->name           = $request->name;
        $contact->mobile        = $request->mobile;
        $contact->address        = $request->address;
        $contact->regular_price  = $request->regular_price;
        $contact->child_price    = $request->child_price;
        $contact->status         = $request->status;
        if (!$contact->save()) {
            return back()->withInput()->with('fail', __('Contact creation request failed!'));
        }
        return back()->with('success', __('Contact added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Contact  $contact
     * @return Response
     */
    public function show(Contact $contact)
    {
        $params = [
            'contact' => $contact
        ];
        return view('dashboard.contact.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact  $contact
     * @return Response
     */
    public function edit(Contact $contact)
    {
        $params = [
            'contact' => $contact
        ];
        return view('dashboard.contact.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Contact  $contact
     * @return Response
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:191'],
            'mobile'       => ['required', 'string', 'max:191'],
            'address'       => ['nullable', 'string', 'max:191'],
            'regular_price' => ['required', 'string', 'max:191'],
            'child_price'   => ['required', 'string', 'max:20'],
            'status'        => ['nullable', 'string', 'max:191'],
        ]);

        $contact->name           = $request->name;
        $contact->mobile        = $request->mobile;
        $contact->address        = $request->address;
        $contact->regular_price  = $request->regular_price;
        $contact->child_price    = $request->child_price;
        $contact->status         = $request->status;
        if (!$contact->save()) {
            return back()->withInput()->with('fail', __('Contact modification request failed!'));
        }
        return back()->with('success', __('Contact modified successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact  $contact
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        if (!$contact->delete()) {
            return back()->withInput()->with('fail', __('Contact removing request failed!'));
        }
        return back()->with('success', __('Contact removed successfully'));
    }
}
