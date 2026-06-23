@extends('layout.app')
@section('content')
<section
    class="h-[730px] w-[350px] m-auto overflow-hidden bg-white bg-cover bg-center rounded-3xl flex flex-col items-center p-7 container-snap overflow-y-auto scale-90">
    <div class="flex flex-row items-center justify-start mt-4 absolute left-7">

        <a href="{{route('dashboard')}}">
            <svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="scale-75">
                <path d="M11 2L2 11L11 20" stroke="#FF76CE" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <h1 class="text-xl font-bold text-[#FF76CE] ml-[3.8rem]">Dukungan Sosial</h1>
    </div>

    <h2 class="mt-16 text-center font-semibold text-[0.9rem]">
        Butuh solusi? Tanyakan kebutuhan <br />
        dan keluhan Anda kepada kami
    </h2>

    <div class="grid grid-rows-1 mt-4 w-full gap-y-4">
        <!-- Foreach Didieu -->
        <div class="bg-white border-2 border-[#FF76CE] rounded-xl p-1.5 flex flex-row justify-between items-center">
            <img src="{{asset('assets/hati.png')}}" alt="" class="h-16" />

            <div class="flex flex-col gap-1 w-[120px]">
                <h1 class="text-[0.6rem] font-semibold">Apa itu diabetes?</h1>

                <div class="flex flex-row gap-4 mt-2">
                    <img src="../assets/question.svg" alt="" />
                    <img src="../assets/information.svg" alt="" />
                </div>
            </div>

            <a href="#" class="bg-[#FF76CE] py-1 px-3 rounded-full text-[0.7rem] text-white font-semibold"
                onclick="openModal(1)">
                Detail
            </a>
        </div>

        <div class="bg-white border-2 border-[#FF76CE] rounded-xl p-1.5 flex flex-row justify-between items-center">
            <img src="{{asset('assets/kaca pembesar.png')}}" alt="" class="h-16" />

            <div class="flex flex-col gap-1 w-[120px]">
                <h1 class="text-[0.6rem] font-semibold">Bagaimana cara memilih makanan yang sehat?</h1>

                <div class="flex flex-row gap-4 mt-2">
                    <img src="../assets/question.svg" alt="" />
                    <img src="../assets/information.svg" alt="" />
                </div>
            </div>

            <a href="#" class="bg-[#FF76CE] py-1 px-3 rounded-full text-[0.7rem] text-white font-semibold"
                onclick="openModal(2)">
                Detail
            </a>
        </div>

        <div class="bg-white border-2 border-[#FF76CE] rounded-xl p-1.5 flex flex-row justify-between items-center">
            <img src="{{asset('assets/obat kedua.png')}}" alt="" class="h-16 w-[3.8rem]" />

            <div class="flex flex-col gap-1 w-[120px]">
                <h1 class="text-[0.6rem] font-semibold">Siapa saja yang beresiko terkena penyakit Diabetes?</h1>

                <div class="flex flex-row gap-4 mt-2">
                    <img src="../assets/question.svg" alt="" />
                    <img src="../assets/information.svg" alt="" />
                </div>
            </div>

            <a href="#" class="bg-[#FF76CE] py-1 px-3 rounded-full text-[0.7rem] text-white font-semibold"
                onclick="openModal(3)">
                Detail
            </a>
        </div>
    </div>

    <!-- MODAL -->
    <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
            <h1 class="text-xl font-bold text-center text-[#FF76CE] uppercase">
                DETAIL
            </h1>

            <!-- Form di dalam modal -->
            <form class="mt-4 flex flex-col gap-2" action="" method="">
                <div id="modalDescription"
                    class="bg-white px-5 py-2 border-2 border-[#FF76CE] rounded-md text-[0.7rem] mt-3 w-full text-start text-black">
                    
                </div>

                <button type="" class="bg-[#FF76CE] px-5 py-2 rounded-md font-bold mt-3 w-full text-center text-white"
                    onclick="closeModal()">
                    Close
                </button>
        </div>
    </div>
</section>
<script>
// Fungsi untuk membuka modal

function openModal(deskripsi) {
    const modal = document.getElementById('myModal');
    const modalDescription = document.getElementById('modalDescription');

    // Menetapkan deskripsi berdasarkan parameter yang diterima
    if (deskripsi === 1) {
        modalDescription.innerHTML = 'Diabetes, atau sering disebut sebagai diabetes mellitus, adalah suatu kondisi medis yang ditandai oleh tingginya kadar glukosa (gula) dalam darah. Ini terjadi karena tubuh tidak dapat memproduksi cukup insulin atau tidak dapat menggunakan insulin dengan efektif. Insulin adalah hormon yang dihasilkan oleh pankreas dan berfungsi untuk mengatur kadar gula darah.';
    } else if (deskripsi === 2) {
        modalDescription.innerHTML = 'Untuk memilih makanan yang sehat, utamakan konsumsi makanan utuh seperti buah, sayuran, biji-bijian, dan sumber protein tanpa lemak. Perhatikan komposisi gizi dengan membaca label makanan dan pilih berbagai warna makanan untuk mendapatkan nutrisi yang beragam. Batasi konsumsi gula tambahan dan lemak jenuh, serta kontrol porsi agar tidak berlebihan. Gunakan metode memasak yang sehat seperti merebus atau memanggang, dan tambahkan bumbu alami untuk meningkatkan rasa. Pastikan untuk minum cukup air dan buat rencana makan untuk membantu membuat pilihan yang lebih baik. Nikmati setiap makanan dengan tenang untuk mendukung kesehatan fisik dan mental Anda.';
    } else if (deskripsi === 3) {
        modalDescription.innerHTML = 'Beberapa kelompok memiliki risiko lebih tinggi terkena diabetes. Mereka yang memiliki riwayat keluarga dengan diabetes, berusia di atas 45 tahun, atau kelebihan berat badan berisiko lebih tinggi. Kurangnya aktivitas fisik, pola makan tidak sehat, serta hipertensi dan kolesterol tinggi juga dapat meningkatkan risiko. Wanita yang pernah mengalami diabetes gestasional dan individu dengan sindrom metabolik berisiko lebih besar terkena diabetes tipe 2. Selain itu, beberapa ras dan etnis, seperti Afro-Amerika dan Hispanik, juga memiliki kecenderungan lebih tinggi terhadap penyakit ini. Melakukan pemeriksaan kesehatan rutin dan menerapkan gaya hidup sehat sangat penting untuk mengurangi risiko diabetes.';
    }

    // Menampilkan modal
    modal.classList.remove('hidden');
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
</section>

@endsection