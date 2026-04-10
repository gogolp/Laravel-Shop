$container  = "laravel_db"
$dbName     = "laravel_docker"
$dbUser     = "laravel_user"
$dbPassword = "secret_password"
$dumpDir    = Join-Path $PSScriptRoot "..\dumps"
$timestamp  = Get-Date -Format "yyyy-MM-dd_HH-mm-ss"
$filename   = "dump_${dbName}_${timestamp}.sql"
$localPath  = Join-Path $dumpDir $filename

if (-not (Test-Path $dumpDir)) {
    New-Item -ItemType Directory -Path $dumpDir | Out-Null
    Write-Host "Created folder: $dumpDir"
}

Write-Host "Creating dump of database '$dbName'..."

# Запускаємо mysqldump всередині контейнера і зберігаємо вивід через cmd
$cmd = "docker exec $container mysqldump --user=$dbUser --password=$dbPassword --single-transaction --routines --triggers $dbName"

$output = cmd /c "$cmd 2>nul"

if ($LASTEXITCODE -eq 0 -and $output) {
    [System.IO.File]::WriteAllText($localPath, ($output -join "`n"), [System.Text.Encoding]::UTF8)
    $sizeKB = [math]::Round((Get-Item $localPath).Length / 1KB, 2)
    Write-Host "SUCCESS: Dump created!"
    Write-Host "File   : $localPath"
    Write-Host "Size   : ${sizeKB} KB"
} else {
    Write-Host "ERROR: Dump failed or output is empty!"
    exit 1
}
