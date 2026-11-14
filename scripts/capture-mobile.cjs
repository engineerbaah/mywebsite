const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const outputPath = path.join(__dirname, '..', 'render-mobile.png');

// Use window size and mobile user agent
const targetUrl = process.argv[2] || 'http://127.0.0.1:8000/';
const cmd = `"${chromePath}" --headless=new --disable-gpu --virtual-time-budget=2500 --window-size=390,2800 --user-agent="Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1" --screenshot="${outputPath}" ${targetUrl}`;

console.log('Capturing mobile screenshot...');
execSync(cmd);
console.log('Saved to', outputPath, 'size:', fs.statSync(outputPath).size);

