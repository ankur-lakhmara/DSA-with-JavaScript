let arr1 = [1,2,3,4,5,5];
let arr2 = [1,4,9,16,25,25];


    if(arr1.length !== arr2.length){
        console.log('false 1');
        return;
        
    }
    let freq1 = {};
    let freq2 = {};

    for(let i = 0;i<arr1.length;i++){
        freq1[arr1[i]] = (freq1[arr1[i]] || 0)+1;
    }
    for(let i = 0;i<arr2.length;i++){
        freq2[arr2[i]] = (freq2[arr2[i]] ||0)+1;
    }


    console.log(freq1);
    console.log(freq2);
    
    
    for(let key in freq1){
        if(!(key ** 2 in freq2)){
           console.log('false 2');
           return;
           
        }
        if(freq2[key ** 2] !== freq1[key]){
            console.log('false 3');
            return;
            
        }
    }
    console.log('true ');
    return;
    

    

// console.log(checker(arr1,arr2));