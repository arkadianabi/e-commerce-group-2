@extends('layouts.front')

@section('title', 'Verifikasi Toko')

@section('content')
<div class="container mx-auto px-4 py-8">

    <h1 class="text-2xl font-semibold mb-6">Verifikasi Toko</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <table class="min-w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-4 font-medium">Nama Toko</th>
                    <th class="py-3 px-4 font-medium">Pemilik</th>
                    <th class="py-3 px-4 font-medium">Tanggal Daftar</th>
                    <th class="py-3 px-4 font-medium">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($stores as $store)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $store->name }}</td>
                    <td class="py-3 px-4">{{ $store->owner->name }}</td>
                    <td class="py-3 px-4">{{ $store->created_at->format('d M Y') }}</td>

                    <td class="py-3 px-4 flex gap-2">

                        <!-- Approve -->
                        <form action="{{ route('admin.store.verify', $store->id) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Approve
                            </button>
                        </form>

                        <!-- Reject -->
                        <form action="{{ route('admin.store.reject', $store->id) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Reject
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if ($stores->isEmpty())
            <p class="text-gray-500 text-center py-6">Tidak ada pengajuan toko baru.</p>
        @endif
    </div>

</div>
@endsection
