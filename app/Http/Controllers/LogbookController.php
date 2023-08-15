<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logbook = Auth::user()->logbook()->orderBy('created_at', 'desc')->get();
        return view('logbook.index', compact('logbook'));
    }

    public function monitor()
    {
        $user = Auth::user();
        $logbook = null;

        if ($user->role === 'KepalaDinas') {
            // KepalaDinas memantau semua logbook yang belum disetujui oleh KepalaBidang
            $logbook = Logbook::with('user')->whereHas('user', function ($query) {
                $query->where('role', 'KepalaBidang');
            })->get();
        } elseif ($user->role === 'KepalaBidang') {
            // KepalaBidang memantau semua logbook yang belum disetujui oleh Staff
            $logbook = Logbook::with('user')->whereHas('user', function ($query) {
                $query->where('role', 'Staff');
            })->get();
        }

        if ($logbook === null) {
            return redirect()->route('logbook.index')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return view('logbook.monitor', compact('logbook'));
    }

    public function approve(Logbook $logbook)
    {
        // Lakukan proses approve di sini
        $logbook->status = 'Approved';
        $logbook->save();

        return redirect()->route('logbook.monitor')->with('success', 'Logbook berhasil diapprove.');
    }

    public function reject(Logbook $logbook)
    {
        // Lakukan proses reject di sini
        $logbook->status = 'Rejected';
        $logbook->save();

        return redirect()->route('logbook.monitor')->with('success', 'Logbook berhasil direject.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('logbook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'daily_log' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        $logbook = new Logbook([
            'user_id' => Auth::id(),
            'daily_log' => $request->input('daily_log'),
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName(); // Get the original file name
            $imagePath = $file->storeAs('logbook_images', $imageName, 'public'); // Store file with original name
            $logbook->image = $imagePath; // Save image path to the database
        }
    
        $logbook->save();
        return redirect()->route('logbook.index')->with('success', 'Berhasil menambahkan logbook');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Logbook $logbook)
    {
        return view('logbook.edit', compact('logbook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logbook $logbook)
    {
        $request->validate([
            'daily_log' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        $logbook->daily_log = $request->input('daily_log');
    
        if ($request->hasFile('image')) {
            if ($logbook->image) {
                Storage::disk('public')->delete($logbook->image);
            }
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName(); // Get the original file name
            $imagePath = $file->storeAs('logbook_images', $imageName, 'public'); // Store file with original name
            $logbook->image = $imagePath; // Save image path to the database
        }
    
        if ($logbook->status === 'Rejected') {
            $logbook->status = 'Pending';
        }
    
        $logbook->save();
    
        return redirect()->route('logbook.index')->with('success', 'Logbook harian berhasil diperbarui!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logbook $logbook)
    {
        $logbook->delete();
        Storage::disk('public')->delete($logbook->image);

        return redirect()->route('logbook.index')->with('success', 'Logbook harian berhasil dihapus!');
    }
}