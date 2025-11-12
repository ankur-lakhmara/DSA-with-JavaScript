/** in this problem we are given an sorted array where we have to count the unique values in the array 
 * lets try to understand with the help of examples :
 * arr [1,1,1,1,1,2]          o/p -> 2
 * arr [1,2,3,3,3,4,4,6,6,7]          o/p -> 6
 * arr[] = 0;
 * arr = [-2,-1,-1,0,1]-> 4
  */

//bruit force

// let arr = [1,2,3,3,3,4,4,6,6,7];
let arr = [-2,-2,-1,-1,-1,0,1];

if(arr.length == 0){
    console.log('EMpty array ');
    return;
}

let counter = 0;

for(let i = 0;i<arr.length;i++){
    if(arr[i] !== arr[i+1]){
        counter++;
    }
    else{
        continue;
    }
}

console.log(counter);



