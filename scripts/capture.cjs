const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const width = process.argv[2] || 1440;
const height = process.argv[3] || 3200;
const filename = process.argv[4] || 'render-desktop.png';
const targetUrl = process.argv[5] || 'http://127.0.0.1:8000/';
const outputPath = path.join(__dirname, '..', filename);

const cmd = `"${chromePath}" --headless=new --disable-gpu --virtual-time-budget=2500 --screenshot="${outputPath}" --window-size=${width},${height} ${targetUrl}`;
console.log('Capturing screenshot of', targetUrl, 'at', width, 'x', height);
execSync(cmd);
console.log('Saved to', outputPath, 'file size:', fs.statSync(outputPath).size);
