<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    // /
    //  * Menampilkan form kontak untuk publik.
    //  */
    public function form()
    {
        return view('contact'); // Pastikan file resources/views/contact.blade.php ada
    }

    // /
    //  * Proses pengiriman pesan dari form kontak.
    //  */
    public function send(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Simpan ke database
        ContactMessage::create($validatedData);

        // Simpan ke log (opsional)
        Log::info('📥 Pesan kontak diterima:', $validatedData);

        // Redirect balik dengan pesan sukses
        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim!');
    }

    /**
     * Tampilkan semua pesan masuk untuk Admin.
     */
    public function inbox()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.message', compact('messages'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.inbox')->with('success', 'Pesan berhasil dihapus.');
    }
    
}
