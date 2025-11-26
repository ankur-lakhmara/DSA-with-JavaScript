let arr = [1,2,3,4,5,6,7,8];

console.log('original array',arr);

arr.push(5);// this operation will add the element to the end of array o(1)
console.log('after adding 5 ',arr);

arr.pop(); //this operation will remove the last element from array o(1)
console.log('after pop',arr);

arr.unshift(89); //this will add this element to the start of array o(n)
console.log('after unshift',arr);

arr.shift(5465); //this will remove the element from the startih position of array
console.log('after shift',arr);

arr.splice(2,0,15); //this is use to add element in between any specific position in array ... in the example '2' is position where to add '0' is the count how many element you want to delete to insert this element and '15' is the element that we want to insert
console.log('after splice',arr);




