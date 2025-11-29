let str = 'aabacbebebe';
let k = 3;

let i = 0;
let j = 0;
let maxlen = 0;
let map = new Map();

while(j<str.length){

    map.set(str[j],(map.get(str[j])||0)+1);

    if(map.size<k){
        j++;
    }
    else if(map.size === k){
        maxlen = Math.max(maxlen, j-i+1);
        j++;
    }

    else if(map.size>k){
        while(map.size>k){
           let count=  map.get(str[i]);
           count = count-1;
            map.set(str[i],count);
            if(count === 0){
                map.delete(str[i]);
            }
            i++;
        }
        j++;
    }
}


console.log(map);
console.log(maxlen);

