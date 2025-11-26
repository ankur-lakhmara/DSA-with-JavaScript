/* rule number 5 is 'drop non dominants' that mean : */

let srt = 'Tommy is good dog';

let split = srt.split(' ').join(', ');

console.log(split);



const fs = require('fs');
const Rstream  = fs.createReadStream('bigORule4.js','utf-8');
const Wstream = fs.createWriteStream('output.txt','utf-8');

Rstream.pipe(Wstream);

Wstream.on('finish',()=>{
    console.log('dopied');
    
})

Rstream.on('error',(err)=>{
    console.error(err);
})

Wstream.on('error',(err)=>{
    console.log('error');
    
})

