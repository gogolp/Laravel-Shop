$container  = "laravel_db"
$dbName     = "laravel_docker"
$dbUser     = "laravel_user"
$dbPassword = "secret_password"
$dumpDir    = "$PSScriptRoot\..\dumps"
$timestamp  = Get-Date -Format "yyyy-MM-dd_HH-mm-ss"
$filename   = "dump_${dbName}_${timestamp}.sql"
$localPath  = "$dumpDir\$filename"

if (-not (Test-Path $dumpDir)) {
    New-Item -ItemType Directory -Path $dumpDir | Out-Null
    Write-Host "Created folder: $dumpDir"
}

Write-Host "Creating dump of database '$dbName'..."

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
    Write-Host "SUCCESS: Dump created!"
    Write-Host "File   : $localPath"
    Write-Host "Size   : ${sizeKB} KB"
} else {
    Write-Host "ERROR: Dump failed!"
    exit 1
}
