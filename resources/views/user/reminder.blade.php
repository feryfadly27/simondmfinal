@extends('layout.card')

@section('title', 'Daily Reminder')

@section('content')

    <!-- Jika Tidak Ada Data Pengingat Obat -->
    @if($reminders->isEmpty())
    <div class="flex flex-row justify-center items-center mt-4">
      <!-- ADD -->
      <a href="#" class="p-2 bg-[#D9D9D9] rounded-lg flex flex-row" onclick="openModal()">
          <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 17C13.866 17 17 13.866 17 10C17 6.13401 13.866 3 10 3C6.13401 3 3 6.13401 3 10C3 13.866 6.13401 17 10 17Z" stroke="black" stroke-width="2"/>
              <path d="M3.96499 1.13623C3.28659 1.31792 2.66799 1.67502 2.17138 2.17163C1.67478 2.66823 1.31768 3.28683 1.13599 3.96523M16.035 1.13623C16.7134 1.31792 17.332 1.67502 17.8286 2.17163C18.3252 2.66823 18.6823 3.28683 18.864 3.96523M9.99999 6.00023V9.75023C9.99999 9.88823 10.112 10.0002 10.25 10.0002H13" stroke="black" stroke-width="2" stroke-linecap="round"/>
          </svg>
              
          <h2 class="text-xs px-2">Buat Pengingat</h2>
      </a>
    </div>

    <div class="w-full flex flex-col justify-start items-center h-full">
      <div
          class="mt-4 w-[150px] h-[150px] flex justify-center items-center">
          <lord-icon
              src="https://cdn.lordicon.com/lltgvngb.json"
              trigger="loop"
              delay="500"
              stroke="light"
              colors="primary:#121331,secondary:#0bb4a6"
              class="w-full h-full">
          </lord-icon>
      </div>
      <p class="text-base font-semibold">Reminder Belum ditambahkan</p>
    </div>
    @else

    <!-- Jika data ada -->
        
    <div class="flex flex-col gap-2 w-full mt-4 px-5 h-full">
    @foreach($reminders as $reminder)
      <div class="w-full bg-white rounded-xl flex flex-row items-center gap-1">
          <div class="w-11/12 bg-[#0BB4A6] rounded-xl py-4 px-3 flex flex-col">
              <div class="flex flex-row justify-between items-center">
                  <div class="flex flex-row items-center gap-2">
                    <label class="flex items-center cursor-pointer p-1 bg-white rounded-md">
                      <!-- Checkbox yang sebenarnya (disembunyikan) -->
                      <input type="checkbox" class="hidden peer myCheckbox" data-id="{{ $reminder->id }}">
                      
                      <!-- Kotak checkbox custom -->
                      <div class="w-4 h-4 border-2 border-white bg-white rounded-md flex items-center justify-center transition-colors duration-200 peer-checked:border-green-500 peer-checked:bg-green-500">
                          <!-- Ikon centang -->
                          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                      </div>
                    </label>

                  
                    <p class="text-[13px] font-semibold text-black">
                        {{ $reminder->title }}</p>
                  </div>
              </div>
          </div>

          <script>
            document.addEventListener("DOMContentLoaded", function() {
                const checkboxes = document.querySelectorAll(".myCheckbox");
        
                checkboxes.forEach(checkbox => {
                    const itemId = checkbox.getAttribute("data-id");
                    let savedState = localStorage.getItem("checkbox_" + itemId);
        
                    // Jika tidak ada nilai di localStorage, set default menjadi "false"
                    if (savedState === null) {
                        localStorage.setItem("checkbox_" + itemId, "false");
                        savedState = "false"; // Pastikan ada nilai awal
                    }
        
                    // Atur checkbox sesuai dengan localStorage
                    checkbox.checked = savedState === "true";
        
                    checkbox.addEventListener("change", function() {
                        localStorage.setItem("checkbox_" + itemId, checkbox.checked);
                    });
                });
            });
        </script>
        
              
          <!-- DELETE -->
          <form action="{{ route('reminder.destroy', $reminder->id) }}" method="POST"
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
      @endforeach
      
      <div class="flex flex-row justify-center items-center">
        <!-- ADD -->
        <a href="#" class="p-2 bg-[#D9D9D9] rounded-lg flex flex-row" onclick="openModal()">
            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 17C13.866 17 17 13.866 17 10C17 6.13401 13.866 3 10 3C6.13401 3 3 6.13401 3 10C3 13.866 6.13401 17 10 17Z" stroke="black" stroke-width="2"/>
                <path d="M3.96499 1.13623C3.28659 1.31792 2.66799 1.67502 2.17138 2.17163C1.67478 2.66823 1.31768 3.28683 1.13599 3.96523M16.035 1.13623C16.7134 1.31792 17.332 1.67502 17.8286 2.17163C18.3252 2.66823 18.6823 3.28683 18.864 3.96523M9.99999 6.00023V9.75023C9.99999 9.88823 10.112 10.0002 10.25 10.0002H13" stroke="black" stroke-width="2" stroke-linecap="round"/>
            </svg>
                
            <h2 class="text-xs px-2">Buat Pengingat</h2>
        </a>
    </div>
  </div>


    @endif


    <!-- MODAL -->
    <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
      <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
          <h1 class="text-xl font-bold text-center text-[#0BB4A6] uppercase">
              Masukan Pengingat Harian
          </h1>

          <!-- Form di dalam modal -->
          <form class="mt-4 flex flex-col gap-2" action="{{ route('reminder.store') }}" method="POST">
              @csrf
              <!-- Token CSRF untuk keamanan -->
              <input type="text" name="title"
                  class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                  placeholder="Judul Pengingat" required />

              <input type="date" name="reminder_date"
                  class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required />

              <input type="time" name="reminder_time"
                  class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required />

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
          </form>
      </div>
    </div>
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