//in this problem we have to find out the pair where the given array is sorted so you have to find out the pair whose sum is 0
//-----------------------------------------------------------------------------------------------------------------------------

//brute force approach with n^2 time complexity
let arr = [-9,-2,-1,0,1,2,3,4,5];
// console.log(arr.sort());


for(let i = 0;i<arr.length;i++){
    for(let j = i+1;j<arr.length;j++){
        if(arr[i]+arr[j] == 0){
            console.log(`elements found at ${i} and ${j}`);
            return;
        }
    }
}
console.log('pair not found ');
return;

//optimized approach with two pointer (O(n) time complexity and O(1) space complexity)

let left = 0;
let right  = arr.length-1;
for(let i = 0;i<arr.length;i++){
    if(arr[left]+arr[right] == 0){
        console.log(`Elements found at ${left} and ${arr.length-right+1} indexes`);
        return;
    }
    else if(arr[left]+arr[right]>0){
        // console.log('first condition');
        right--;
    }
    else{
        // console.log('i am second condition');
        left++;
    }
}
console.log('no pair found ');
return;


