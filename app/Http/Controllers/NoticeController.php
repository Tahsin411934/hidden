<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $notices = Notice::latest()->paginate(10);
    return view('central.notices.index', compact('notices'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('central.notices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('notices', 'public');
        }

        Notice::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'pdf_path' => $pdfPath,
        ]);

        return redirect()->back()->with('success', 'Notice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        return view('notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        return view('notices.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $pdfPath = $notice->pdf_path;
        if ($request->hasFile('pdf')) {
            // Delete old file if exists
            if ($notice->pdf_path) {
                Storage::disk('public')->delete($notice->pdf_path);
            }
            $pdfPath = $request->file('pdf')->store('notices', 'public');
        }

        $notice->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'pdf_path' => $pdfPath,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        if ($notice->pdf_path) {
            Storage::disk('public')->delete($notice->pdf_path);
        }
        $notice->delete();
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully.');
    }
}