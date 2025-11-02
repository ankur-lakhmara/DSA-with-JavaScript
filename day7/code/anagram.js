let str1 = 'AABDD';
let str2 = 'BACAA';

if(str1.length !== str2.length){
    console.log('Length is not equal');
    return;
}

let str1Counter = {};
let str2Counter = {};

for(let i = 0;i<str1.length;i++){
    str1Counter[str1.charAt(i)] = (str1Counter[str1.charAt(i)] || 0)+1;
}

for(let i = 0;i<str2.length;i++){
    str2Counter[str2.charAt(i)] = (str2Counter[str2.charAt(i)] || 0) + 1;
}

console.log(str1Counter);
console.log(str2Counter);

for(let key in str1Counter){
    // if(!key in str2Counter){
    //     console.log('key not found string');
    //     return;
    // }
    if(str1Counter[key] !== str2Counter[key]){
        console.log('count is not same of charachters');
        return
    }
}
console.log('valid anagram');
return;


