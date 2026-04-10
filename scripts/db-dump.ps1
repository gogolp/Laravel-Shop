# ============================================================
#  db-dump.ps1 — Дамп MySQL з Docker + скачати локально
# ============================================================
# Використання:
#   .\scripts\db-dump.ps1
# ============================================================

$container  = "laravel_db"
$dbName     = "laravel_docker"
$dbUser     = "laravel_user"
$dbPassword = "secret_password"
$dumpDir    = "$PSScriptRoot\..\dumps"
$timestamp  = Get-Date -Format "yyyy-MM-dd_HH-mm-ss"
$filename   = "dump_${dbName}_${timestamp}.sql"
$localPath  = "$dumpDir\$filename"

# Створити папку dumps/ якщо не існує
if (-not (Test-Path $dumpDir)) {
    New-Item -ItemType Directory -Path $dumpDir | Out-Null
    Write-Host "📁 Створено папку: $dumpDir"
}

Write-Host "⏳ Створення дампу бази '$dbName'..."

# Виконати mysqldump всередині контейнера і зберегти локально
docker exec $container `
    mysqldump `
    --user=$dbUser `
    --password=$dbPassword `
    --single-transaction `
    --routines `
    --triggers `
    $dbName | Out-File -FilePath $localPath -Encoding utf8

if ($LASTEXITCODE -eq 0) {
    $sizeKB = [math]::Round((Get-Item $localPath).Length / 1KB, 2)
    Write-Host ""
    Write-Host "✅ Дамп успішно створено!"
    Write-Host "📄 Файл : $localPath"
    Write-Host "📦 Розмір: ${sizeKB} KB"
} else {
    Write-Host "❌ Помилка при створенні дампу!"
    exit 1
}
