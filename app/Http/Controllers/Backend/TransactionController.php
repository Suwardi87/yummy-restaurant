<?php
namespace App\Http\Controllers\Backend;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Mail\BookingMailConfirm;
use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Http\Services\MiddlewareService;

class TransactionController extends Controller
{
    public function __construct( private MiddlewareService $MiddlewareService
    ){
        $this->MiddlewareService->aksesRole();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);

        return view('backend.transaction.index', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        // Menampilkan detail transaksi
        $transaction = Transaction::where('uuid', $uuid)->firstOrFail();
        $review = Review::where('transaction_id', $transaction->id)->first();

        return view('backend.transaction.show', [
            'transaction' => $transaction,
            'review' => $review
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Redirect untuk owner
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.download');
        }

        // Validasi input
        $data = $request->validate([
            'status' => 'required|in:pending,success,failed'
        ]);

        try {
            $transaction = Transaction::where('uuid', $id)->firstOrFail();
            $transaction->status = $data['status'];
            $transaction->save();

            // Mengirim email konfirmasi
            Mail::to($transaction->email)
                ->cc('suwardyser87@gmail.com') // Pastikan email ini sesuai dengan kebutuhan Anda
                ->send(new BookingMailConfirm($transaction));

            return redirect()->back()->with('success', 'Transaction status updated successfully');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Download transactions within a specific date range.
     */
    public function download(Request $request)
    {

        // Validasi input
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        // Batasi hak akses
        if (Session::get('role') === 'owner') {
            return redirect()->route('panel.transaction.index');
        }

        try {
            return Excel::download(new TransactionExport($data['start_date'], $data['end_date']), 'transactions.xlsx');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }
}

