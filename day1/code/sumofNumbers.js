 function addupto(n){
    let firsttime = performance.now();

    let total =  n*(n+1)/2;
    let secondtime = performance.now();
    let arr = [];
    arr.push(total);
    arr.push(secondtime-firsttime);
    return arr;
} //this is the formula to find the sum of natural numbers


const result = addupto(500000);
console.log(`o(1) ${result}`);

//the complexity of this would be O(1) becasue we always have 3 operations in the code

//************************************************************************ */

function adduptoN(n){
    let timeone = performance.now(); //storing first time at this time
    let result = 0;
    for(let i = 0;i<=n;i++){
        result+=i;
    }
    let secondtime = performance.now(); //storing second time at this time
    let totalTime = secondtime-timeone;
    let arr = [];
     arr.push(result),
    arr.push(totalTime);
    return arr;
}

let sumResult = adduptoN(500000);
console.log(`o(n) ${sumResult}`);
// the complexity of this code would be o(n) because in total we are having depending upon the value of n lets say 10n 


// --------------------------------------------------------------------------------------------------
/* the output of both is : 
o(1) 125000250000,0.006199999999992656
o(n) 125000250000,10.525000000000006
we can see the clear time difference on large input
*/ 