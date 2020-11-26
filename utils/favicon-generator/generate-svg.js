const TextToSVG = require('text-to-svg');
const textToSVG = TextToSVG.loadSync();

const attributes = {fill: 'black'};
const options = {x: 50, y: 50, fontSize: 24, anchor: 'center middle', attributes: attributes};

const svg = textToSVG.getSVG('todo.txt', options);

console.log(svg);
