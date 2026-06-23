# Panduan Deploy SIMON DM di Ubuntu dengan Podman

Sistem Informasi Monitoring Diabetes Melitus — Laravel 11 + MySQL 8 + Podman

---

## Kebutuhan Sistem

### Spesifikasi Minimum Server

| Komponen | Minimum |
|---|---|
| OS | Ubuntu 22.04 LTS / 24.04 LTS |
| RAM | 2 GB |
| CPU | 2 core |
| Storage | 10 GB free |
| Akses | User dengan sudo |

### Software yang Dibutuhkan

| Software | Versi | Keterangan |
|---|---|---|
| Podman | 4.x+ | Container runtime (tanpa daemon root) |
| podman-compose | 1.x | Orkestrasi multi-container |
| Git | 2.x | Clone repositori |
| Python3 + pip | 3.x | Dependensi podman-compose |

> **Tidak perlu** menginstall PHP, Composer, Node.js, atau MySQL di server — semua sudah dikemas di dalam container.

---

## Langkah Deploy

### 1. Update Sistem

```bash
sudo apt update && sudo apt upgrade -y
```

---

### 2. Install Git

```bash
sudo apt install -y git
git --version
```

---

### 3. Install Podman

```bash
sudo apt install -y podman
podman --version
```

> Jika versi yang tersedia di repo default terlalu lama (< 4.x), gunakan perintah berikut untuk menambahkan repositori Kubic:
>
> ```bash
> # Khusus Ubuntu 22.04 (jammy)
> echo "deb https://download.opensuse.org/repositories/devel:/kubic:/libcontainers:/stable/xUbuntu_22.04/ /" | \
>   sudo tee /etc/apt/sources.list.d/devel:kubic:libcontainers:stable.list
> curl -L "https://download.opensuse.org/repositories/devel:/kubic:/libcontainers:/stable/xUbuntu_22.04/Release.key" | \
>   sudo apt-key add -
> sudo apt update && sudo apt install -y podman
> ```

---

### 4. Install podman-compose

```bash
sudo apt install -y python3-pip
pip3 install podman-compose

# Tambahkan ke PATH jika belum dikenali
export PATH=$PATH:$HOME/.local/bin
echo 'export PATH=$PATH:$HOME/.local/bin' >> ~/.bashrc
source ~/.bashrc

# Verifikasi
podman-compose --version
```

---

### 5. Clone Repositori

```bash
git clone https://github.com/feryfadly27/simondmfinal.git
cd simondmfinal
```

---

### 6. Siapkan File Konfigurasi .env.podman

File `.env.podman` sudah ada di repositori. Anda hanya perlu mengisi `APP_KEY` dan menyesuaikan `APP_URL`.

**Generate APP_KEY:**

```bash
# Pilih salah satu cara di bawah ini

# Cara 1 — menggunakan OpenSSL (disarankan, tidak perlu PHP)
echo "base64:$(openssl rand -base64 32)"

# Cara 2 — menggunakan Python3
python3 -c "import base64, os; print('base64:' + base64.b64encode(os.urandom(32)).decode())"
```

**Edit file .env.podman:**

```bash
nano .env.podman
```

Isi minimal yang harus diubah:

```env
APP_KEY=base64:HASIL_GENERATE_DI_ATAS

# Ganti dengan IP atau domain server Anda
APP_URL=http://IP_ATAU_DOMAIN_SERVER:8090
```

Contoh isi lengkap `.env.podman`:

```env
APP_NAME="SIMON DM"
APP_ENV=production
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://192.168.1.100:8090

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=simon_dm
DB_USERNAME=simon_user
DB_PASSWORD=simon_secret
```

> **Catatan:** `DB_HOST=db` adalah nama service di docker-compose — jangan diganti ke `localhost` atau `127.0.0.1`.

---

### 7. Buka Port di Firewall (UFW)

```bash
# Aktifkan UFW jika belum
sudo ufw enable

# Buka port aplikasi
sudo ufw allow 8090/tcp

# Buka port SSH agar tidak terkunci
sudo ufw allow OpenSSH

# Cek status
sudo ufw status
```

> Port **33070** (MySQL) tidak perlu dibuka ke publik — hanya digunakan secara internal antar container.

---

### 8. Build Image dan Jalankan Container

```bash
# Pastikan berada di dalam folder simondmfinal/
cd simondmfinal

# Build image (proses pertama ~3-10 menit tergantung koneksi)
podman-compose build

# Jalankan semua container di background
podman-compose up -d
```

---

### 9. Pantau Proses Startup

```bash
# Lihat log startup aplikasi secara realtime
podman logs -f simon-dm-app
```

Tunggu hingga muncul output berikut sebelum membuka browser:

```
MySQL is ready.
Running migrations...
Application startup complete. Access at http://localhost:8090
```

---

### 10. Verifikasi

```bash
# Cek status container
podman ps

# Output yang diharapkan:
# simon-dm-db   mysql:8.0            Up X min (healthy)   0.0.0.0:33070->3306/tcp
# simon-dm-app  simon-dm-app:latest  Up X min             0.0.0.0:8090->80/tcp

# Tes HTTP dari server
curl -o /dev/null -w "%{http_code}\n" http://localhost:8090/
# Harus mengembalikan: 200
```

---

## Akses Aplikasi

Setelah container berjalan, buka browser:

```
http://IP_ATAU_DOMAIN_SERVER:8090
```

### Akun Default (dari seeder)

| Role | Email | Password |
|---|---|---|
| Admin | admin@simondm.com | password123 |
| User | user@simondm.com | password123 |
| User2 | user2@simondm.com | password123 |

> **Segera ganti password** setelah login pertama kali melalui menu profil.

### Halaman Utama

| URL | Keterangan |
|---|---|
| `/` | Halaman landing |
| `/login` | Halaman login |
| `/register` | Registrasi akun baru |
| `/admin` | Dashboard admin (butuh login admin) |
| `/user` | Dashboard user (butuh login user) |

---

## Manajemen Container

### Perintah Umum

```bash
# Hentikan semua container (data tetap tersimpan di volume)
podman-compose down

# Jalankan ulang container
podman-compose up -d

# Restart satu container
podman restart simon-dm-app

# Lihat log (realtime)
podman logs -f simon-dm-app

# Lihat log MySQL
podman logs -f simon-dm-db

# Masuk ke shell container app
podman exec -it simon-dm-app bash

# Jalankan perintah artisan
podman exec simon-dm-app php artisan migrate:status
podman exec simon-dm-app php artisan cache:clear
podman exec simon-dm-app php artisan queue:restart
```

### Update Kode (setelah ada perubahan)

```bash
# Pull kode terbaru
git pull origin main

# Rebuild image dan restart
podman-compose build app
podman-compose up -d
```

### Hapus Data dan Mulai Ulang (Reset Total)

```bash
# Hentikan dan hapus container + volume (DATA HILANG PERMANEN)
podman-compose down -v

# Build ulang dan jalankan dari awal
podman-compose build
podman-compose up -d
```

---

## Koneksi Database Langsung (Opsional)

Untuk mengakses database dari tools seperti TablePlus, DBeaver, atau MySQL Workbench:

| Parameter | Nilai |
|---|---|
| Host | IP server Ubuntu |
| Port | 33070 |
| Database | simon_dm |
| Username | simon_user |
| Password | simon_secret |

---

## Troubleshooting

### Container app terus restart

```bash
# Lihat error di log
podman logs simon-dm-app

# Masalah umum:
# - APP_KEY kosong di .env.podman → isi APP_KEY lalu rebuild
# - MySQL belum siap → tunggu beberapa detik, container akan retry otomatis
```

### Port 8090 tidak bisa diakses dari luar

```bash
# Cek UFW
sudo ufw status

# Pastikan port sudah terbuka
sudo ufw allow 8090/tcp
```

### Podman-compose tidak ditemukan

```bash
# Tambahkan PATH
export PATH=$PATH:$HOME/.local/bin

# Atau install ulang
pip3 install --user podman-compose
```

### Error "permission denied" saat build

```bash
# Podman di Ubuntu kadang perlu konfigurasi subuid/subgid
sudo usermod --add-subuids 100000-165535 $USER
sudo usermod --add-subgids 100000-165535 $USER
podman system migrate
```

### Reset config cache secara manual

```bash
podman exec simon-dm-app php artisan config:clear
podman exec simon-dm-app php artisan config:cache
```

---

## Struktur File Docker

```
simondmfinal/
├── Dockerfile              # Image: PHP 8.2-FPM + Nginx + Supervisor
├── docker-compose.yml      # Orkestrasi app + MySQL
├── .env.podman             # Konfigurasi environment container
└── docker/
    ├── nginx.conf          # Konfigurasi web server
    ├── supervisord.conf    # Process manager (PHP-FPM, Nginx, Queue)
    ├── php-fpm.conf        # Konfigurasi PHP-FPM pool
    ├── opcache.ini         # Optimasi OPcache PHP
    └── entrypoint.sh       # Script startup (migrate, seed, cache)
```

---

## Informasi Port

| Port Host | Port Container | Service | Akses |
|---|---|---|---|
| 8090 | 80 | Nginx (Laravel App) | Publik |
| 33070 | 3306 | MySQL 8.0 | Internal/localhost |
