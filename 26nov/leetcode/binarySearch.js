/* this is the algorithm for binary search */


let nums = [1,5,6,7,9,15,20,25];
let target= 5;

let start = 0;
let end = nums.length-1;
let mid = Math.floor((start+end)/2);

while(start<=end){
    if(nums[mid] == target){
        console.log(`Element found ${mid} index`);
        break;
    }
    else if(nums[mid]>target){
        end = mid-1;
    }
    else if(nums[mid]<target){
        start = mid+1;
    }
    mid = Math.floor((start+end)/2);
}