# DATABASE BACKUP
Ini adalah instruksi pemasangan pencadangan basis data setiap 15 menit.

## 1. Membuat user MariaDB untuk backup
Masuk ke dalam basis data dengan perintah `sudo mariadb -u root -p` dan ketik perintah berikut:
```
CREATE USER 'backup'@'localhost' IDENTIFIED BY 'bU4t_kat4sand1_kuat_d!sini!';
GRANT SELECT, LOCK TABLES, SHOW VIEW, EVENT, TRIGGER, RELOAD, REPLICATION CLIENT ON *.* TO 'backup'@'localhost';
FLUSH PRIVILEGES;
```
Perintah-perintah tersebut akan membuat sebuah user baru khusus untuk pencadangan.

## 2. Menyimpan credential user di sebuah file
Ketik perintah `sudo nano /root/backup.my.cnf` untuk membuat file `backup.my.cnf`.<br>
Kemudian, salin dan tempelkan kode di bawah pada file tersebut:
```
[client]
user=backup
password="bU4t_kat4sand1_kuat_d!sini!"
```
Kemudian simpan dan tutup file dengan menekan tombol `CTRL + X`, lalu `Y`, terakhir `Enter`.<br>
Langkah ini dilakukan untuk menyimpan nama dan kata sandi user untuk mencegah kata sandi muncul di script ataupun log.

## 3. Membuat script pencadangan
Ketik `sudo nano /usr/local/bin/backup_mariadb.sh` untuk membuat file script.
Salin dan tempel kode di bawah pada file:
```
#!/bin/bash

DB_NAME="all"
BACKUP_DIR="/var/backups/mariadb"
RETENTION_HOURS=48
LOG_FILE="/var/log/mariadb_backup.log"
MYCNF="/root/backup.my.cnf"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")

mkdir -p "$BACKUP_DIR"

log() {
    echo "$(date +"%Y-%m-%d %H:%M:%S") - $1" | tee -a "$LOG_FILE"
}

log "Memulai backup..."

if [ "$DB_NAME" == "all" ]; then
    BACKUP_FILE="$BACKUP_DIR/all_databases_$TIMESTAMP.sql.gz"
    DUMP_TARGET="--all-databases"
else
    BACKUP_FILE="$BACKUP_DIR/${DB_NAME}_$TIMESTAMP.sql.gz"
    DUMP_TARGET="$DB_NAME"
fi

if mariadb-dump --defaults-extra-file="$MYCNF" \
    --single-transaction \
    --quick \
    --routines \
    --triggers \
    --events \
    $DUMP_TARGET | gzip > "$BACKUP_FILE"; then
    SIZE=$(du -h "$BACKUP_FILE" | cut -f1)
    log "Backup berhasil: $BACKUP_FILE ($SIZE)"
else
    log "ERROR: Gagal melakukan backup"
    rm -f "$BACKUP_FILE"
    exit 1
fi

# Hapus backup lama
DELETED=$(find "$BACKUP_DIR" -name "*.sql.gz" -mmin +$((RETENTION_HOURS * 60)) -print -delete | wc -l)
log "Hapus backup lama selesai, $DELETED file dihapus (${RETENTION_HOURS} jam terakhir)."

log "Backup selesai"
```
Terakhir, ketik perintah `sudo chmod +x /usr/local/bin/backup_mariadb.sh`.

## 4. Pasang ke cron
Edit crontab dengan perintah `sudo  crontab -e`.<br>
Pilih `1`.<br>
Masukkan `*/15 * * * * /usr/local/bin/backup_mariadb.sh`.<br>
Kemudian simpan dan tutup file dengan menekan tombol `CTRL + X`, lalu `Y`, terakhir `Enter`.


## 5. Periksa cron
Gunakan perintah `sudo crontab -l` untuk memeriksa apakah sistem cron backup sudah ada.<br>
Terakhir, gunakan perintah `sudo tail -f /var/log/mariadb_backup.log` untuk memeriksa log pencadangan.
