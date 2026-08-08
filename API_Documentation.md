# Church Finder API Documentation (v1)

Base URL Production: `https://gerejamakassar.my.id/api/v1`
Authentication: Bearer Token (Sanctum)

Format response standar:
```json
{ "success": true, "data": { ... } }
```

---

## 1. Authentication

### Register
- **POST** `/register`
- **Body**: `{ "name", "email", "password", "password_confirmation" }`
- **Response**: `{ "success": true, "data": { "token": "..." } }`

### Login
- **POST** `/login`
- **Body**: `{ "email", "password" }`
- **Response**: `{ "success": true, "data": { "token": "..." } }`

### Logout (Auth Required)
- **POST** `/logout`
- **Header**: `Authorization: Bearer {token}`

### Get Current User (Auth Required)
- **GET** `/me`
- **Header**: `Authorization: Bearer {token}`

---

## 2. Categories

### List All Categories
- **GET** `/categories`
- **Response**: `[{ "id", "name", "slug" }]`

---

## 3. Churches (Publik)

### Get All Churches
- **GET** `/churches`
- **Query Params**: `search` (opsional), `category_id` (opsional)
- **Response Fields**: `id`, `nama_gereja`, `slug`, `alamat`, `kecamatan`, `kategori`, `fasilitas[]`, `kapasitas`, `deskripsi`, `jadwal_ibadah[]`, `kegiatan_gereja[]`, `gambar[]`, `latitude`, `longitude`, `status_verifikasi`

> Hanya menampilkan gereja dengan `status_verifikasi = "verified"`.

### Get Nearby Churches (Haversine)
- **GET** `/churches/nearby`
- **Query Params**: `latitude` (wajib), `longitude` (wajib), `search` (opsional), `category_id` (opsional)
- **Response Fields**: sama seperti di atas + `distance_km` (jarak dalam km dari titik pengguna)

### Get Church Detail
- **GET** `/churches/{slug}`
- **Response**: satu objek church lengkap

---

## 4. User Church Submission (Auth Required)

### Submit Church Baru
Pengguna yang sudah login dapat mengajukan data gereja baru. Status awal `draft` dan tidak tampil di publik sampai disetujui admin.

- **POST** `/churches`
- **Header**: `Authorization: Bearer {token}`, `Content-Type: multipart/form-data`
- **Body**:

| Field | Tipe | Wajib | Keterangan |
|-------|------|-------|------------|
| `name` | string | ✅ | Nama gereja |
| `church_category_id` | integer | ✅ | ID kategori gereja |
| `address` | string | ✅ | Alamat lengkap |
| `district` | string | | Kecamatan |
| `latitude` | numeric | ✅ | Koordinat latitude |
| `longitude` | numeric | ✅ | Koordinat longitude |
| `description` | string | | Deskripsi gereja |
| `phone` | string | | Nomor telepon |
| `capacity` | integer | | Kapasitas jemaat |
| `main_image` | file (jpg/png/webp, max 10MB) | | Foto utama gereja |

- **Response** `201`:
```json
{
    "success": true,
    "message": "Gereja berhasil dikirim dan menunggu verifikasi admin.",
    "data": {
        "id": 10,
        "nama_gereja": "Gereja XYZ",
        "status_verifikasi": "draft",
        ...
    }
}
```

### Lihat Pengajuan Saya
Melihat daftar gereja yang pernah diajukan oleh pengguna yang sedang login, beserta status verifikasinya.

- **GET** `/my-submissions`
- **Header**: `Authorization: Bearer {token}`
- **Response**: array church milik user dengan `status_verifikasi` (`draft` / `verified` / `rejected`)

---

## 5. Favorites (Auth Required)

### List Favorites
- **GET** `/favorites`

### Toggle Favorite
- **POST** `/favorites/{church_id}`

---

## 6. Reminders (Auth Required)

### List Reminders
- **GET** `/reminders`

### Toggle Reminder
- **POST** `/reminders/{schedule_id}`

---

## 7. Articles

### List Articles
- **GET** `/articles`

### Article Detail
- **GET** `/articles/{slug}`

---

## Admin Verification Flow (Admin Panel Only)

> Tidak diakses via API mobile. Hanya tersedia di admin panel `https://gerejamakassar.my.id/admin`.

- Admin membuka **Manage Churches** → tab **Pending**
- Klik **✓ Setujui** untuk mengubah status menjadi `verified` (gereja langsung tampil di publik)
- Klik **✗ Tolak** untuk mengubah status menjadi `rejected`
