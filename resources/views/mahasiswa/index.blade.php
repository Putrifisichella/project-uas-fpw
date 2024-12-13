<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
  
  
    <div class="container p-4 mx-auto">
        <div class="overflow-x-auto">
  
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-500">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-500">
                    {{ session('error') }}
                </div>
            @endif

            <a href="{{ route('mahasiswa.export') }}">
                <button
                    class="px-6 py-4 text-black bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Export ke Excel
                </button>
  
            </a>  
  
            <div class="py-12">
       
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="container mx-auto mt-5">
                                <h2 class="mb-5 text-2xl font-bold">Buat Data Mahasiswa Baru</h2>
                                <x-auth-session-status class="mb-4" :status="session('success')" />
                                    <form action="{{ route('mahasiswa.store')}}" method="POST" class="space-y-4">
                                    @csrf <!-- Laravel CSRF protection -->
                                   
                                    <div class="form-group">
                                        <label for="product_name" class="block text-sm font-medium text-gray-700">NPM</label>
                                        <input type="text" id="npm" name="npm" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    </div>
                       
                                    <div class="form-group">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Nama</label>
                                        <input type="text" id="nama" name="nama" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    </div>
                       
                                    <div class="form-group">
                                        <label for="information" class="block text-sm font-medium text-gray-700">Prodi</label>
                                        <textarea id="prodi" name="prodi" rows="3" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                    </div>
                       
                                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
                                </form>
                            </div>
                       
                            @vite('resources/js/app.js') <!-- Include Vite's JS assets -->
                        </div>
                    </div>
                </div>
            </div>

            <table class="min-w-full border border-collapse border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">NPM</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Nama</th>
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Prodi</th>
                       <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
  
                    @foreach ($mahasiswa as $m)
                        <tr class="bg-white">
                            <td class="px-4 py-2 border border-gray-200">{{ $m->id }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $m->npm }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $m->nama }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $m->prodi }}</td>
                            <td class="px-4 py-2 border border-gray-200">
                                <button class="px-2 text-red-600 hover:text-red-800"
                                    onclick="confirmDelete('{{ route('mahasiswa.destroy', $m->id) }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
  
  
                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
  
  
    <script>
        function confirmDelete(deleteUrl) {
            console.log(deleteUrl);
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Jika user mengonfirmasi, kita dapat membuat form dan mengirimkan permintaan delete
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
  
                // Tambahkan CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
  
                // Tambahkan method spoofing untuk DELETE (karena HTML form hanya mendukung GET dan POST)
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
  
                // Tambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
  
  
  </x-app-layout>