@extends('layout.card')

@section('title', 'Kontrol Olahraga')

@section('content')

        @if($aktivitas->isEmpty())
        <!-- Jika Data Belum Di tambahkan -->
        <div class="px-5 w-full mt-4">
            <div class="flex flex-row items-center justify-center bg-[#0BB4A6] py-3 rounded-xl">
                <h5 class="font-semibold text-[0.65rem] text-center">
                    "Olahraga minimal 30 menit sehari dapat <br>
                    membantu menjaga gula darah stabil <br>
                    dan tubuh lebih sehat!"
                </h5>
            </div>
        </div>

        <div class="flex flex-row justify-center items-center gap-2 mt-2">
            <!-- ADD -->
            <a href="#" class="p-2 mt-2 bg-[#D9D9D9] rounded-lg" onclick="openModal()">
                <h2 class="text-xs px-2">Buat Jadwal</h2>
            </a>
        </div>

        <div class="w-full flex flex-col justify-start items-center h-full p-5">
            <div
                class="w-[150px] h-[150px] flex justify-center items-center">
                <lord-icon
                    src="https://cdn.lordicon.com/lltgvngb.json"
                    trigger="loop"
                    delay="500"
                    stroke="light"
                    colors="primary:#121331,secondary:#0bb4a6"
                    class="w-full h-full">
                </lord-icon>
            </div>
            <p class="text-base font-semibold text-center">Jadwal Olahraga Belum ditambahkan</p>
        </div>
        @else

        <!-- Jika Data Sudah Di tambahkan (Foreach) -->
        <p class="text-sm font-semibold text-center mt-4 mb-2">Jadwal Olahraga</p>
        <div class="flex flex-col gap-2 w-full h-full px-5">
        @foreach($aktivitas as $aktivitas)
            <div class="w-full bg-[#0BB4A6] rounded-xl py-2 px-3 flex flex-col">
                <div class="flex flex-row justify-between items-center">
                    <div class="flex flex-col items-start">
                        <p class="text-[13px] font-semibold text-black">
                            {{ \Carbon\Carbon::parse($aktivitas->tanggal)->translatedFormat('l, j F Y') }}</p>
                        <p class="text-xs font-reguler text-black">
                            {{ $aktivitas->jenis_olahraga }}</p>
                        <p class="text-xs font-reguler text-black">
                            {{ \Carbon\Carbon::parse($aktivitas->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($aktivitas->waktu_selesai)->format('H:i') }}</p>
                        <p class="text-xs font-reguler text-black">
                            {{ \Carbon\Carbon::parse($aktivitas->waktu_mulai)->diffInMinutes(\Carbon\Carbon::parse($aktivitas->waktu_selesai)) }} Menit</p>
                    </div>

                    <!-- DELETE -->
                    <form action="{{ route('kontrol.aktivitas.hapus', $aktivitas->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg">
                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="scale-110">
                                <path d="M13.2951 3.55666H0.705566" stroke="#000000" stroke-width="1.11083"
                                    stroke-linecap="round" />
                                <path
                                    d="M12.0609 5.40806L11.7202 10.5172C11.5892 12.4833 11.5236 13.4664 10.883 14.0657C10.2425 14.665 9.25722 14.665 7.28675 14.665H6.71408C4.74357 14.665 3.75834 14.665 3.11775 14.0657C2.47717 13.4664 2.41163 12.4833 2.28055 10.5172L1.93994 5.40806"
                                    stroke="#000000" stroke-width="1.11083" stroke-linecap="round" />
                                <path d="M5.14893 7.25945L5.5192 10.9622" stroke="#000000" stroke-width="1.11083"
                                    stroke-linecap="round" />
                                <path d="M8.85172 7.25945L8.48145 10.9622" stroke="#000000" stroke-width="1.11083"
                                    stroke-linecap="round" />
                                <path
                                    d="M2.92725 3.55667C2.96863 3.55667 2.98932 3.55667 3.00808 3.55619C3.61788 3.54074 4.15584 3.153 4.36335 2.57937C4.36973 2.56172 4.37627 2.5421 4.38935 2.50283L4.46126 2.28714C4.52263 2.10301 4.55332 2.01095 4.59402 1.93278C4.75643 1.62091 5.05689 1.40434 5.40412 1.3489C5.49115 1.335 5.58821 1.335 5.78231 1.335H8.21829C8.41239 1.335 8.50948 1.335 8.5965 1.3489C8.94374 1.40434 9.24419 1.62091 9.40659 1.93278C9.44732 2.01095 9.47798 2.10301 9.53937 2.28714L9.61128 2.50283C9.62431 2.54205 9.6309 2.56174 9.63727 2.57937C9.84478 3.153 10.3827 3.54074 10.9926 3.55619C11.0113 3.55667 11.032 3.55667 11.0734 3.55667"
                                    stroke="#000000" stroke-width="1.11083" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
        <div class="flex flex-row justify-center items-center">
            <!-- ADD -->
            <a href="#" class="p-2 bg-[#D9D9D9] rounded-lg" onclick="openModal()">
                <h2 class="text-xs px-2">Buat Jadwal</h2>
            </a>
        </div>
        @endif
        </div>


    <!-- MODAL -->
    <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
            <h1 class="text-xl font-bold text-center text-[#0BB4A6]">Masukan Jadwal</h1>

            <!-- Form di dalam modal -->
            <form class="mt-4 flex flex-col gap-2" action="{{ route('kontrol.aktivitas.simpan') }}" method="POST">
                @csrf
                <!-- Menambahkan token CSRF untuk keamanan -->
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal"
                    class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="Tanggal" required />

                <label for="kategori">Nama Olahraga</label>
                <select name="jenis_olahraga"
                    class="px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required>
                    <option value="" disabled selected>Pilih nama olahraga</option>
                    <option value="Jogging">Jogging</option>
                    <option value="Pilates">Pilates</option>
                    <option value="Gym">Gym</option>
                    <option value="Zumba">Zumba</option>
                    <option value="Yoga">Yoga</option>
                    <option value="Bersepeda">Bersepeda</option>
                    <option value="Berenang">Berenang</option>
                </select>

                <label for="waktu_mulai">Mulai</label>
                <input type="time" id="waktu_mulai" name="waktu_mulai"
                    class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="Pukul" required />

                <label for="waktu_selesai">Selesai</label>
                <input type="time" id="waktu_selesai" name="waktu_selesai"
                class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                placeholder="Pukul" required />
                
                <label for="durasi">Durasi Olahraga</label>
                <input type="text" id="durasi" name="durasi"
                    class="px-3 py-3 bg-slate-100 border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="(Otomatis)" readonly />

                <script>
                    function hitungDurasi() {
                        let mulai = document.getElementById("waktu_mulai").value;
                        let selesai = document.getElementById("waktu_selesai").value;
                        let durasiInput = document.getElementById("durasi");
                
                        if (mulai && selesai) {
                            let mulaiDate = new Date(`1970-01-01T${mulai}:00`);
                            let selesaiDate = new Date(`1970-01-01T${selesai}:00`);
                            let selisihMenit = (selesaiDate - mulaiDate) / 60000; // Konversi ke menit
                
                            if (selisihMenit < 0) {
                                selisihMenit += 1440; // Jika lewat tengah malam, tambahkan 24 jam (1440 menit)
                            }
                
                            durasiInput.value = selisihMenit + " menit";
                        } else {
                            durasiInput.value = "";
                        }
                    }
                
                    document.getElementById("waktu_mulai").addEventListener("input", hitungDurasi);
                    document.getElementById("waktu_selesai").addEventListener("input", hitungDurasi);
                </script>

                <div class="flex flex-col">
                    <!-- Tombol Submit dan Batal -->
                    <button type="submit"
                        class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold mt-5 w-full text-center text-white">
                        Submit
                    </button>
                    <button type="button"
                        class="bg-white px-5 py-2 border-2 border-[#0BB4A6] rounded-md font-bold mt-3 w-full text-center text-[#0BB4A6]"
                        onclick="closeModal()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

</di>
<script>
// Fungsi untuk membuka modal
function openModal() {
    document.getElementById("myModal").classList.remove("hidden");
}

// Fungsi untuk menutup modal
function closeModal() {
    document.getElementById("myModal").classList.add("hidden");
}

// Menutup modal jika klik di luar konten modal
window.onclick = function(event) {
    const modal = document.getElementById("myModal");
    if (event.target === modal) {
        closeModal();
    }
};
</script>

@endsection
