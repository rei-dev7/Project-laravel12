// Ambil URL dasar API dari data-attribute pada elemen form (id="item-form")
const API_BASE_URL = document.getElementById('item-form').dataset.apiBaseUrl;

document.addEventListener('DOMContentLoaded', function () {
    const kategoriSelect = document.getElementById('id_kategori');
    const subKategoriSelect = document.getElementById('id_sub_kategori');

    // Cek apakah elemen-elemen penting ada
    if (!kategoriSelect || !subKategoriSelect || !API_BASE_URL) return;

    // Fungsi utama untuk memuat Sub Kategori dari server
    async function loadSubKategori(kategoriId, selectedSubKategoriId = null) {
        // 1. Reset dan nonaktifkan Sub Kategori
        subKategoriSelect.innerHTML = '<option value="">-- Pilih Sub Kategori (Opsional) --</option>';
        subKategoriSelect.disabled = true;

        if (!kategoriId) return; // Hentikan jika Kategori belum dipilih

        try {
            // URL API (misal: /subkategori/by-kategori/1)
            const url = `${API_BASE_URL}/subkategori/by-kategori/${kategoriId}`;
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error('Gagal memuat data Sub Kategori dari server.');
            }
            
            const subKategoriData = await response.json();

            // 2. Isi dropdown Sub Kategori
            if (subKategoriData.length > 0) {
                subKategoriData.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.id_sub_kategori;
                    option.textContent = sub.nama_sub_kategori;

                    // Jika ini adalah kasus Edit/mengisi data lama, pre-select nilai yang benar
                    if (selectedSubKategoriId && sub.id_sub_kategori == selectedSubKategoriId) {
                        option.selected = true;
                    }
                    subKategoriSelect.appendChild(option);
                });
                subKategoriSelect.disabled = false; // Aktifkan jika ada data
                subKategoriSelect.classList.remove('bg-gray-50'); // Hapus style nonaktif
            } else {
                subKategoriSelect.innerHTML = '<option value="">-- Tidak ada Sub Kategori --</option>';
            }

        } catch (error) {
            console.error('Error fetching sub kategori:', error);
            subKategoriSelect.innerHTML = '<option value="">-- Error memuat data --</option>';
        }
    }

    // Listener: Panggil loadSubKategori setiap kali Kategori berubah
    kategoriSelect.addEventListener('change', function() {
        // Saat Kategori berubah, kita panggil AJAX tanpa nilai Sub Kategori lama
        loadSubKategori(this.value);
    });

    // Panggil fungsi saat halaman dimuat (untuk kasus old() data atau Edit)
    const initialKategoriId = kategoriSelect.value;
    // Ambil nilai Sub Kategori lama (jika ada) yang disimpan di data attribute
    const initialSubKategoriId = kategoriSelect.dataset.initialSubkategori;

    if (initialKategoriId) {
        // Panggil dengan ID Sub Kategori lama agar terpilih otomatis
        loadSubKategori(initialKategoriId, initialSubKategoriId);
    }
});