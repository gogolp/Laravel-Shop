param(
    [string]$DumpFile = ""
)

$container  = "laravel_db"
$dbName     = "laravel_docker"
$dbUser     = "laravel_user"
$dbPassword = "secret_password"
$dumpDir    = "$PSScriptRoot\..\dumps"

if (-not $DumpFile) {
    $latest = Get-ChildItem -Path $dumpDir -Filter "*.sql" |
              Sort-Object LastWriteTime -Descending |
              Select-Object -First 1

    if (-not $latest) {
        Write-Host "ERROR: No .sql files found in: $dumpDir"
        exit 1
    }

    $DumpFile = $latest.FullName
}

if (-not (Test-Path $DumpFile)) {
    Write-Host "ERROR: File not found: $DumpFile"
    exit 1
}

$filename = Split-Path $DumpFile -Leaf
Write-Host "Dump file  : $filename"
Write-Host "Database   : $dbName"
Write-Host ""

$confirm = Read-Host "WARNING: This will OVERWRITE the current '$dbName' database. Continue? (y/n)"
if ($confirm -ne 'y') {
    Write-Host "Import cancelled."
    exit 0
}

Write-Host "Importing dump into container '$container'..."

Get-Content $DumpFile -Raw | docker exec -i $container `
    mysql `
    --user=$dbUser `
    --password=$dbPassword `
    $dbName

if ($LASTEXITCODE -eq 0) {
    Write-Host "SUCCESS: Import completed!"
    Write-Host "Restored from: $filename"
} else {
    Write-Host "ERROR: Import failed!"
    exit 1
}
