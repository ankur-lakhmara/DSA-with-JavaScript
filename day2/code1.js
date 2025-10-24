//print the max atleast five
function printAtleastFive(n){
    for(let i = 1;i<=Math.max(5,n);i++){
        console.log(i);
        
    }
}
printAtleastFive(2)

//the complexity of this code would be o(n) becasue we have to iterate the loop upto n time when the value of n grows


//print the atlease

function printAtmostFive(n){
    for(let i = 0;i<Math.min(5,n);i++){
        console.log(i);
        
    }
}

printAtmostFive(2)
//the complexity of this would be o(1) becasue no matter whats the input as n is ... it would run upto max 5 ... so its constant