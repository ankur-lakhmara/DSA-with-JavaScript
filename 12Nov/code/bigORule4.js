/* in this when we have nested loops then we will do multiplication of n instead of adding 

if we have two nested loops then that iterate the array ... then the time complexity would be O(n^2) the below code will have the complexity of n^2*/ 

function pairFinder(arr){
    let newArr = [];
    for(let i = 0;i<arr.length;i++){
        for(let j = i+1;j<arr.length;j++){
            newArr.push([arr[i], arr[j]]);
        }
    }
    return newArr;
}


let arr = [1,2,3,4,5,6,7,8];

console.log(pairFinder(arr));
