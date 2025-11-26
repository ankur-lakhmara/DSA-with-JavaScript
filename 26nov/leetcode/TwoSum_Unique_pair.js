// https://leetcode.com/discuss/post/372434/amazon-oa-2019-two-sum-unique-pairs-by-s-sm3s/


/*in this problem i have to return the unique pairs with given targhet sum  */
const nums = [1, 1, 2,90, 45, 46, 46];

const target = 47;

let count = 0;

//first sort the array
nums.sort();

let start = 0;
let end = nums.length-1;

while(start<end){
    let sum = nums[start]+nums[end];
    if(sum<target){
        start++;
    }
    else if(sum>target){
        end--;
    }
    else{
        count++;
        let leftVal = nums[start];
        let rightVal = nums[end];
        
        while(start<end && nums[start] == leftVal){
            start++;
        }
        while(start<end && nums[end] == rightVal){
            end--;
        }
    }
}

console.log(count);

