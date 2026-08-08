# Prompt Integrasi Aplikasi Mobile - Church Finder Makassar

## Konteks Backend
- **Base URL Production**: `https://gerejamakassar.my.id/api/v1`
- **Auth**: Sanctum Bearer Token
- **Format Response**: `{ "success": bool, "data": ... }`

---

## Fitur Baru: User Dapat Mengajukan Gereja (Dengan Caching & Auto-Sync Status)

### Alur Kerja & Strategi Cache (Offline-First Sync)
1. User login → dapatkan Bearer Token.
2. User isi form pengajuan gereja (nama, alamat, koordinat, foto).
3. App mengirim `POST /api/v1/churches` → backend mengembalikan data gereja baru dengan `status_verifikasi: "draft"`.
4. App **langsung menyimpan** data pengajuan ini ke dalam **database lokal perangkat** (misal: Room DB / Hive / Sqflite).
5. Admin melakukan review di Admin Panel (`verified` / `rejected`).
6. Ketika user membuka halaman "Pengajuan Saya" (atau saat background sync / Pull-to-Refresh):
   - App menampilkan data dari **cache perangkat terlebih dahulu** secara instan.
   - App melakukan fetch ke `GET /api/v1/my-submissions` untuk mengambil status terbaru dari server.
   - App memperbarui database lokal *(upsert)* dengan `status_verifikasi` terbaru dari server.
   - UI akan **otomatis ter-update secara reaktif** saat cache lokal diperbarui (misal status berubah dari `draft` 🟡 menjadi `verified` 🟢 atau `rejected` 🔴).

---

## Prompt untuk Fitur Submit & Cache Gereja (Android Kotlin / Jetpack Compose)

```
Buatkan arsitektur Repository (Offline-First / Cache-Then-Network) pada aplikasi Android (Kotlin + Jetpack Compose + Room + Retrofit + Flow) untuk fitur "Ajukan Gereja" dengan ketentuan:

1. Local Cache (Room DB):
   - Buat Entity `SubmittedChurchEntity` dengan field: id, namaGereja, alamat, kecamatan, kategori, statusVerifikasi ("draft", "verified", "rejected"), latitude, longitude, lastSyncedAt.
   - Buat `SubmittedChurchDao` dengan query `getAllSubmittedChurches(): Flow<List<SubmittedChurchEntity>>` dan `upsertAll(churches: List<SubmittedChurchEntity>)`.

2. Form Input Screen ("Ajukan Gereja"):
   - Form field: Nama Gereja, Kategori (Dropdown dari GET /api/v1/categories), Alamat, Kecamatan, Lat/Lng, Deskripsi, Telepon, Kapasitas, Foto Utama (ImagePicker max 10MB).
   - Saat submit (POST /api/v1/churches via Multipart), simpan respons sukses (201) secara langsung ke Room DB lokal dengan status initial "draft".

3. List Screen ("Pengajuan Saya"):
   - Mengamati Room DB via StateFlow / Flow (Single Source of Truth) sehingga UI tampil instan tanpa loading dari network jika data lokal sudah ada.
   - Panggil `GET /api/v1/my-submissions` di background (atau via SwipeRefresh).
   - Update data di Room DB dengan hasil response server terbaru. Jika admin telah menyetujui (`status_verifikasi == "verified"`), status di Room DB otomatis ter-update dan UI ter-render ulang secara reaktif.

4. UI Badge Status:
   - 🟡 Draft / Pending (`draft`)
   - 🟢 Disetujui (`verified`)
   - 🔴 Ditolak (`rejected`)

API endpoint:
- POST https://gerejamakassar.my.id/api/v1/churches (multipart/form-data)
- GET  https://gerejamakassar.my.id/api/v1/my-submissions (Bearer Token)
- GET  https://gerejamakassar.my.id/api/v1/categories
```

---

## Prompt untuk Fitur Submit & Cache Gereja (Flutter / Dart)

```
Buatkan fitur "Ajukan Gereja" & "Pengajuan Saya" pada aplikasi Flutter menggunakan pendekatan Cache-First & Auto-Sync (Hive / Sqflite / HydratedBloc) yang:

1. Local Database Setup (Hive / Sqflite):
   - Simpan data pengajuan user secara lokal di perangkat (`submitted_churches_box`).
   - Setiap item menyimpan `status_verifikasi` ("draft", "verified", "rejected").

2. Form "Ajukan Gereja":
   - Form input lengkap (name, address, district, lat, lng, description, phone, capacity, main_image).
   - Submit via `http.MultipartRequest` ke `POST https://gerejamakassar.my.id/api/v1/churches`.
   - Setelah sukses (201), simpan objek hasil response ke lokal database dan navigasi ke "Pengajuan Saya".

3. Screen "Pengajuan Saya" (Cache + Sync Strategy):
   - Saat dibuka, langsung tampilkan list pengajuan dari cache lokal perangkat (tanpa delay).
   - Jalankan pemanggilan background ke `GET https://gerejamakassar.my.id/api/v1/my-submissions` (Header `Authorization: Bearer {token}`).
   - Ketika server merespons data terbaru, perbarui data lokal di Hive/Sqflite.
   - Status pengajuan yang sudah di-approve admin (`status_verifikasi == "verified"`) akan otomatis ter-update di cache lokal dan mentrigger setState / ValueListenableBuilder / Bloc State.

4. Tampilan Chip Status:
   - Amber / Kuning (draft/pending)
   - Green / Hijau (verified)
   - Red / Merah (rejected)
```

---

## Field Response Kunci (Sync Target)

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
