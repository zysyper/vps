<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderitem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar pesanan user
    public function index()
    {
        $my_orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pages.myorder', [
            'orders' => $my_orders,
        ]);
    }

    public function payment($order_id)
    {
        // Cek apakah order ada dan milik pengguna yang sedang login
        $order = Order::where('id', $order_id)
            ->where('user_id', auth()->id())
            ->first();

        // Jika order tidak ditemukan, tampilkan error
        if (!$order) {
            abort(404, 'Order tidak ditemukan');
        }

        return view('pages.payment', compact('order'));
    }



    // Menampilkan detail pesanan
    public function show($order_id)
    {
        $user = User::find(auth()->user()->id);

        // Load order dengan security check
        $order = Order::where('id', $order_id)
            ->where('user_id', auth()->id()) // Security: pastikan order milik user yang login
            ->firstOrFail();

        // Load order items
        $order_items = OrderItem::with('produk')
            ->where('order_id', $order_id)
            ->get();

        return view('pages.myorder-detail', [
            'order' => $order,
            'order_items' => $order_items,
            'user' => $user
        ]);
    }


    public function cancel(Request $request, Order $order)
    {
        try {
            // Check if the order belongs to the authenticated user
            if ($order->user_id !== Auth::id()) {
                return redirect()->route('my-orders')
                    ->with('error', 'You are not authorized to cancel this order.');
            }

            // Check if the order can be cancelled (only 'new' status orders)
            if ($order->status !== 'new') {
                return redirect()->route('my-orders')
                    ->with('error', 'This order cannot be cancelled. Current status: ' . ucfirst($order->status));
            }

            if ($order->payment_status !== 'pending') {
                return redirect()->route('my-orders')
                    ->with('error', 'This order cannot be cancelled. Current status: ' . ucfirst($order->payment_status));
            }

            // Begin database transaction
            DB::beginTransaction();

            // Update order status to cancelled
            $order->update([
                'payment_status' => 'failed',
                'status' => 'canceled',
                'canceled_at' => now(),
                'canceled_by' => Auth::id(),
                'cancellation_reason' => 'Cancelled by customer'
            ]);


            DB::commit();

            return redirect()->route('my-orders')
                ->with('success', 'Order has been cancelled successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('my-orders')
                ->with('error', 'Failed to cancel order. Please try again or contact support.');
        }
    }

    public function submitPaymentProof(Request $request, $order_id)
    {
        // Validasi input - ubah payment_proof menjadi file
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,webp|max:5120', // Ubah dari payment_proof ke file
        ]);

        // Ambil order berdasarkan order_id dan pastikan milik pengguna yang sedang login
        $order = Order::where('id', $order_id)
            ->where('user_id', auth()->id())
            ->first();

        // Jika order tidak ditemukan, tampilkan error
        if (!$order) {
            return redirect()->back()->withErrors(['order_id' => 'Order tidak ditemukan atau bukan milik Anda.']);
        }

        // Periksa status order sebelum upload
        if ($order->payment_status !== 'pending') {
            return redirect()->back()->withErrors(['file' => 'Pembayaran sudah diproses atau tidak dapat diubah.']);
        }

        // Jika ada file bukti pembayaran
        if ($request->hasFile('file')) {
            try {
                // Ambil file yang diupload
                $proofFile = $request->file('file');

                // Validasi file secara manual jika diperlukan
                if (!$proofFile->isValid()) {
                    return redirect()->back()->withErrors(['file' => 'File tidak valid atau rusak.']);
                }

                // Tentukan path untuk menyimpan file
                $filePath = $proofFile->store('payment_proofs', 'public');

                // Ambil nama asli file dan tipe MIME
                $fileName = $proofFile->getClientOriginalName();
                $mimeType = $proofFile->getMimeType();

                // Gunakan DB transaction untuk keamanan
                DB::beginTransaction();

                // Simpan data file di database
                $order->payment_proof_path = $filePath;
                $order->payment_proof_name = $fileName;
                $order->payment_proof_mime = $mimeType;
                $order->payment_status = 'paid';
                $order->save();

                DB::commit();

                // Feedback untuk user
                return redirect()->route('my-orders')->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi.');
            } catch (\Exception $e) {
                DB::rollback();

                // Log error untuk debugging
                Log::error('Payment proof upload failed: ' . $e->getMessage());

                return redirect()->back()->withErrors(['file' => 'Gagal mengupload bukti pembayaran. Silakan coba lagi.']);
            }
        }

        // Jika tidak ada file yang diupload
        return redirect()->back()->withErrors(['file' => 'Bukti pembayaran wajib diupload.']);
    }
}
