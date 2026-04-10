# ============================================================
#  db-import.ps1 — Імпорт дампу MySQL в Docker-контейнер
# ============================================================
# Використання:
#   .\scripts\db-import.ps1                        <- бере останній дамп автоматично
#   .\scripts\db-import.ps1 .\dumps\dump_xyz.sql   <- вказати конкретний файл
# ============================================================

param(
    [string]$DumpFile = ""
)

$container  = "laravel_db"
$dbName     = "laravel_docker"
$dbUser     = "laravel_user"
$dbPassword = "secret_password"
$dumpDir    = "$PSScriptRoot\..\dumps"

# Якщо файл не вказано — беремо останній дамп з папки dumps/
if (-not $DumpFile) {
    $latest = Get-ChildItem -Path $dumpDir -Filter "*.sql" |
              Sort-Object LastWriteTime -Descending |
              Select-Object -First 1

    if (-not $latest) {
        Write-Host "❌ Не знайдено жодного .sql файлу в папці: $dumpDir"
        exit 1
    }

    $DumpFile = $latest.FullName
}

# Перевірка що файл існує
if (-not (Test-Path $DumpFile)) {
    Write-Host "❌ Файл не знайдено: $DumpFile"
    exit 1
}

$filename = Split-Path $DumpFile -Leaf
Write-Host ""
Write-Host "📄 Файл дампу : $filename"
Write-Host "🗄️  База даних : $dbName"
Write-Host ""

# Підтвердження від користувача
$confirm = Read-Host "⚠️  Це ПЕРЕЗАПИШЕ поточну базу '$dbName'. Продовжити? (y/n)"
if ($confirm -ne 'y') {
    Write-Host "❌ Імпорт скасовано."
    exit 0
}

Write-Host ""
Write-Host "⏳ Імпортую дамп в контейнер '$container'..."

# Передаємо файл через pipe в mysql всередині контейнера
Get-Content $DumpFile -Raw | docker exec -i $container `
    mysql `
    --user=$dbUser `
    --password=$dbPassword `
    $dbName

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "✅ Імпорт успішно завершено!"
    Write-Host "📄 Відновлено з: $filename"
} else {
    Write-Host ""
    Write-Host "❌ Помилка під час імпорту!"
    exit 1
}
