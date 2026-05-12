<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAkad: Sistem Informasi Akademik</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-100 min-h-screen">

        <div x-data="{
            openCreate: false,
            openEdit: false,
            student: { id: '', name: '', email: '', prodi: '', angkatan: '', status: '' }
        }">
            <div class="max-w-6xl mx-auto py-10 px-6">

                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800">SIAkad</h1>
                        <p class="text-gray-500 mt-2">Sistem Informasi Akademik</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('dashboard') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg">
                            Dashboard
                        </a>
                        <button
                            @click="openCreate = true"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">
                            + Add Student
                        </button>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                    <!-- Table Header -->
                    <div class="grid grid-cols-6 bg-gray-50 border-b px-6 py-4 font-semibold text-gray-700">
                        <div>Name</div>
                        <div>Email</div>
                        <div>Prodi</div>
                        <div>Angkatan</div>
                        <div>Status</div>
                        <div class="text-center">Action</div>
                    </div>

                    <!-- Student Data -->
                    @foreach($students as $student)
                        <div class="grid grid-cols-6 items-center px-6 py-4 border-b hover:bg-gray-50 transition">

                            <div class="font-medium text-gray-800">{{ $student->name }}</div>
                            <div class="text-gray-600 text-sm">{{ $student->email }}</div>
                            <div class="text-gray-600">{{ $student->prodi ?? '-' }}</div>
                            <div class="text-gray-600">{{ $student->angkatan ?? '-' }}</div>
                            <div>
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $student->status === 'lulus' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($student->status ?? 'aktif') }}
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-center gap-2">
                                <button
                                    @click="
                                        openEdit = true;
                                        student.id = '{{ $student->id }}';
                                        student.name = '{{ $student->name }}';
                                        student.email = '{{ $student->email }}';
                                        student.prodi = '{{ $student->prodi }}';
                                        student.angkatan = '{{ $student->angkatan }}';
                                        student.status = '{{ $student->status }}';"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-lg text-sm">
                                    Ubah Data
                                </button>

                                <form
                                    action="{{ route('student.destroy', $student->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

            {{-- Modal --}}
            @include('student.form')

        </div>
    </body>
</html>