# Auto Sync Script for sanksi
$PSScriptRoot = Split-Path -Parent -Path $MyInvocation.MyCommand.Definition

# Ensure Git is in PATH
$env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")

# Write the temporary DNS proxy script
$proxyCode = @"
const http = require('http');
const net = require('net');
const dns = require('dns');

const resolver = new dns.Resolver();
resolver.setServers(['8.8.8.8', '1.1.1.1']);

const server = http.createServer((req, res) => {
  res.writeHead(500);
  res.end('HTTPS CONNECT only.');
});

server.on('connect', (req, clientSocket, head) => {
  const parts = req.url.split(':');
  const host = parts[0];
  const port = parseInt(parts[1] || '443', 10);
  
  resolver.resolve4(host, (err, addresses) => {
    if (err || !addresses || addresses.length === 0) {
      clientSocket.write('HTTP/1.1 502 Bad Gateway\r\n\r\n');
      clientSocket.end();
      return;
    }
    const ip = addresses[0];
    const serverSocket = net.connect(port, ip, () => {
      clientSocket.write('HTTP/1.1 200 Connection Established\r\n\r\n');
      if (head && head.length > 0) serverSocket.write(head);
      clientSocket.pipe(serverSocket);
      serverSocket.pipe(clientSocket);
    });
    serverSocket.on('error', () => clientSocket.end());
    clientSocket.on('error', () => serverSocket.end());
  });
});

server.listen(8080, '127.0.0.1');
"@

$proxyPath = Join-Path $PSScriptRoot "temp_proxy.js"
Set-Content -Path $proxyPath -Value $proxyCode

Write-Host "Starting DNS Helper Proxy..." -ForegroundColor Cyan
$proxyProcess = Start-Process node -ArgumentList $proxyPath -NoNewWindow -PassThru

# Wait 1.5 seconds for proxy to initialize
Start-Sleep -Milliseconds 1500

try {
    Write-Host "Syncing with GitHub (Auto Pull & Merge)..." -ForegroundColor Cyan
    # Pull remote changes and rebase
    git -c http.proxy=http://127.0.0.1:8080 pull --rebase origin main
    
    # Check if there are local modifications to commit/push
    $status = git status --porcelain
    if ($status) {
        Write-Host "Local updates detected. Committing and pushing..." -ForegroundColor Cyan
        git add .
        $date = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
        git commit -m "Auto-update: $date"
        git -c http.proxy=http://127.0.0.1:8080 push origin main
        Write-Host "Successfully synced local updates to GitHub!" -ForegroundColor Green
    } else {
        Write-Host "No local changes to push. Repository is up to date." -ForegroundColor Green
    }
} catch {
    Write-Error "Error during sync: $_"
} finally {
    Write-Host "Stopping DNS Helper Proxy..." -ForegroundColor Cyan
    Stop-Process -Id $proxyProcess.Id -Force -ErrorAction SilentlyContinue
    if (Test-Path $proxyPath) {
        Remove-Item $proxyPath -Force
    }
}
