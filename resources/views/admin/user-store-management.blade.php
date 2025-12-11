@extends('layouts.front')

@section('title', 'Manajemen User & Toko')

@section('content')
<div class="container mx-auto px-4 py-8">

    <h1 class="text-2xl font-semibold mb-6">Manajemen User & Toko</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <table class="min-w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-4 font-medium">Nama Pengguna</th>
                    <th class="py-3 px-4 font-medium">Email</th>
                    <th class="py-3 px-4 font-medium">Role</th>
                    <th class="py-3 px-4 font-medium">Toko</th>
                    <th class="py-3 px-4 font-medium">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-sm rounded bg-blue-100 text-blue-700">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td class="py-3 px-4">
                        {{ $user->store->name ?? '-' }}
                    </td>

                    <td class="py-3 px-4">
                        <a href="{{ route('admin.user.edit', $user->id) }}" 
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                           Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if ($users->isEmpty())
            <p class="text-gray-500 text-center py-6">Tidak ada data pengguna.</p>
        @endif
    </div>

</div>
@endsection
