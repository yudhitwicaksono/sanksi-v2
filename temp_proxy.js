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
