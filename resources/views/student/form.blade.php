<!-- CREATE MODAL -->
<div
    x-show="openCreate"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-2xl w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">
            Tambah Data Mahasiswa
        </h2>
        <form action="{{ route('student.store') }}" method="POST">
            @csrf
            <input type="text"
                name="name"
                placeholder="Nama"
                class="w-full border p-3 rounded-lg mb-4">
            <input type="email"
                name="email"
                placeholder="Email"
                class="w-full border p-3 rounded-lg mb-4">
            <input type="text"
                name="prodi"
                placeholder="Program Studi"
                class="w-full border p-3 rounded-lg mb-4">
            <input type="number"
                name="angkatan"
                placeholder="Angkatan (contoh: 2022)"
                class="w-full border p-3 rounded-lg mb-4">
            <select name="status" class="w-full border p-3 rounded-lg mb-4">
                <option value="aktif">Aktif</option>
                <option value="lulus">Lulus</option>
            </select>
            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    @click="openCreate = false"
                    class="bg-gray-300 px-4 py-2 rounded-lg">
                        Batal
                </button>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div
    x-show="openEdit"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Ubah Data Mahasiswa
            </h2>
            <button
                @click="openEdit = false"
                class="text-2xl text-gray-500 hover:text-gray-700">
                &times;
            </button>
        </div>
        <form
            :action="'/student/' + student.id"
            method="POST"
            class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 font-medium mb-2">Nama</label>
                <input type="text" name="name" x-model="student.name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" x-model="student.email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Program Studi</label>
                <input type="text" name="prodi" x-model="student.prodi"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Angkatan</label>
                <input type="number" name="angkatan" x-model="student.angkatan"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-3">
                    <option value="aktif" :selected="student.status === 'aktif'">Aktif</option>
                    <option value="lulus" :selected="student.status === 'lulus'">Lulus</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" @click="openEdit = false"
                    class="bg-gray-300 hover:bg-gray-400 px-5 py-2 rounded-lg">
                        Batal
                </button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>