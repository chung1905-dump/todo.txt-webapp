const TextToSVG = require('text-to-svg');
const textToSVG = TextToSVG.loadSync();

const attributes = {fill: 'black'};
const options = {x: 50, y: 50, fontSize: 24, anchor: 'center middle', attributes: attributes};

const svg = textToSVG.getSVG(process.argv[2], options);
const ret = svg.replace(/width="\d+"/, 'width="100"')
    .replace(/height="\d+"/, 'height="100"');

console.log(ret);
