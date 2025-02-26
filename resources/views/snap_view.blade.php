@extends('layouts.app')

@section('title', 'Pembayaran Midtrans')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Silakan selesaikan pembayaran</h3>
            <p class="text-center">Transaksi ID: {{ session('transaction_id') }}</p>

            <button id="pay-button" class="btn btn-primary btn-block">Bayar Sekarang</button>
        </div>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let snapToken = "{{ $snap_token ?? '' }}";

        if (!snapToken) {
            alert("Snap Token tidak ditemukan!");
            window.location.href = "/pos"; // Redirect ke halaman POS jika token tidak ada
            return;
        }

        // Panggil modal pembayaran Midtrans secara otomatis
        snap.pay(snapToken, {
            onSuccess: function (result) {
                alert("Pembayaran berhasil!");
                console.log(result);
                window.location.href = "/transactions"; // Redirect ke halaman transaksi setelah sukses
            },
            onPending: function (result) {
                alert("Menunggu pembayaran, silakan selesaikan.");
                console.log(result);
                window.location.href = "/transactions"; // Redirect ke halaman transaksi jika masih pending
            },
            onError: function (result) {
                alert("Pembayaran gagal. Silakan coba lagi.");
                console.log(result);
                window.location.href = "/pos"; // Redirect ke halaman POS jika gagal
            },
            onClose: function () {
                alert("Pembayaran ditutup oleh pengguna.");
                window.location.href = "/pos"; // Redirect ke halaman POS jika ditutup tanpa bayar
            }
        });
    });
</script>

@endsection
