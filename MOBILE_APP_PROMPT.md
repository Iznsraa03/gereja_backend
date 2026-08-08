# Prompt Integrasi Aplikasi Mobile - Church Finder Makassar

## Konteks Backend
- **Base URL Production**: `https://gerejamakassar.my.id/api/v1`
- **Auth**: Sanctum Bearer Token
- **Format Response**: `{ "success": bool, "data": ... }`

---

## Fitur Baru: User Dapat Mengajukan Gereja

### Alur (Flow)
1. User login → dapatkan token
2. User isi form pengajuan gereja (nama, alamat, koordinat, foto)
3. `POST /api/v1/churches` dengan Bearer Token → response status `draft`
4. Admin review di admin panel → setujui atau tolak
5. User cek status pengajuan via `GET /api/v1/my-submissions`

---

## Prompt untuk Fitur Submit Gereja (Kotlin / Jetpack Compose)

```
Buatkan screen "Ajukan Gereja" pada aplikasi Android (Kotlin + Jetpack Compose + Retrofit) yang:

1. Menampilkan form input dengan field:
   - Nama Gereja (TextField)
   - Kategori (DropdownMenu dari GET /api/v1/categories)
   - Alamat (TextField multiline)
   - Kecamatan (TextField)
   - Latitude & Longitude (bisa diisi manual atau dari GPS device)
   - Deskripsi (TextField multiline, opsional)
   - Telepon (TextField, opsional)
   - Kapasitas (NumberField, opsional)
   - Foto Utama (ImagePicker, max 10MB, upload as multipart/form-data)

2. Setelah submit sukses (201), tampilkan pesan:
   "Gereja berhasil dikirim! Menunggu verifikasi dari admin."

3. Tambahkan screen "Pengajuan Saya" yang memanggil GET /api/v1/my-submissions
   dan menampilkan list gereja dengan badge status:
   - 🟡 Pending (draft)
   - 🟢 Disetujui (verified)
   - 🔴 Ditolak (rejected)

4. Semua request wajib menyertakan header:
   Authorization: Bearer {token}
   Content-Type: multipart/form-data (untuk POST /churches)

API endpoint:
- POST https://gerejamakassar.my.id/api/v1/churches (multipart/form-data)
- GET  https://gerejamakassar.my.id/api/v1/my-submissions
- GET  https://gerejamakassar.my.id/api/v1/categories
```

---

## Prompt untuk Fitur Submit Gereja (Flutter / Dart)

```
Buatkan fitur "Ajukan Gereja" pada aplikasi Flutter yang:

1. Form dengan TextFormField untuk: name, address, district, latitude, longitude, description, phone, capacity
2. Dropdown kategori dari GET /api/v1/categories
3. ImagePicker untuk foto utama gereja (upload multipart)
4. Tombol submit memanggil:
   POST https://gerejamakassar.my.id/api/v1/churches
   menggunakan http.MultipartRequest dengan header Authorization Bearer Token
5. Setelah berhasil, navigasi ke screen "Pengajuan Saya"
6. Screen "Pengajuan Saya" (GET /api/v1/my-submissions) menampilkan ListView
   dengan Chip status berwarna:
   - amber (draft/pending)
   - green (verified)
   - red (rejected)
```

---

## Field Response Kunci

```json
{
  "id": 10,
  "nama_gereja": "Gereja XYZ",
  "alamat": "Jl. ABC No. 1, Kel. X, Kec. Y",
  "kecamatan": "Tamalanrea",
  "kategori": "Gereja Toraja",
  "kapasitas": "500 Orang",
  "jadwal_ibadah": [{ "judul": "Misa Pagi", "waktu": "07:00:00 - 09:00:00", "pengkhotbah": "Pdt. A" }],
  "kegiatan_gereja": [{ "judul": "Sekolah Minggu", "deskripsi": null, "mulai": "2026-08-10 09:00:00" }],
  "latitude": "-5.1147000",
  "longitude": "119.4932000",
  "status_verifikasi": "draft"
}
```
